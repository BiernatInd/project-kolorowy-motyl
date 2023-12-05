<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Użytkownik nie znaleziony'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Użytkownik został usunięty']);
    }
    
    public function show($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'Użytkownik nie znaleziony'], 404);
    }

    return response()->json($user);
}
    
}