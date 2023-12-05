<?php

namespace App\Http\Controllers\Rezerwacje;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rezerwacje\RezerwacjeSlubow;

class RezerwacjeSlubowController extends Controller
{
    public function rezerwacjeSlubow(Request $request)
    {
        $data = $request->validate([
            'imie' => 'required|string',
            'nazwisko' => 'required|string',
            'email' => 'required|email',
            'numer_telefonu' => 'required|numeric',
            'data_rezerwacji' => 'required|date',
            'miejsce_wydarzenia' => 'required|string',
            'sesja_w_plenerze' => 'boolean',
            'sesja_narzecienska' => 'boolean',
            'sesja_w_innym_dniu' => 'boolean',
            'czas_pracy_fotografa' => 'required|string',
            'dodatkowe_informacje' => 'nullable|string',
        ]);

        $reservation = RezerwacjeSlubow::create($data);

        return response()->json(['message' => 'Rezerwacja została zapisana', 'reservation' => $reservation], 201);
    }

    public function pobierzRezerwacjeSlubow()
{
    $rezerwacje = RezerwacjeSlubow::all();
    return response()->json($rezerwacje, 200);
}

public function informacjeRezerwacjaSlubow($id) {
    $rezerwacja = RezerwacjeSlubow::find($id);
    return response()->json($rezerwacja, 200);
}


}