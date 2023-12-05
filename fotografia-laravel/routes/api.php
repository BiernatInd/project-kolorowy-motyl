<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/csrf-token', 'App\Http\Controllers\Authentication\CSRFTokenController@getToken');
Route::post('/register', 'App\Http\Controllers\Authentication\RegisterController@register'); 
Route::post('/login', 'App\Http\Controllers\Authentication\LoginController@login'); 
Route::post('/recover-password', 'App\Http\Controllers\Authentication\RecoverPasswordController@recoverPassword');
Route::post('/reset-password/{token}', 'App\Http\Controllers\Authentication\ResetPasswordController@resetPassword');

//Rezerwacje
Route::post('/rezerwacje-biznesowe', 'App\Http\Controllers\Rezerwacje\RezerwacjeBiznesoweController@rezerwacjeBiznesowe');
Route::post('/rezerwacje-imprez', 'App\Http\Controllers\Rezerwacje\RezerwacjeImprezController@rezerwacjeImprez');
Route::post('/rezerwacje-slubow', 'App\Http\Controllers\Rezerwacje\RezerwacjeSlubowController@rezerwacjeSlubow');

//Blokowanie daty
Route::get('/kalendarz-biznesowy', 'App\Http\Controllers\Kalendarz\KalendarzBiznesowyController@blokujDate');
Route::get('/kalendarz-imprez', 'App\Http\Controllers\Kalendarz\KalendarzImprezController@blokujDate');
Route::get('/kalendarz-slubow', 'App\Http\Controllers\Kalendarz\KalendarzSlubowController@blokujDate');

//Pobierz dane z bazy
Route::get('/rezerwacje-slubow-dane', 'App\Http\Controllers\Rezerwacje\RezerwacjeSlubowController@pobierzRezerwacjeSlubow');
Route::get('/informacje-rezerwacje-slubow/{id}', 'App\Http\Controllers\Rezerwacje\RezerwacjeSlubowController@informacjeRezerwacjaSlubow');

Route::get('/rezerwacje-imprez-dane', 'App\Http\Controllers\Rezerwacje\RezerwacjeImprezController@pobierzRezerwacjeImprez');
Route::get('/informacje-rezerwacje-imprez/{id}', 'App\Http\Controllers\Rezerwacje\RezerwacjeImprezController@informacjeRezerwacjaImprez');

Route::get('/rezerwacje-biznesowe-dane', 'App\Http\Controllers\Rezerwacje\RezerwacjeBiznesoweController@pobierzRezerwacjeBiznesowe');
Route::get('/informacje-rezerwacje-biznesowe/{id}', 'App\Http\Controllers\Rezerwacje\RezerwacjeBiznesoweController@informacjeRezerwacjaBiznesowe');

//Lista użytkowników w panelu admina
Route::get('/uzytkownicy', 'App\Http\Controllers\Authentication\UserController@index');
Route::delete('/uzytkownicy/{id}', 'App\Http\Controllers\Authentication\UserController@destroy');

//Dodawanie zdjec
Route::post('/dodawanie-zdjec', 'App\Http\Controllers\DodawanieZdjec\DodawanieZdjecController@upload');
Route::get('/sprawdzanie-uzytkownika', 'App\Http\Controllers\DodawanieZdjec\DodawanieZdjecController@checkUser');

//Pobieranie listy zdjęć
Route::get('/lista-zdjec', 'App\Http\Controllers\ListaZdjec\ListaZdjecController@pobierzListeZdjec');


Route::post('/usun-zdjecie', 'App\Http\Controllers\ListaZdjec\ListaZdjecController@usunZdjecie');

//Galeria użytkownika
Route::get('/user/{id}', 'App\Http\Controllers\Authentication\UserController@show');

//Pobieranie zdjęć użytkownika
Route::get('/pobieranie-zdjec/{userId}', 'App\Http\Controllers\PobieranieZdjec\PobieranieZdjecController@pobierzZdjeciaUzytkownika');
Route::get('/pobieranie-zdjec-zip/{userId}', 'App\Http\Controllers\PobieranieZdjec\PobieranieZdjecController@pobierzZipZdjeciaUzytkownika');

//Blog

Route::post('/dodawanie-wpisow', 'App\Http\Controllers\Blog\DodawanieWpisow\DodawanieWpisowController@dodajWpis');
Route::post('/dodawanie-tresci-wpisow', 'App\Http\Controllers\Blog\DodawanieTresciWpisow\DodawanieTresciWpisowController@dodajTresc');
Route::get('/pobierz-dane/{nazwa}', 'App\Http\Controllers\Blog\DodawanieTresciWpisow\DodawanieTresciWpisowController@pobierzDane');
Route::get('/pobierz-wpisy', 'App\Http\Controllers\Blog\ListaWpisow\ListaWpisowController@pobierzWpisy');
Route::post('/edytuj-naglowek', 'App\Http\Controllers\Blog\EdytowanieTresci\EdytowanieTresciController@edytujNaglowek');
Route::post('/edytuj-paragraf', 'App\Http\Controllers\Blog\EdytowanieTresci\EdytowanieTresciController@edytujParagraf');

Route::delete('/usun-wpis/{wpisId}', 'App\Http\Controllers\Blog\UsuwanieWpisow\UsuwanieWpisowController@usunWpis');

//Pobierz artykuly
Route::get('/lista-artykulow', 'App\Http\Controllers\Blog\ListaArtykulow\ListaArtykulowController@pobierzArtykuly');
Route::get('/pobierz-artykul/{nazwa}', 'App\Http\Controllers\Blog\Artykul\ArtykulController@pobierzArtykul');

Route::get('/pobierz-meta/{nazwa}', 'App\Http\Controllers\Blog\MetaTagi\MetaTagiController@pobierzMetaDane');
