<?php

namespace App\Http\Controllers\Rezerwacje;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rezerwacje\RezerwacjeImprez;

class RezerwacjeImprezController extends Controller
{
    public function rezerwacjeImprez(Request $request)
    {
        $data = $request->validate([
            'imie' => 'required|string',
            'nazwisko' => 'required|string',
            'email' => 'required|email',
            'numer_telefonu' => 'required|numeric',
            'data_rezerwacji' => 'required|date',
            'miejsce_wydarzenia' => 'required|string',
            'sesja_w_plenerze' => 'boolean',
            'sesja_z_rodzina' => 'boolean',
            'dodatkowe_informacje' => 'nullable|string',
        ]);

        $reservation = RezerwacjeImprez::create($data);

        return response()->json(['message' => 'Rezerwacja została zapisana', 'reservation' => $reservation], 201);
    }

    public function pobierzRezerwacjeImprez()
    {
        $rezerwacje = RezerwacjeImprez::all();
        return response()->json($rezerwacje, 200);
    }
    
    public function informacjeRezerwacjaImprez($id) {
        $rezerwacja = RezerwacjeImprez::find($id);
        return response()->json($rezerwacja, 200);
    }
}