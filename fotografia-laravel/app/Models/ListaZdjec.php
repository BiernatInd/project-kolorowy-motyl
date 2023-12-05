<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaZdjec extends Model
{
    use HasFactory;

    protected $table = 'lista_zdjec'; // Nazwa tabeli

    protected $fillable = [
        'nazwa_uzytkownika',
        'nazwa_zdjecia',
        'sciezka_zdjecia',
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
