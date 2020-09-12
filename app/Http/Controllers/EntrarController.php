<?php

namespace App\Http\Controllers;

use App\Services\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EntrarController extends Controller
{
    public function index(Request $request)
    {
        return view('entrar/index');
    }

    public function entrar(Request $request, Session $sessoes)
    {
        if(!Auth::attempt($request->only(['email', 'password']))){
            return redirect()->back()->withErrors('Usuário e/ou senhas incorretors');
        }
        $sessoes->buscarEmpresas();
        $sessoes->sessionEmpresaAtual();
        $sessoes->getIntervaloBuscaGrid();
        return redirect()->route('painel.index');
    }
}
