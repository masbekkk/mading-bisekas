<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function getCustomers()
    {
        try {
            $customers = User::where('role', 'customer')->get();

            return formatResponse('success', 'Success get customers data', $customers);
        } catch (Exception $e) {
            Log::error('Error API get customer: ' . $e->getMessage());
            return formatResponse('error', 'Failed to get customers data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }
}
