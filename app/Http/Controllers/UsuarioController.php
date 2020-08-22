<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditarRequest;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    private $tableLayout;
    public function __construct()
    {
        $this->tableLayout = true;
    }

    public function index(Request $request)
    {
        $tableLayout = $this->tableLayout;
//        $usuarios = User::query()->orderBy('name')->with('empresa')->get();
        $usuarios = User::query()->orderBy('name')->get();
        $mensagemAlerta = $request->session()->get("mensagemAlerta");
        return view("usuarios.index", compact('tableLayout', 'usuarios', 'mensagemAlerta'));
    }

    public function store( UserRequest $request )
    {
        //pego todas variaveis do request menos o token
        $data = $request->except('_token');
        //encripgrafa a senha
        $data['password'] =  Hash::make($data['password']);
        //cria um user e ja instancia ele
        $user = User::create($data);
        //flash mensagem top
        $request->session()->flash('mensagemAlerta', "Usuario ". $user->name ." cadastrado com sucesso!" );

        return redirect()->route('usuarios.index');
    }

    public function update(UserEditarRequest $request, int $usuarioId)
    {
        $usuario = User::find($usuarioId);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->tipo = $request->tipo;
        $usuario->empresa_id = $request->empresa_id;
        if($request->tipo){
            $usuario->password = Hash::make($request->password);
        }
        $usuario->save();
        $request->session()->flash('mensagemAlerta', "A Usuario alterado com sucesso!");
        return redirect()->route('usuarios.index');

    }

    public function destroy(int $id, Request $request)
    {
        User::destroy($id);
        $request->session()->flash('mensagemAlerta', "Usuário removido com sucesso");

        return redirect()->route('usuarios.index');
    }
}
