<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str; 
use App\Mail\ResetPasswordEmail; 

class RecoverPasswordController extends Controller
{
    public function recoverPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
    
        $token = Str::random(60);
    
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        $resetLink = "/resetowanie-hasla/{$token}";
    
        Mail::to($request->email)->send(new ResetPasswordEmail('http://serwer-testowy-soyfragrance.pl/resetowanie-hasla/'.''.$token));
    
        return response()->json(['message' => 'E-mail z linkiem do resetowania hasła został wysłany', 'resetLink' => $resetLink,]);
    }
}
