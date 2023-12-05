<?php

namespace App\Models\Rezerwacje;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RezerwacjeSlubow extends Model
{
    use HasFactory;

    protected $table = 'rezerwacje_slubow'; 

    protected $fillable = [
        'imie',
        'nazwisko',
        'email',
        'numer_telefonu',
        'data_rezerwacji',
        'miejsce_wydarzenia',
        'sesja_w_plenerze',
        'sesja_narzecienska',
        'sesja_w_innym_dniu',
        'czas_pracy_fotografa',
        'dodatkowe_informacje',
    ];
}
