<?php 
namespace ProjetaBD\Models;

class Evento {
    private int $id;
    private string $nome;
    private string $descricao;
    private string $data;
    private string $cep;
    private string $rua;
    private int $numero;
    private string $bairro;
    private string $cidade;
    private string $uf;
    private string $telefone;
    private ?int $usuarios_id;
    private ?int $projetos_id;

    public function __construct(int $id, string $nome, string $descricao, string $data, string $cep, string $rua, string $numero, string $bairro, string $cidade, string $uf, string $telefone, ?int $usuarios_id = null, ?int $projetos_id = null )
    {
        
    }
}