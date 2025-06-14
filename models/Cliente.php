<?php

namespace models;

class Cliente{

    public int $idCliente;
    public string $nomeCliente;
    public string $cpf;
    public string $telefone;

    public function __construct(string $nome, string $cpf, string $telefone){
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
    }

    public function getId() : int{
        return $this->idCliente;
    }
    
}

?>