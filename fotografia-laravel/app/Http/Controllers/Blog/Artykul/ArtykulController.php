<?php

namespace App\Http\Controllers\Blog\Artykul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\TrescWpisow;

class ArtykulController extends Controller
{
    public function pobierzArtykul($nazwa)
    {
        // Pobierz artykuły o określonej nazwie
        $articles = TrescWpisow::where('nazwa', $nazwa)
            ->select('naglowek', 'tresc_artykulu')
            ->get();
    
        return response()->json($articles);
    }
    
}
