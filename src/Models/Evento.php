<?php 
namespace ProjetaBD\Models;
use ProjetaBD\Enums\Categoria;

class Evento {
    private int $id;
    private string $nome;
    private string $descricao;
    private string $data;
    private string $CEP;
    private string $rua;
    private string $numero;
    private string $bairro;
    private string $cidade;
    private string $UF;
    private string $telefone;
    private Categoria $categoria;
    private ?int $usuarios_id;
    private ?int $projetos_id;

    public function __construct( int $id, string $nome, string $descricao, string $data, string $CEP, string $rua, string $numero, string $bairro, string $cidade, string $UF, string $telefone, Categoria $categoria = Categoria::Indefinido, ?int $usuarios_id = null, ?int $projetos_id = null )
    {
        $this->setId($id);
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setData($data);
        $this->setCEP($CEP);
        $this->setRua($rua);
        $this->setNumero($numero);
        $this->setBairro($bairro);
        $this->setCidade($cidade);
        $this->setUF($UF);
        $this->setTelefone($telefone);
        $this->setCategoria($categoria);
        $this->setUsuarios_id($usuarios_id);
        $this->setProjetos_id($projetos_id);
    }

    public function getId(): int
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

    public function getCategoria(): Categoria {
        return $this->categoria;
    }

    public function getUsuarios_id(): ?int
    {
        return $this->usuarios_id;
    }

    public function getProjetos_id(): ?int
    {
        return $this->projetos_id;
    }
}