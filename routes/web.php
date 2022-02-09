<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/a-propos', 'AproposControlleur@index')->name('apropos');



Route::get('taches/undone', 'TacheControlleur@undone')->name('taches.undone');
Route::get('taches/done', 'TacheControlleur@done')->name('taches.done');
Route::get('taches/test', 'AproposControlleur@test')->name('taches.test');
Route::get('taches/create', 'TacheControlleur@create')->name('taches.create');
Route::put('taches/makedone/{tache}', 'TacheControlleur@makedone')->name('taches.makedone');
Route::put('taches/makeundone/{tache}', 'TacheControlleur@makeundone')->name('taches.makeundone');
Route::get('taches/{tache)/affectedTo/{user}','TacheControlleur@affectedto')->name('taches.affectedto');

Route::resource('taches', 'TacheControlleur');
