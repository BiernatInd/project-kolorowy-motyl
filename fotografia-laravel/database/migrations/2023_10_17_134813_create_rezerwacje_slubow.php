<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rezerwacje_slubow', function (Blueprint $table) {
            $table->id();
            $table->string('imie');
            $table->string('nazwisko');
            $table->string('email');
            $table->string('numer_telefonu');
            $table->date('data_rezerwacji');
            $table->string('miejsce_wydarzenia');
            $table->boolean('sesja_w_plenerze')->default(false);
            $table->boolean('sesja_narzecienska')->default(false);
            $table->boolean('sesja_w_innym_dniu')->default(false);
            $table->string('czas_pracy_fotografa');
            $table->text('dodatkowe_informacje')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('rezerwacje_slubow');
    }
};
