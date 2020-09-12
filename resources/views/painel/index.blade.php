@extends('layout')

@section('conteudo')
    @if(session()->has("empresasUsuario") && session()->has("empresaAtual"))
        <h1>Empresa Atual: {{ session()->get('empresaAtual') }}</h1>
    @else
        @if(Auth::user()->tipo === "fun")
            @if(!session()->has('empresaAtual'))
                <h1>Você precisa de permissão de ao menos 1 empresa</h1>
            @endif
        @endif
    @endif
@endsection
