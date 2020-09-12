<?php

use App\Services\Session;
use App\Services\ValidadorEmpressAuth;
use Illuminate\Support\Facades\{Auth, Route, View};

Route::get('/', 'PainelController@index')->name('painel.index')->middleware('autentic');


Route::group(['middleware' => ['autentic','admin',]], function () {
    Route::resource('usuarios', 'UsuarioController')->except([
        'edit', 'show', 'create'
    ]);
    //rota personalisada usuarios
    Route::get('/usuarios/{usuario}/empresas', 'UsuarioController@usuariosEmpresasIndex');
    Route::post('/usuarios/{usuario}/empresas', 'UsuarioController@usuariosEmpresasUpdate');

    Route::resource('empresas', 'EmpresaController')->except([
        'edit', 'show', 'create'
    ]);

    Route::resource('plano-contas', 'PlanoContaController')->except([
        'edit', 'show', 'create'
    ]);

    Route::resource('tipo-despesas', 'TipoDespesaController')->except([
        'edit', 'show', 'create'
    ]);

});
//retorno empresa
Route::get('/empresas/retorna-empresas', 'EmpresaController@retornaEmpresas')->middleware('autentic');
Route::post('/empresas/troca-empresa-atual', 'EmpresaController@trocaEmpresaAtual')->middleware('autentic');
Route::get('/plano-contas/retorna-contas', 'PlanoContaController@retornaContas')->middleware('autentic');

Route::group(['middleware' => ['autentic','user']], function () {
    Route::resource('/despesas', 'DespesaController')->except([
        'edit', 'show', 'create'
    ]);
    Route::get('/despesas/exportacao-excel','DespesaController@exportExcelDespesas');

    Route::resource('/documentos', 'DocumentoController')->except([
        'edit', 'show', 'create'
    ]);
});
Route::get('/tipo-despesas/retorna-tipo-despesas','TipoDespesaController@retornaTipoDespesas')->middleware('autentic');
Route::post('/despesas/seta-intervalo-table','DespesaController@setaIntervaloTable')->middleware('autentic');
Route::post('/documentos/seta-intervalo-table','DocumentoController@setaIntervaloTable')->middleware('autentic');

Route::get('/sessoes', function (Session $sessoes){
   //$sessoes->getIntervaloBuscaGrid();
//    $data = [
//        "tableDataInicio" => '03/09/2020',
//        "tableDataFim" => '04/09/2020'
//    ];

   dd(session()->all());
});
Route::get('/sessoes-zera-intervalo', function (Session $sessoes){
    session()->forget('tableDataInicio');
    session()->forget('tableDataFim');
});





//rotas de login
Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');


//logout
Route::get('/sair', function(){
    session()->forget('tableDataInicio');
    session()->forget('tableDataFim');
    session()->forget('empresaAtual');
    session()->forget('empresasUsuario');


    \Illuminate\Support\Facades\Auth::logout();

    return redirect('/entrar');

});

View::composer(['*'], function($view){


});
