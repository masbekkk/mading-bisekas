<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    // Documentation
    /**
     * Login user
     *
     * Logging in user
     *
     * @unauthenticated
     *
     * @return \Illuminate\Http\JsonResponse
     */


    public function login(Request $request)
    {
        try {
            $valdiator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($valdiator->fails()) {
                return formatResponse('error', 'Validasi gagal', null, $valdiator->errors(), 400);
            }

            if (!Auth::attempt($request->only('email', 'password'))) {
                return formatResponse('error', 'Unauthorized', null, 'Invalid Email or Password', 401);
            }

            $user = User::where('email', $request->email)->firstOrFail();

            $token = $user->createToken('aut_token', ['*'], now()->addHour())->plainTextToken;

            return formatResponse('success', 'Login berhasil', [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]);
        } catch (Exception $e) {
            Log::error('Error API login: ' . $e->getMessage());
            return formatResponse('error', 'Gagal login', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }

    // Documentation
    /**
     * Logout user
     *
     * Logging out user
     *
     * @authenticated
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function logout(Request $request)
    {
        try {
            Auth::user()->tokens()->delete();

            return formatResponse('success', 'Logout berhasil');
        } catch (Exception $e) {
            Log::error('Error API logout: ' . $e->getMessage());
            return formatResponse('error', 'Gagal logout', null, $e->getMessage(), $e->getCode() ?: 500);
        }
    }
}
