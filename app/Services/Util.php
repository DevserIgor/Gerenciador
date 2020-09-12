<?php


namespace App\Services;


class Util
{

    public static function validaData($databr){
        if(!empty($databr)){
            $data = explode("/", $databr);
            $valida = checkdate((int)$data[1], (int)$data[0], (int)$data[2]);
            $dataing = $data[2]."-".$data[1]."-".$data[0];
            if($valida){
                return $dataing;
            }
        }

        return false;
    }
}
