<?php 
namespace ProjetaBD\Models;

class Evento {
    private int $id;
    private string $nome;
    private string $descricao;
    private string $data;
    private string $cep;
    private string $rua;
    private string $numero;
    private string $bairro;
    private string $cidade;
    private string $uf;
    private string $telefone;
    private Categoria $categoria;
    private ?int $usuarios_id;
    private ?int $projetos_id;

    public function __construct(int $id, string $nome, string $descricao, string $data, string $cep, string $rua, string $numero, string $bairro, string $cidade, string $uf, string $telefone, Categoria $categoria = ?int $usuarios_id = null, ?int $projetos_id = null )
    {
        $this->setId($id);
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setData($data);
        $this->setCep($cep);
        $this->setRua($rua);
        $this->setNumero($numero);
        $this->setBairro($bairro);
        $this->setCidade($cidade);
        $this->setUf($uf);
        $this->setTelefone($telefone);
        $this->setCategoria($categoria);
        $this->setUsuarios_id($usuarios_id);
        $this->setProjetos_id($projetos_id);
    }
}