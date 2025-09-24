<?php

class User
{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;

    public function __construct(int $id, string $nome, string $email, string $senha)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }


    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }
}
?>