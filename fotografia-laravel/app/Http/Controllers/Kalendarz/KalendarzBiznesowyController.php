<?php

namespace App\Http\Controllers\Kalendarz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rezerwacje\RezerwacjeBiznesowe;

class KalendarzBiznesowyController extends Controller
{
    public function blokujDate()
    {
        $reservedDates = RezerwacjeBiznesowe::pluck('data_rezerwacji')->toArray();

        return response()->json($reservedDates);
    }
}
