<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Services\BuscadorEmpresasDisponiveisUsuario;
use Illuminate\Http\Request;

class PainelController extends Controller
{

    public function index()
    {
        return view('painel.index');
    }
}
