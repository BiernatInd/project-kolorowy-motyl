<?php

namespace App\Models\Rezerwacje;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RezerwacjeBiznesowe extends Model
{
    use HasFactory;

    protected $table = 'rezerwacje_biznesowe'; 

    protected $fillable = [
        'imie',
        'nazwisko',
        'email',
        'numer_telefonu',
        'data_rezerwacji',
        'miejsce_wydarzenia',
        'sesja_w_plenerze',
        'dodatkowe_informacje',
    ];
}
