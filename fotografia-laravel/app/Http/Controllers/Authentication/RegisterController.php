<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash; 
use App\Models\User; 

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {

            $validatedData = $request->validate([
                'email' => 'required|email|unique:users',
                'name' => 'required|string',
                'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).*$/',
            ]);
    
            $user = new User([
                'email' => $validatedData['email'],
                'name' => $validatedData['name'],
                'password' => bcrypt($validatedData['password']),
            ]);
    
            $user->save();
    
            return response()->json(['message' => 'Rejestracja zakończona sukcesem']);
        } else {
            return response()->json(['message' => 'GET method is not supported for this route'], 405);
        }
    }
}
