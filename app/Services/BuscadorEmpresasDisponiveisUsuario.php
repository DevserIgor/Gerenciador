<?php


namespace App\Services;


use App\{Empresa, User};
use Illuminate\Support\Facades\Auth;

class BuscadorEmpresasDisponiveisUsuario
{
    public static function permissoesEmpresasUser()
    {
        if(BuscadorEmpresasDisponiveisUsuario::isAdmin()) return BuscadorEmpresasDisponiveisUsuario::getEmpresas();

        if(BuscadorEmpresasDisponiveisUsuario::isFun())   return BuscadorEmpresasDisponiveisUsuario::getEmpresasUser(Auth::id());

        if(BuscadorEmpresasDisponiveisUsuario::isCli())   return BuscadorEmpresasDisponiveisUsuario::getEmpresaUser(Auth::id());
    }

    public static function getempresas()
    {
        return Empresa::all();
    }

    public static function getEmpresasUser(int $userId)
    {
        $user = User::find($userId);
        return $user->empresas;
    }

    public static function getEmpresaUser(int $userId)
    {
        $user = User::find($userId);
        return $user->empresa;
    }

    public static function isAdmin()
    {
        return auth()->user()->tipo === 'admin';
    }

    public static function isFun()
    {
        return auth()->user()->tipo === 'fun';
    }

    public static function isCli()
    {
        return auth()->user()->tipo === 'user';
    }
}
