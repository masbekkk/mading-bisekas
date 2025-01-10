<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function me()
    {
        try {
            $user = Auth::user();

            return formatResponse('success', 'Success get user data', $user);
        } catch (Exception $e) {
            Log::error('Error API show user data: ' . $e->getMessage());
            return formatResponse('error', 'Failed to get user data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'password' => 'nullable|required_with:new_password',
                'new_password' => 'nullable|confirmed'
            ]);

            if ($validator->fails()) {
                return formatResponse('error', 'Validation failed', null, $validator->errors(), 400);
            }

            $user = Auth::user();

            $user->name = $request->name;

            if ($request->filled('password')) {
                if (!password_verify($request->password, $user->password)) {
                    return formatResponse('error', 'Password is incorrect', null, 'Password is incorrect', 400);
                }

                $user->password = bcrypt($request->new_password);
            }

            $user->save();

            return formatResponse('success', 'Success update user data', $user);
        } catch (Exception $e) {
            Log::error('Error API update user data: ' . $e->getMessage());
            return formatResponse('error', 'Failed to update user data', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }
}
