<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        // Check if the request is a GET request
        if ($request->isMethod('get')) {
            // Return the login form view
            return view('auth.login'); // Adjust the view name as necessary
        }

        $loginRequest = LoginRequest::createFrom($request);

        // Handle POST request (login submission)
        return $this->handleLogin($loginRequest);
    }

    protected function handleLogin(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('admin-mading.index');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('admin-mading.index');
        // return response()->noContent();
    }
}
