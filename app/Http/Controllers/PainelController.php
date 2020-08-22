<?php

namespace App\Http\Controllers;

use App\Traits\PermissionUserTrait;
use Illuminate\Http\Request;

class PainelController extends Controller
{

    public function index()
    {
        return view('painel.index');
    }
}
