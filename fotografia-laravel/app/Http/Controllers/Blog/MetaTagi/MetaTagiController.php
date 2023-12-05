<?php

namespace App\Http\Controllers\Blog\MetaTagi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\Wpisy;

class MetaTagiController extends Controller
{
    public function pobierzMetaDane($nazwa)
    {
        $article = Wpisy::where('nazwa', $nazwa)->first();
    
        if (!$article) {
            return response()->json(['message' => 'Artykuł nie znaleziony'], 404);
        }
    
        return response()->json(['article' => $article], 200);
    }        
}
