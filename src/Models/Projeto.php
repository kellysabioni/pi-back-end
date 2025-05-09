<?php 
namespace ProjetaBD\Models;

class Projeto{
    private string $nome;
    private string $CEP;
    private string $rua;
    private string $numero;
    private string $bairro;
    private string $cidade;
    private string $UF;
    private string $telefone;
    private string $categoria; 
    private ?int $usuarios_id;
    private ?int $eventos_id;

    public function __construct(int $id , string $nome, string $CEP, string $rua, string $numero, string $bairro, string $cidade, string $UF, string $telefone, string $categoria, ?int $usuarios_id = null, ?int $eventos_id = null) {
        $this-> setNome ($nome);
        $this-> setCEP ($CEP);
        $this-> setRua ($rua);
        $this-> setNumero ($numero);
        $this-> setBairro ($bairro);
        $this-> setCidade ($cidade);
        $this-> setUF($UF);
        $this-> setTelefone($telefone);
        $this-> setCategoria ($categoria);
        $this-> setUsuariosId ($usuarios_id);
        $this-> setEventosId ($eventos_id);
    }

    public function getNome(): string {return $this->nome;}
    public function getCEP(): string {return $this->CEP;}
    public function getRua(): string {return $this->rua;}
    public function getNumero(): string {return $this->numero;}
    public function getBairro(): string {return $this->bairro;}
    public function getCidade(): string {return $this->cidade;}
    public function getUF(): string {return $this->UF;}
    public function getTelefone(): string {return $this->telefone;}
    public function getCategoria(): string {return $this->categoria;}
    public function getUsuariosId(): string {return $this->usuarios_id;}
    public function getEventosId(): string {return $this->eventos_id;}

    public function setNome(): string {return $this->nome;}
    public function setCEP(): string {return $this->CEP;}
    public function setRua(): string {return $this->rua;}
    public function setNumero(): string {return $this->numero;}
    public function setBairro(): string {return $this->bairro;}
    public function setCidade(): string {return $this->cidade;}
    public function setUF(): string {return $this->UF;}
    public function setTelefone(): string {return $this->telefone;}
    public function setCategoria(): string {return $this->categoria;}
    public function setUsuariosId(): string {return $this->usuarios_id;}
    public function setEventosId(): string {return $this->eventos_id;}
}