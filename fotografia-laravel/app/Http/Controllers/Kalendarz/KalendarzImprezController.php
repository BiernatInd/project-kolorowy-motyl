<?php

namespace App\Http\Controllers\Kalendarz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rezerwacje\RezerwacjeImprez;

class KalendarzImprezController extends Controller
{
    public function blokujDate()
    {
        $reservedDates = RezerwacjeImprez::pluck('data_rezerwacji')->toArray();

        return response()->json($reservedDates);
    }
}
