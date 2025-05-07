<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Mading;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * @authenticated
     */

    public function show(Mading $mading)
    {
        try {
            if (!$mading) {
                return formatResponse('error', 'Data tidak ditemukan', null, 'Not Found', 404);
            }

            if (!in_array(auth()->user()->role, ['admin', 'approver']) && (auth()->id() !== $mading->user_id)) {
                return formatResponse('error', 'Anda tidak memiliki akses untuk melihat komentar', null, 'Unauthorized', 401);
            }

            $comments = $mading->comments()->with('user')->get();

            return formatResponse('success', 'Data Berhasil Diambil!', $comments);
        } catch (Exception $e) {
            Log::error('Error API show comment by mading id: ' . $e->getMessage());
            return formatResponse('error', 'Gagal mengambil data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }

    public function store(Request $request, Mading $mading)
    {
        try {
            $validator = Validator::make($request->all(), [
                'content' => 'required',
                'images.*' => 'nullable|mimes:jpg,jpeg,png'
            ]);

            if ($validator->fails()) {
                return formatResponse('error', 'Validasi gagal', null, $validator->errors(), 400);
            }

            if (!in_array(auth()->user()->role, ['admin', 'approver']) && (auth()->id() !== $mading->user_id)) {
                return formatResponse('error', 'Anda tidak memiliki akses untuk menambahkan komentar', null, 'Unauthorized', 401);
            }

            $imageIds = [];
            $imageNames = [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $originalExtension = $file->getClientOriginalExtension();
                    
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


            $comment = $mading->comments()->create([
                'user_id' => auth()->id(),
                'content' => $request->content,
                'image_ids' => json_encode($imageIds),
            ]);

            return formatResponse('success', 'Data berhasil ditambahkan!', $comment, null, 201);
        } catch (Exception $e) {
            foreach($imageNames as $name) {
                if(file_exists(storage_path('app/public/images/' . $name))) {
                    Storage::disk('public')->delete('images/' . $name);
                }
            }

            Log::error('Error API store comment: ' . $e->getMessage());
            return formatResponse('error', 'Gagal menambahkan data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }

    public function destroy(Comment $comment)
    {
        try {
            if ($comment->user->id !== auth()->id()) {
                return formatResponse('error', 'Anda tidak memiliki akses untuk menghapus data ini', null, 'Unauthorized', 401);
            }

            $comment->delete();

            return formatResponse('success', 'Data berhasil dihapus!');
        } catch (Exception $e) {
            Log::error('Error API delete comment by id: ' . $e->getMessage());
            return formatResponse('error', 'Gagal menghapus data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }
}
