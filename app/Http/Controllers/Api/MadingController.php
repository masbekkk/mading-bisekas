<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Image;
use App\Models\Mading;
use App\Services\MadingService;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MadingController extends Controller
{
    protected $madingService;

    public function __construct(MadingService $madingService)
    {
        $this->madingService = $madingService;
    }

    public function index(Request $request)
    {
        dd(implode(', ', Mading::NEED_UPLOAD_DOCUMENT_STATUSES));
        try {
            $status = $request->get('status');
            $role = auth()->user()->role;

            if ($role == 'customer') {
                $madings = $this->madingService->getAllMadingsWithCondition(['user_id' => auth()->id()]);
            } else {
                if ($status == 'approved') {
                    $madings = $this->madingService->getAllMadingsWithCondition(['need_approve' => 1, 'approved' => 1, 'rejected' => 0]);
                } else if ($status == 'rejected') {
                    $madings = $this->madingService->getAllMadingsWithCondition(['need_approve' => 1, 'approved' => 0, 'rejected' => 1]);
                } else if ($status == 'need_approve') {
                    $madings = $this->madingService->getAllMadingsWithCondition(['need_approve' => 1, 'approved' => 0, 'rejected' => 0]);
                } else {
                    $madings = $this->madingService->getAllMadings();
                }
            }

            return formatResponse('success', 'Data Berhasil Diambil!', $madings);
        } catch (Exception $e) {
            Log::error('Error API get mading: ' . $e->getMessage());
            return formatResponse('error', 'Gagal mengambil data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }

    public function show($id)
    {
        try {
            $mading = $this->madingService->getMadingById($id);

            if ((auth()->user()->role !== 'admin' && auth()->user()->role !== 'approver') && (auth()->id() !== $mading->user_id)) {
                return formatResponse('error', 'Anda tidak memiliki akses untuk melihat komentar', null, 'Unauthorized', 401);
            }

            return formatResponse('success', 'Data Berhasil Diambil!', $mading);
        } catch (Exception $e) {
            Log::error('Error API show mading by id: ' . $e->getMessage());
            return formatResponse('error', 'Gagal mengambil data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }
    
    public function store(Request $request)
    {
        try{
            $data = $request->all();

            $pic = auth()->user()->name;
            $status = $request->input('status');

            // If the status has changed, set the status_color to 'warning'
            $data['status_color'] = 'warning';
            $data['document'] = '';

            $imageIds = [];
            $imageNames = [];

            if (in_array($status, Mading::NEED_APPROVAL_STATUSES)) {
                $data['need_approve'] = true;
                $data['approved'] = false;
                $data['rejected'] = false;
                $data['status_pending'] = $status;
                $data['status'] = Mading::STATUS_SURVEY;
                $data['pic'] = $pic;
            } else {
                $data['need_approve'] = false;
                $data['approved'] = null;
                $data['rejected'] = null;
                $data['status_pending'] = null;
                $data['pic'] = $pic;
            }

            if(in_array($status, Mading::NEED_UPLOAD_DOCUMENT_STATUSES)) {
                $document = $request->file('document');
                if (!$document) {
                    return formatResponse('error', 'Validasi gagal', null, 'Wajib upload dokumen untuk ubah status', 400);
                }

                $extension = $document->getClientOriginalExtension();
                if ($extension != 'pdf') {
                    return formatResponse('error', 'Validasi gagal', null, 'Dokumen harus berupa file PDF', 400);
                }

                $size = $document->getSize();
                if ($size > 2000000) {
                    return formatResponse('error', 'Validasi gagal', null, 'Ukuran dokumen maksimal 2MB', 400);
                }

                $documentName = date('DMY') . '_' . Str::slug($status) . '_' . $document->getClientOriginalName();
                $path = $document->storeAs('public/documents', $documentName);

                $data['document'] = 'storage/documents/' . $documentName;
            }

            if(in_array($status, Mading::NEED_UPLOAD_IMAGES_STATUSES)) {
                if ($request->hasFile('images')) {
                    $images = $request->file('images');
                    if(count($images) < 4) {
                        return formatResponse('error', 'Validasi gagal', null, 'Wajib upload 4 gambar', 400);
                    } else {
                        foreach ($images as $file) {
                            $originalName = $file->getClientOriginalName();
                            $originalExtension = $file->getClientOriginalExtension();
                        
                            if (!in_array($originalExtension, ['jpg', 'jpeg', 'png'])) {
                                return formatResponse('error', 'Validasi gagal', null, 'Upload file dengan format .jpg, .jpeg, atau .png', 400);
                            }

                            $size = $file->getSize();
                            if ($size > 2000000) {
                                return formatResponse('error', 'Validasi gagal', null, 'Ukuran gambar maksimal 2MB', 400);
                            }
                            
                            $filename = $originalName . '-' . time() . '.' . $originalExtension;
                            $filePath = 'storage/images/'.$filename;
    
                            $file->storeAs('images', $filename, 'public');
    
                            $image = Image::create([
                                'name' => $filename,
                                'path' => $filePath 
                            ]);
    
                            $imageIds[] = $image->id;
                            $imageNames[] = $filename;
                        }
                    }
                } else {
                    return formatResponse('error', 'Validasi gagal', null, 'Wajib upload 4 gambar', 400);
                }
            }

            $data['image_ids'] = json_encode($imageIds);

            $mading = $this->madingService->createMading($data);

            History::create([
                'mading_id' => $mading->id,
                'action' => 'Mading created with status = ' . $data['status'],
                'document' => $data['document'],
                'image_ids' => $data['image_ids'],
                'user_id' => auth()->user()->id
            ]);

            return formatResponse('success', 'Berhasil menambahkan data!', $mading, null, 201);
        
        } catch (Exception $e) {
            foreach($imageNames as $name) {
                if(file_exists(storage_path('app/public/images/' . $name))) {
                    Storage::disk('public')->delete('images/' . $name);
                }
            }
            
            Log::error('Error API update create mading: ' . $e->getMessage());
            return formatResponse('error', 'Gagal mengambil data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Retrieve the existing record to compare the current status
            $existingMading = $this->madingService->getMadingById($id);
            
            $pic = auth()->user()->name;

            $status = $request->input('status');
            $data = $request->all();
            $data['document'] = $existingMading->document;
            $data['image_ids'] = $existingMading->image_ids;
            $imageNames = [];
            if ($status && $status != $existingMading->status) {
                // If the status has changed, set the status_color to 'warning'
                $data['status_color'] = 'warning';

                if (in_array($status, Mading::NEED_APPROVAL_STATUSES)) {
                    $data['need_approve'] = true;
                    $data['approved'] = false;
                    $data['rejected'] = false;
                    $data['status_pending'] = $status;
                    $data['status'] = $existingMading->status;
                    $data['pic'] = $pic;
                } else {
                    $data['need_approve'] = false;
                    $data['approved'] = null;
                    $data['rejected'] = null;
                    $data['status_pending'] = null;
                    $data['pic'] = $pic;
                }

                if(in_array($status, Mading::NEED_UPLOAD_DOCUMENT_STATUSES)) {
                    $data['image_ids'] = json_encode([]);
                    $document = $request->file('document');
                    if (!$document) {
                        return formatResponse('error', 'Validasi gagal', null, 'Wajib upload dokumen untuk ubah status', 400);
                    }
    
                    $extension = $document->getClientOriginalExtension();
                    if ($extension != 'pdf') {
                        return formatResponse('error', 'Validasi gagal', null, 'Dokumen harus berupa file PDF', 400);
                    }
    
                    $size = $document->getSize();
                    if ($size > 2000000) {
                        return formatResponse('error', 'Validasi gagal', null, 'Ukuran dokumen maksimal 2MB', 400);
                    }
    
                    $documentName = date('DMY') . '_' . Str::slug($status) . '_' . $document->getClientOriginalName();
                    $path = $document->storeAs('public/documents', $documentName);
    
                    $data['document'] = 'storage/documents/' . $documentName;
                }
    
                if(in_array($status, Mading::NEED_UPLOAD_IMAGES_STATUSES)) {
                    $data['document'] = '';
                    if ($request->hasFile('images')) {
                        $images = $request->file('images');
                        if(count($images) < 4) {
                            return formatResponse('error', 'Validasi gagal', null, 'Wajib upload 4 gambar', 400);
                        } else {
                            foreach ($images as $file) {
                                $originalName = $file->getClientOriginalName();
                                $originalExtension = $file->getClientOriginalExtension();
                            
                                if (!in_array($originalExtension, ['jpg', 'jpeg', 'png'])) {
                                    return formatResponse('error', 'Validasi gagal', null, 'Upload file dengan format .jpg, .jpeg, atau .png', 400);
                                }
    
                                $size = $file->getSize();
                                if ($size > 2000000) {
                                    return formatResponse('error', 'Validasi gagal', null, 'Ukuran gambar maksimal 2MB', 400);
                                }
                                
                                $filename = $originalName . '-' . time() . '.' . $originalExtension;
                                $filePath = 'storage/images/'.$filename;
        
                                $file->storeAs('images', $filename, 'public');
        
                                $image = Image::create([
                                    'name' => $filename,
                                    'path' => $filePath 
                                ]);
        
                                $imageIds[] = $image->id;
                                $imageNames[] = $filename;
                            }

                            $data['image_ids'] = json_encode($imageIds);
                        }
                    } else {
                        return formatResponse('error', 'Validasi gagal', null, 'Wajib upload 4 gambar', 400);
                    }
                }

                History::create([
                    'mading_id' => $id,
                    'action' => 'Mading updated status from ' . $existingMading->status . ' to ' . $status,
                    'document' => $data['document'],
                    'image_ids' => $data['image_ids'],
                    'user_id' => auth()->user()->id
                ]);
            }

            // Perform the update with the updated data array
            $mading = $this->madingService->updateMading($data, $id);

            return formatResponse('success', 'Data Berhasil Diupdate!', $mading, null, 201);
        } catch (Exception $e) {
            foreach($imageNames as $name) {
                if(file_exists(storage_path('app/public/images/' . $name))) {
                    Storage::disk('public')->delete('images/' . $name);
                }
            }

            Log::error('Error API update mading by id: ' . $e->getMessage());
            return formatResponse('error', 'Gagal mengupdate data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Attempt to delete the mading record
            $this->madingService->deleteMading($id);

            // Return a success response
            return formatResponse('success', 'Mading deleted successfully', null, null, 200);
        } catch (Exception $e) {
            // Log the error message for debugging
            Log::error('Error API delete mading by id: ' . $e->getMessage());

            // Return an error response using formatResponse
            return formatResponse('error', 'Gagal menghapus data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }
}
