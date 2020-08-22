<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PainelController@index')
    ->name('painel.index')
    ->middleware('autentic');


Route::group(['middleware' => ['autentic','admin', ]], function () {
    Route::resource('usuarios', 'UsuarioController')->except([
        'edit', 'show', 'create'
    ]);

    Route::resource('empresas', 'EmpresaController')->except([
        'edit', 'show', 'create'
    ]);

});
//retorno empresa
Route::get('/empresas/retornaEmpresas', 'EmpresaController@retornaEmpresas')->middleware('autentic');

//rotas de login
Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');

//rotas de tratamento de tipoDespesas
Route::get('/tipo-despesas', 'TipoDespesaController@index')
    ->name('tiposDespesas.index')
    ->middleware('autentic');

Route::post('/tipo-despesas', 'TipoDespesaController@store')
    ->name('tipoDespesas.store')
    ->middleware('autentic');





//logout
Route::get('/sair', function(){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/entrar');
});
