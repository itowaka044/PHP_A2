<?php

class Validador {
    
    public static function validarCPF($cpf) {

        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        
        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    public static function validarDataNascimento($data) {
        $timestamp = strtotime($data);
        
        if ($timestamp === false) {
            return false;
        }

        $hoje = new DateTime();
        $dataNascimento = new DateTime($data);

        $idade = $hoje->diff($dataNascimento)->y;

        if ($dataNascimento > $hoje) {
            return false;
        }

        if ($idade > 120 || $idade < 10) {
            return false;
        }

        return true;
    }

    public static function formatarCPF($cpf) {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }

    public static function formatarData($data) {
        return date('d/m/Y', strtotime($data));
    }
}
?>