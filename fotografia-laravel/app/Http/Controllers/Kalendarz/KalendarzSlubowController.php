<?php

namespace App\Http\Controllers\Kalendarz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rezerwacje\RezerwacjeSlubow;

class KalendarzSlubowController extends Controller
{
    public function blokujDate()
    {
        $reservedDates = RezerwacjeSlubow::pluck('data_rezerwacji')->toArray();

        return response()->json($reservedDates);
    }
}
