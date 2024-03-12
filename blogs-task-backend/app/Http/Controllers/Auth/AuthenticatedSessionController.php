<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller {
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request) {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent();
    }

    // public function store(LoginRequest $request) {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //         throw ValidationException::withMessages([
    //             'email' => ['The provided credentials are incorrect.'],
    //         ]);
    //     }

    //     $responsetoken = $user->createToken('auth_token')->plainTextToken;
    //     return response()->json([
    //         'token' => $responsetoken,
    //     ]);
    // }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }

    public function current(Request $request) {
        $user_id = $request->user()->id;
        $user = User::where('id', $user_id)->get();

        return $user;
    }
}
