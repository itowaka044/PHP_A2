<?php

namespace security;

class CsrfToken{

    public const chaveToken = "csrf_token";
    public const campoOculto = "_csrf_token";

    public static function gerar(){
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(empty($_SESSION[self::chaveToken])){
            $_SESSION[self::chaveToken] = bin2hex(random_bytes(32));

        }

        return $_SESSION[self::chaveToken];
    }

    public static function validar($tokenReq){
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $token = $_SESSION[self::chaveToken] ?? '';
        
        return hash_equals($token, $tokenReq);

    }

    public static function hiddenHtml(){
        return '<input type="hidden" name="' . self::campoOculto . '" value="' . self::gerar() . '">';
    }
    
}

?>