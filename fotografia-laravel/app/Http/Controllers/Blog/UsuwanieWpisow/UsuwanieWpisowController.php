<?php

namespace App\Http\Controllers\Blog\UsuwanieWpisow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\Wpisy;
use App\Models\Blog\TrescWpisow;

class UsuwanieWpisowController extends Controller
{
    public function usunWpis($nazwaWpisu)
    {
        // Znajdź wszystkie wpisy o podanej nazwie
        $wpisy = Wpisy::where('nazwa', $nazwaWpisu)->get();
    
        if ($wpisy->isEmpty()) {
            return response()->json(['message' => 'Wpisy nie zostały znalezione'], 404);
        }
    
        // Pobierz nazwę wpisu
        $nazwa = $wpisy[0]->nazwa;
    
        // Usuń wszystkie wpisy o danej nazwie
        Wpisy::where('nazwa', $nazwa)->delete();
    
        // Usuń związane z nimi treści wpisów z tabeli tresci_wpisow
        TrescWpisow::where('nazwa', $nazwa)->delete();
    
        return response()->json(['message' => 'Wpisy i związane z nimi treści wpisów zostały usunięte']);
    }
    
}
