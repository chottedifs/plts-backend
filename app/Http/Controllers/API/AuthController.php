<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Login;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = Login::where('email', $request->email)->first();

        if(!$user || !\Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json([
            'message' => 'sukses',
            'user' => $user,
            'token' => $token
        ], 200);
    }
}