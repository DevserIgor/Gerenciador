<?php

use Illuminate\Support\Facades\Route;

//rota para registrar um usuario
Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');

//rotas de login
Route::get("/entrar", 'EntrarController@index');
Route::post("/entrar", 'EntrarController@entrar');

Route::get('/', 'PainelController@index')->name("painel.index")->middleware('autentic');

//logout
Route::get('/sair', function(){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/entrar');
});
