<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    public function create()
    {
        return view("registro.create");
    }

    public function store( Request $request )
    {
        //pego todas variaveis do request menos o token
        $data = $request->except('_token');
        //encripgrafa a senha
        $data['password'] =  Hash::make($data['password']);
        //cria um user e ja instancia ele
        $user = User::create($data);


        //autentica com o user atual
        Auth::login($user);

        return redirect()->route('painel.index');
    }
}
