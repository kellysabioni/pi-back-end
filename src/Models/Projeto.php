<?php 
namespace ProjetaBD\Models;

use ProjetaBD\Enums\Categoria;

class Projeto{
    private ?int $id;
    private string $nome;
    private string $CEP;
    private string $rua;
    private string $numero;
    private string $bairro;
    private string $cidade;
    private string $UF;
    private string $telefone;
    private Categoria $categoria; 
    private string $created_at;
    private string $updated_at; 
    private ?int $usuarios_id;
    private ?int $eventos_id;

    public function __construct( string $nome, string $CEP, string $rua, string $numero, string $bairro, string $cidade, string $UF, string $telefone, Categoria $categoria = Categoria::Indefinido , string $created_at, string $updated_at , ?int $usuarios_id = null, ?int $eventos_id = null, ?int $id = null ,) {
        $this-> setId ($id);
        $this-> setNome ($nome);
        $this-> setCEP ($CEP);
        $this-> setRua ($rua);
        $this-> setNumero ($numero);
        $this-> setBairro ($bairro);
        $this-> setCidade ($cidade);
        $this-> setUF($UF);
        $this-> setTelefone($telefone);
        $this-> setCategoria ($categoria);
        $this-> setCreatedAt (date('d/m/Y H:i:s'));
        $this-> setUpdatedAt (date('d/m/Y H:i:s'));
        $this-> setUsuariosId ($usuarios_id);
        $this-> setEventosId ($eventos_id);
    }

    public function getId(): ?int {return $this->id;}
    public function getNome(): string {return $this->nome;}
    public function getCEP(): string {return $this->CEP;}
    public function getRua(): string {return $this->rua;}
    public function getNumero(): string {return $this->numero;}
    public function getBairro(): string {return $this->bairro;}
    public function getCidade(): string {return $this->cidade;}
    public function getUF(): string {return $this->UF;}
    public function getTelefone(): string {return $this->telefone;}
    public function getCategoria(): Categoria {return $this->categoria;}
    public function getCreatedAt(): string {return $this->created_at;}
    public function getUpdatedAt(): string {return $this->updated_at;}
    public function getUsuariosId(): ?int {return $this->usuarios_id;}
    public function getEventosId(): ?int {return $this->eventos_id;}

    private function setId(?int $id): void { $this->id = $id;}
    private function setNome(string $nome): void { $this->nome = $nome;}
    private function setCEP(string $CEP): void { $this->CEP = $CEP;}
    private function setRua(string $rua): void { $this->rua = $rua ;}
    private function setNumero(string $numero): void { $this->numero = $numero;}
    private function setBairro(string $bairro): void { $this->bairro = $bairro;}
    private function setCidade(string $cidade): void { $this->cidade = $cidade;}
    private function setUF(string $UF): void { $this->UF = $UF;}
    private function setTelefone(string $telefone): void { $this->telefone = $telefone;}
    protected function setCategoria(Categoria $categoria): void { $this->categoria = $categoria;}
    private function setCreatedAt(string $created_at): void { $this->created_at = $created_at;}
    private function setUpdatedAt(string $updated_at): void { $this->updated_at = $updated_at;}
    private function setUsuariosId(?int $usuarios_id): void { $this->usuarios_id = $usuarios_id;}
    private function setEventosId(?int $eventos_id): void { $this->eventos_id = $eventos_id;}
}