<?php

namespace App\Http\Controllers\EdytowanieTresci;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\EdytowanieTresci;

class EdytowanieTresciController extends Controller
{
    public function edytujNaglowek(Request $request)
{
    $validatedData = $request->validate([
        'naglowek' => 'required|string',
        'custom_id' => 'required|integer',
        'numer_naglowka' => 'required|integer',
    ]);

    // Znajdź wpis na podstawie custom_id i numer_naglowka
    $tresc = EdytowanieTresci::where('custom_id', $validatedData['custom_id'])
        ->where('numer_naglowka', $validatedData['numer_naglowka'])
        ->first();

    if (!$tresc) {
        return response()->json(['message' => 'Nie znaleziono wpisu do edycji'], 404);
    }

    // Zaktualizuj tylko nagłówek wpisu
    $tresc->naglowek = $validatedData['naglowek'];
    $tresc->save();

    return response()->json(['message' => 'Nagłówek wpisu został zaktualizowany'], 200);
}
public function edytujParagraf(Request $request)
{
    $validatedData = $request->validate([
        'numer_paragrafu' => 'required|integer',
        'nowy_paragraf' => 'required|string',
        'custom_id' => 'required|integer',
    ]);

    // Znajdź artykuł na podstawie custom_id i numer_paragrafu
    $artykul = EdytowanieTresci::where('custom_id', $validatedData['custom_id'])
        ->where('numer_naglowka', $validatedData['numer_paragrafu'])
        ->first();

    if (!$artykul) {
        return response()->json(['message' => 'Nie znaleziono artykułu do edycji'], 404);
    }

    // Zaktualizuj treść artykułu
    $artykul->tresc_artykulu = $validatedData['nowy_paragraf'];
    $artykul->save();

    return response()->json(['message' => 'Treść artykułu została zaktualizowana'], 200);
}
}
