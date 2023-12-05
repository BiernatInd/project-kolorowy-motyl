<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaZdjec extends Migration
{
    public function up()
    {
        Schema::create('lista_zdjec', function (Blueprint $table) {
            $table->id(); // Kolumna ID
            $table->string('nazwa_uzytkownika'); // Kolumna z nazwą użytkownika
            $table->string('nazwa_zdjecia'); // Kolumna z nazwą zdjęcia
            $table->string('sciezka_zdjecia'); // Kolumna z ścieżką do zdjęcia
            $table->timestamps(); // Kolumny created_at i updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('lista_zdjec');
    }
}
