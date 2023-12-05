<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrescWpisow extends Migration
{
    public function up()
    {
        Schema::create('tresc_wpisow', function (Blueprint $table) {
            $table->id();
            $table->string('naglowek');
            $table->text('tresc_artykulu');
            $table->string('nazwa');
            $table->integer('numer_naglowka')->nullable();
            $table->integer('numer_wpisu')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tresc_wpisow');
    }
}
