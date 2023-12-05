<?php

namespace App\Http\Controllers\Blog\DodawanieTresciWpisow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\TrescWpisow;

class DodawanieTresciWpisowController extends Controller
{
    public function inkrementacjaNumeruNaglowka($nazwa)
{
    // Sprawdź, czy istnieje wpis o danej nazwie
    $istniejeWpis = TrescWpisow::where('nazwa', $nazwa)->first();
    
    // Jeśli istnieje wpis o danej nazwie, zwróć obecny numer nagłówka
    if ($istniejeWpis) {
        return $istniejeWpis->numer_naglowka;
    } else {
        // Jeśli nie istnieje wpis o danej nazwie, znajdź najwyższy numer nagłówka i dodaj 1
        $najwyzszyNumerNaglowka = TrescWpisow::max('numer_naglowka');
        return $najwyzszyNumerNaglowka + 1;
    }
}
        
public function dodajTresc(Request $request)
{
    $naglowek = $request->input('naglowek');
    $tresc = $request->input('tresc_artykulu');
    $nazwa = $request->input('nazwa');
    
    // Inkrementuj numer nagłówka tylko jeśli nazwa jest inna
    $numerNaglowka = $this->inkrementacjaNumeruNaglowka($nazwa);

    // Znajdź najwyższy numer_wpisu w bazie danych dla danej nazwy
    $maxNumerWpisu = TrescWpisow::where('nazwa', $nazwa)->max('numer_wpisu');

    // Jeśli nie ma poprzednich wpisów o danej nazwie, zaczynamy od 1
    if (is_null($maxNumerWpisu)) {
        $maxNumerWpisu = 0;
    }

    // Utwórz nowy obiekt TrescWpisow
    $trescWpisow = new TrescWpisow();
    $trescWpisow->naglowek = $naglowek;
    $trescWpisow->tresc_artykulu = $tresc;
    $trescWpisow->nazwa = $nazwa;
    $trescWpisow->numer_naglowka = $numerNaglowka;

    // Nadaj numer_wpisu i zapisz do bazy danych
    $trescWpisow->numer_wpisu = $maxNumerWpisu + 1;
    $trescWpisow->save();

    // Możesz także przekierować użytkownika lub zwrócić odpowiedź JSON
    return response()->json(['message' => 'Tresc dodana pomyślnie']);
}


     
    public function pobierzDane($nazwa)
    {
        // Najpierw pobierz numer nagłówka z bazy dla podanej nazwy artykułu
        $numerNaglowka = TrescWpisow::where('nazwa', $nazwa)
                                    ->value('numer_naglowka');
        
        if ($numerNaglowka === null) {
            return response()->json(['error' => 'Brak danych w bazie'], 404);
        }
        
        // Następnie pobierz dane z bazy, gdzie numer nagłówka jest równy pobranemu numerowi
        $trescWpisow = TrescWpisow::where('nazwa', $nazwa)
                                ->where('numer_naglowka', $numerNaglowka)
                                ->get();
        
        if ($trescWpisow->isEmpty()) {
            return response()->json(['error' => 'Brak danych w bazie'], 404);
        }
        
        return response()->json($trescWpisow);
    }    
    
}
