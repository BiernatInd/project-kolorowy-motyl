<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wpisy extends Model
{
    protected $table = 'wpisy'; 

    protected $fillable = [
        'nazwa',
        'meta_title',
        'meta_description',
        'created_at',
    ];
}
