<?php

namespace App\Http\Controllers\ListaZdjec;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListaZdjec;

class ListaZdjecController extends Controller
{
    public function pobierzListeZdjec()
    {
        $zdjecia = ListaZdjec::all(); // Pobierz wszystkie zdjęcia z bazy danych

        return response()->json($zdjecia);
    }

public function usunZdjecie(Request $request)
{
    $zdjecieId = $request->input('zdjecie_id');
    $zdjecie = ListaZdjec::find($zdjecieId);

if ($zdjecie) {
    // Usuń z bazy danych
    $zdjecie->delete();

    // Pobierz nazwę pliku z pełnej ścieżki
    $nazwaPliku = pathinfo($zdjecie->sciezka_zdjecia, PATHINFO_BASENAME);

    // Skonstruuj ścieżkę do pliku na serwerze
    $sciezkaZdjecia = public_path('photos/' . $zdjecie->nazwa_uzytkownika . '/' . $nazwaPliku);

    if (file_exists($sciezkaZdjecia)) {
        unlink($sciezkaZdjecia);
    } else {
    }

    return response()->json(['message' => 'Zdjęcie zostało usunięte.']);
} else {
    return response()->json(['error' => 'Zdjęcie nie zostało znalezione.']);
}
   
}
}