<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->only('email', 'password');
    
            if (auth()->attempt($credentials)) {
                $user = auth()->user();

                $role = $user->role;
    
                if (auth()->check()) {
                    
                    return response()->json([
                                'isLoggedIn' => true,
                                'role' => $role,
                                'userId' => $user->id,
                                'message' => 'Zalogowano pomyślnie',
                            ]);
                }
            } else {
                return response()->json(['message' => 'Błąd logowania'], 401);
            }
        } else {
            return response()->json(['message' => 'GET method is not supported for this route'], 405);
        }
    }
}
