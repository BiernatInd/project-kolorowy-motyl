<?php

namespace App\Http\Controllers\Blog\DodawanieWpisow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\Wpisy;

class DodawanieWpisowController extends Controller
{
     // Dodawanie nowego wpisu
     public function dodajWpis(Request $request)
     {
         // Pobierz dane z formularza
         $nazwa = $request->input('nazwa');
         $metaTitle = $request->input('metaTitle');
         $metaDescription = $request->input('metaDescription');
 
         // Utwórz nowy wpis w bazie danych
         Wpisy::create([
             'nazwa' => $nazwa,
             'meta_title' => $metaTitle,
             'meta_description' => $metaDescription,
         ]);
 
         return response()->json(['message' => 'Wpis został dodany do bazy danych.']);
     }
}
