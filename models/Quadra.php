<?php

namespace models;

use DbConfig;

class Quadra{

    public int $id;

    public string $nome;

    public string $tipo;

    public bool $reservado;

    public function __construct(string $nome, string $tipo, bool $reservado){
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->reservado = $reservado;
    }

    public function getId(): int{
        return $this->id;
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