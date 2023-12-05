<?php

namespace App\Http\Controllers\Rezerwacje;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rezerwacje\RezerwacjeBiznesowe;

class RezerwacjeBiznesoweController extends Controller
{
    public function rezerwacjeBiznesowe(Request $request)
    {
        $data = $request->validate([
            'imie' => 'required|string',
            'nazwisko' => 'required|string',
            'email' => 'required|email',
            'numer_telefonu' => 'required|numeric',
            'data_rezerwacji' => 'required|date',
            'miejsce_wydarzenia' => 'required|string',
            'sesja_w_plenerze' => 'boolean',
            'dodatkowe_informacje' => 'nullable|string',
        ]);

        $reservation = RezerwacjeBiznesowe::create($data);

        return response()->json(['message' => 'Rezerwacja została zapisana', 'reservation' => $reservation], 201);
    }

    public function pobierzRezerwacjeBiznesowe()
    {
        $rezerwacje = RezerwacjeBiznesowe::all();
        return response()->json($rezerwacje, 200);
    }
    
    public function informacjeRezerwacjaBiznesowe($id) {
        $rezerwacja = RezerwacjeBiznesowe::find($id);
        return response()->json($rezerwacja, 200);
    }
}
