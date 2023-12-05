<?php

namespace App\Http\Controllers\Blog\ListaArtykulow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\TrescWpisow;

class ListaArtykulowController extends Controller
{
    public function pobierzArtykuly()
    {
        $articles = TrescWpisow::all(); // Pobierz wszystkie artykuły
        return response()->json($articles);
    }
}
