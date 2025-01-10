<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mading;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApprovalController extends Controller
{
    public function index()
    {
        try {
            $mading = Mading::where('need_approve', true)->get();
            return formatResponse('success', 'Data Berhasil Diambil!', $mading);
        } catch (Exception $e) {
            Log::error('Error API index approval: ' . $e->getMessage());
            return formatResponse('error', 'Gagal mengambil data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }

    public function approve($id)
    {
        try {
            $mading = Mading::find($id);

            if (!$mading) {
                return formatResponse('error', 'Data tidak ditemukan', null, 'Not Found', 404);
            }

            $nedApprovalStatuses = [
                Mading::STATUS_TAGIHAN_DP,
                Mading::STATUS_TIME_SCHEDULE,
                Mading::STATUS_FPP,
                Mading::STATUS_INVOICE,
                Mading::STATUS_PENGIRIMAN
            ];

            if (!$mading->need_approve || ($mading->need_approve && $mading->approved) || !in_array($mading->status_pending, $nedApprovalStatuses)) {
                return formatResponse('error', 'Gagal approve data', null, 'Status data telah berubah, harap reload halaman', 400);
            }

            $mading->need_approve = true;
            $mading->approved = true;
            $mading->rejected = false;
            $mading->status = $mading->status_pending;
            $mading->status_pending = null;
            $mading->save();

            return formatResponse('success', 'Data berhasil diapprove', $mading);
        } catch (Exception $e) {
            Log::error('Error API approve mading: ' . $e->getMessage());
            return formatResponse('error', 'Gagal mengambil data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }

    public function reject($id)
    {
        try {
            $mading = Mading::find($id);

            if (!$mading) {
                return formatResponse('error', 'Data tidak ditemukan', null, 'Not Found', 404);
            }

            $nedApprovalStatuses = [
                Mading::STATUS_TAGIHAN_DP,
                Mading::STATUS_TIME_SCHEDULE,
                Mading::STATUS_FPP,
                Mading::STATUS_INVOICE,
                Mading::STATUS_PENGIRIMAN
            ];

            if (!$mading->need_approve || ($mading->need_approve && $mading->rejected) || !in_array($mading->status_pending, $nedApprovalStatuses)) {
                return formatResponse('error', 'Gagal approve data', null, 'Status data telah berubah, harap reload halaman', 400);
            }

            $mading->approved = false;
            $mading->rejected = true;
            $mading->save();

            return formatResponse('success', 'Data berhasil direject', $mading);
        } catch (Exception $e) {
            Log::error('Error API reject mading: ' . $e->getMessage());
            return formatResponse('error', 'Gagal mengambil data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }
}
