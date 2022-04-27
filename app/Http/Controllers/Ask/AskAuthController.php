<?php

namespace App\Http\Controllers\Ask;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
}
