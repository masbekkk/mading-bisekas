<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function show(Image $image)
    {
        try {
            if (!$image) {
                return formatResponse('error', 'Data tidak ditemukan', null, 'Not Found', 404);
            }

            if (!Storage::disk('public')->exists('images/'. $image->name)) {
                return response()->json(['message' => 'Image not found'], 404);
            }
        
            $file = Storage::disk('public')->get('images/'. $image->name);
            $mime = Storage::disk('public')->mimeType('images/'. $image->name);
        
            return response($file, 200)->header('Content-Type', $mime);
        } catch (Exception $e) {
            Log::error('Error API show image by id: ' . $e->getMessage());
            return formatResponse('error', 'Gagal mengambil data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }
}
