<?php

namespace App\Http\Controllers\Blog\ListaWpisow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\Wpisy;

class ListaWpisowController extends Controller
{
    public function pobierzWpisy()
    {
        $wpisy = Wpisy::all();
        return response()->json($wpisy);
    }
}
