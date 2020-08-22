<?php

namespace App\Traits;

trait PermissionUserTrait {

    public function tipoUser() {
        return auth()->user()->tipo;
    }
}
