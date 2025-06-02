<?php

class Cliente{

    public int $id;
    public string $nome;
    public string $senha;
    public string $cpf;
    public string $telefone;

    public function __construct(string $nome, string $cpf, string $telefone){
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
    }

    

}

?>