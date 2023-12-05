<?php

namespace App\Http\Controllers\Blog\EdytowanieTresci;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\TrescWpisow;

class EdytowanieTresciController extends Controller
{
    public function edytujNaglowek(Request $request) {
        $numerNaglowka = $request->input('numerNaglowka');
        $nowyNaglowek = $request->input('nowyNaglowek');
    
        // Aktualizuj nagłówek w bazie danych tylko dla wpisu o danym numerze nagłówka
        TrescWpisow::where('numer_wpisu', $numerNaglowka)->update(['naglowek' => $nowyNaglowek]);
    
        return response()->json(['message' => 'Nagłówek został zaktualizowany.']);
    }

    public function edytujParagraf(Request $request) {
        $numerParagrafu = $request->input('numerParagrafu');
        $nowyParagraf = $request->input('nowyParagraf');

        // Aktualizuj paragraf w bazie danych
        TrescWpisow::where('numer_wpisu', $numerParagrafu)->update(['tresc_artykulu' => $nowyParagraf]);

        return response()->json(['message' => 'Paragraf został zaktualizowany.']);
    }
}
