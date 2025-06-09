<?php

namespace models;

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




}


?>