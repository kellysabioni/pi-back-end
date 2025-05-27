<?php

namespace ProjetaBD\Models;

use ProjetaBD\Enums\Categoria;

class Evento
{
    private string $nome;
    private string $descricao;
    private string $data;
    private string $hora;
    private string $CEP;
    private string $rua;
    private string $numero;
    private string $bairro;
    private string $cidade;
    private string $UF;
    private string $telefone;
    private Categoria $categoria;
    private ?int $projetos_id;
    private ?int $usuarios_id;
    private ?string $created_at;
    private ?string $updated_at;
    private ?int $id;

    public function __construct(
        string $nome, 
        string $descricao, 
        string $data, 
        string $hora, 
        string $CEP, 
        string $rua, 
        string $numero, 
        string $bairro, 
        string $cidade, 
        string $UF, 
        string $telefone, 
        Categoria $categoria = Categoria::Indefinido, // checar
        ?int $projetos_id = null, // checar
        string $created_at, 
        string $updated_at,  
        ?int $usuarios_id = null, 
        ?int $id = null)
    {
        $this->setId($id);
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setData($data);
        $this->setHora($hora);
        $this->setCEP($CEP);
        $this->setRua($rua);
        $this->setNumero($numero);
        $this->setBairro($bairro);
        $this->setCidade($cidade);
        $this->setUF($UF);
        $this->setTelefone($telefone);
        $this->setCategoria($categoria);
        $this->setCreatedAt($created_at);
        $this->setUpdatedAt($updated_at);
        $this->setUsuarios_id($usuarios_id);
        $this->setProjetos_id($projetos_id);
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNome(): string
    {
        return $this->nome;
    }
    public function getDescricao(): string
    {
        return $this->descricao;
    }
    public function getData(): string
    {
        return $this->data;
    }
    public function getHora(): string
    {
        return $this->hora;
    }
    public function getCEP(): string
    {
        return $this->CEP;
    }
    public function getRua(): string
    {
        return $this->rua;
    }
    public function getNumero(): string
    {
        return $this->numero;
    }
    public function getBairro(): string
    {
        return $this->bairro;
    }
    public function getCidade(): string
    {
        return $this->cidade;
    }
    public function getUF(): string
    {
        return $this->UF;
    }
    public function getTelefone(): string
    {
        return $this->telefone;
    }
    public function getCategoria(): Categoria
    {
        return $this->categoria;
    }
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
    public function getUsuarios_id(): ?int
    {
        return $this->usuarios_id;
    }
    public function getProjetos_id(): ?int
    {
        return $this->projetos_id;
    }

    private function setId(?int $id): void
    {
        $this->id = $id;
    }
    private function setNome(string $nome): void
    {
        $this->nome = $nome;
    }
    private function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }
    private function setData(string $data): void
    {
        $this->data = $data;
    }
    private function setHora(string $hora): void
    {
        $this->hora = $hora;
    }
    private function setCEP(string $CEP): void
    {
        $this->CEP = $CEP;
    }
    private function setRua(string $rua): void
    {
        $this->rua = $rua;
    }
    private function setNumero(string $numero): void
    {
        $this->numero = $numero;
    }
    private function setBairro(string $bairro): void
    {
        $this->bairro = $bairro;
    }
    private function setCidade(string $cidade): void
    {
        $this->cidade = $cidade;
    }
    private function setUF(string $UF): void
    {
        $this->UF = $UF;
    }
    private function setTelefone(string $telefone): void
    {
        $this->telefone = $telefone;
    }
    protected function setCategoria(Categoria $categoria): void
    {
        $this->categoria = $categoria;
    }
    private function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }
    private function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
    private function setUsuarios_id(?int $usuarios_id): void
    {
        $this->usuarios_id = $usuarios_id;
    }
    private function setProjetos_id(?int $projetos_id): void
    {
        $this->projetos_id = $projetos_id;
    }
}
