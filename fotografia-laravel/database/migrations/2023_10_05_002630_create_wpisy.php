<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpisy extends Migration
{
    public function up()
    {
        Schema::create('wpisy', function (Blueprint $table) {
            $table->id();
            $table->string('nazwa')->default('Domyślna nazwa');
            $table->string('meta_title'); // Dodaj kolumnę na Meta Title
            $table->string('meta_description'); // Dodaj kolumnę na Meta Description
            // Dodaj inne kolumny związane z treścią artykułu
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wpisy');
    }
}
