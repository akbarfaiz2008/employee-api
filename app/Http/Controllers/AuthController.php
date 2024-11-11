<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response([
                'message' => 'Unauthorized'
            ], 401);
        } else {
            $user = Auth::user();
            $tokenResult = $user->createToken($user->email);
            $token = $tokenResult->plainTextToken;
            // if ($request->remember_me) {
            //     $token->expires_at = Carbon::now()->addWeeks(1);
            // }
            return response([
                'user' => $user,
                'message' => 'Successfully logged in'
            ]);
        }
    }

    // public function logout(Request $request){
    //     $request->user()->token()->revoke();
    //     return response()->json([
    //         'message' => 'Successfully logged out'
    //     ]);
    // }
}
