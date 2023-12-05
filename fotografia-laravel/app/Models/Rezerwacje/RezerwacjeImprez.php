<?php

namespace App\Models\Rezerwacje;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RezerwacjeImprez extends Model
{
    use HasFactory;

    protected $table = 'rezerwacje_imprez'; 

    protected $fillable = [
        'imie',
        'nazwisko',
        'email',
        'numer_telefonu',
        'data_rezerwacji',
        'miejsce_wydarzenia',
        'sesja_w_plenerze',
        'sesja_z_rodzina',
        'dodatkowe_informacje',
    ];
}
