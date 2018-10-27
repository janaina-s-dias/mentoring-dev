<?php

namespace App\Http\Controllers;

class ValidarCPF extends Controller
{
    public static function validarCPF($cpf)
    {
        $multiplicador1 = array(10, 9, 8, 7, 6, 5, 4, 3, 2 );
        $multiplicador2 = array( 11, 10, 9, 8, 7, 6, 5, 4, 3, 2 );
        $tempCpf;
        $digito;
        $soma;
        $resto;
        $cpf = $cpf->trim();
        $cpf = str_replace(".", "", $cpf);
        $cpf = str_replace("-", "", $cpf);
        if (strlen($cpf) != 11)
            return false;
        $tempCpf = substr($cpf, 0, 9);
        $soma = 0;

        for ($i = 0; $i < 9; $i++)
            $soma += intval($tempCpf[$i]."") * $multiplicador1[$i];
        $resto = $soma % 11;
        if ($resto < 2)
            $resto = 0;
        else
            $resto = 11 - $resto;
        $digito = $resto."";
        $tempCpf = $tempCpf + $digito;
        $soma = 0;
        for ($i = 0; $i < 10; $i++)
            $soma += intval($tempCpf[$i]."") * $multiplicador2[$i];
        $resto = $soma % 11;
        if ($resto < 2)
            $resto = 0;
        else
            $resto = 11 - $resto;
        $digito = $digito + $resto."";
        return $this->endsWith($cpf, $digito);
    }

	function endsWith( $str, $sub ) {
   		return ( substr( $str, strlen( $str ) - strlen( $sub ) ) === $sub );
	}
}