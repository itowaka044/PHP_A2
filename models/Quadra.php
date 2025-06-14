<?php

namespace models;

use DbConfig;

class Quadra{

    public int $idQuadra;

    public string $nomeQuadra;

    public string $tipo;
    
    public int $valorHora;

    public function __construct(string $nome, string $tipo, bool $reservado){
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->reservado = $reservado;
    }

    public function getId(): int{
        return $this->idQuadra;
    }

    public static function criarQuadrasDb(){

        $db = DbConfig::getConn();

        $teste = $db->query('select * from quadras;');

        if(!$teste){

            $statement = $db->query('insert into quadras (quadraId, quadraNome, quadraTipo) VALUES
                                    (1, "society aberto", "society"),
                                    (2, "society coberto", "society"),
                                    (3, "futsal coberto", "futsal");');

        }

    }

}


?>