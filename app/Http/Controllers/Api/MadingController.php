<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MadingService;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class MadingController extends Controller
{
    protected $madingService;

    public function __construct(MadingService $madingService)
    {
        $this->madingService = $madingService;
    }

    public function show($id)
    {
        try {
            $mading = $this->madingService->getMadingById($id);
            return formatResponse('success', 'Data Berhasil Diambil!', $mading);
        } catch (Exception $e) {
            Log::error('Error API show mading by id: ' . $e->getMessage());
            return formatResponse('error', 'Gagal mengambil data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Retrieve the existing record to compare the current status
            $existingMading = $this->madingService->getMadingById($id);

            $status = $request->input('status');
            $data = $request->all();
            if ($status && $status != $existingMading->status) {
                // If the status has changed, set the status_color to 'warning'
                $data['status_color'] = 'warning';
            }
            // Perform the update with the updated data array
            $mading = $this->madingService->updateMading($data, $id);

            return formatResponse('success', 'Data Berhasil Diupdate!', $mading, null, 201);
        } catch (Exception $e) {
            Log::error('Error API update mading by id: ' . $e->getMessage());
            return formatResponse('error', 'Gagal mengambil data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }
}
