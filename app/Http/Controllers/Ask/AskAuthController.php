<?php

namespace App\Http\Controllers\Ask;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AskAuthController extends Controller
{

    public function encryptToken(){
        $base = env('APP_KEY');
        $data = Crypt::encryptString($base);
        return response()->json([
            'success' => true,
            'data' => [
                'token' => $data,
            ]
        ]);
    }

    public function dcryptToken($token){
        $res = Crypt::decryptString($token);
        return response()->json([
            'token' => $res
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user= User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'success'   => false,
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

            $token = $user->createToken('ApiToken')->plainTextToken;

            $response = [
                'success'   => true,
                'user'      => $user,
                'token'     => $token
            ];

        return response($response, 201);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'success'    => true
        ], 200);
    }
}
