<?php

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

Route::get('/', 'IndexController@index');
Route::get('/clienti', 'ClientiController@index');
Route::get('/termeni', 'TermeniController@index');
Route::get('/politica', 'PoliticaController@index');
Route::get('/detaliu', 'DetaliuController@index');
Route::get('/contact', 'ContactController@index');
Route::get('/servicii', 'ServiciiController@index');
Route::get('/cookies', 'CookiesController@index');
Route::get('/portofoliu', 'PortofoliuController@index');
Route::post('trimite-mesaj', 'ContactController@send_message');
Route::get('/portofoliu/{link}', 'PortofoliuController@detaliu_portofoliu');






Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
