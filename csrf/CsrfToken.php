<?php

namespace csrf;

class CsrfToken{

    private const tokenKey = "csrf_token";
    private const tokenField = "_csrf_token";

    public static function gerar(){
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(empty($_SESSION[self::tokenKey])){
            $_SESSION[self::tokenKey] = bin2hex(random_bytes(32));

        }

        return $_SESSION[self::tokenKey];
    }

    public static function validar($tokenReq){
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $token = $_SESSION[self::tokenKey] ?? '';
        
        return hash_equals($token, $tokenReq);

    }

    public static function hiddenHtml(){
        return '<input type="hidden" name="' . self::tokenField . '" value="' . self::gerar() . '">';
    }
    
}

?>