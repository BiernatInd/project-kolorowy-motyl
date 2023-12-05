<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrescWpisow extends Model
{
    protected $table = 'tresc_wpisow'; 

    protected $fillable = [
        'naglowek', 
        'tresc_artykulu',
        'nazwa',
        'numer_naglowka',
        'numer_wpisu',
    ];
}
