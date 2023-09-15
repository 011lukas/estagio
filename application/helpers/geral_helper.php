<?php
defined('BASEPATH') or exit('No direct script access allowed');

function verificarParam($atributos, $lista){
    foreach($lista as $key => $value){
        if(array_key_exists($key, get_object_vars($atributos))){
            $estatus = 1;
        }else{ 
            $estatus = 0;
            break;
        }
    }

    if (count(get_object_vars($atributos)) != count($lista)){
        $estatus = 0;    
    }

    return $estatus;
}

?>

