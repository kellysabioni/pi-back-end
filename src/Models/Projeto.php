<?php 
namespace ProjetaBD\Models;

class Projeto{
    private int $id;
    private string $nome;
    private string $CEP;
    private string $RUA;
    private string $numero;
    private string $bairro;
    private string $cidade;
    private string $UF;
    private string $telefone;
    private string $categoria; 

    public function __construct(int $id = NULL , string $nome, string $CEP, string $RUA, string $numero, string $bairro, string $cidade, string $UF, string $telefone, string $categoria) {
        $this-> setNome ($nome);
        $this-> setCEP ($CEP);
        $this-> setRua ($RUA);
        $this-> setNumero ($numero);
        $this-> setBairro ($bairro);
        $this-> setCidade ($cidade);
        $this-> setUF($UF);
        $this-> setTelefone($telefone);
        $this-> setCategoria ($categoria);
    }

}