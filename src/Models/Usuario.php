<?php
namespace ProjetaBD\Models;

class Usuario {
    private string $nome;
    private string $email;
    private string $senha;
    private ?string $tipo_usuario;   
    private ?int $id;
    private ?string $cpf;
    private ?string $data_nascimento; 
    private ?string $created_at;
    private ?string $updated_at;
    private ?string $imagem;

    public function __construct(  
        string $nome, 
        string $email, 
        string $senha, 
        ?string $tipo_usuario = null, 
        ?int $id = null, 
        ?string $cpf = null, 
        ?string $data_nascimento = null, 
        ?string $created_at = null,
        ?string $updated_at = null,
    ) {
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSenha($senha);
        $this->setTipoUsuario($tipo_usuario);
        $this->setId($id);
        $this->setCpf($cpf);
        $this->setDataNascimento($data_nascimento);
        $this->setCreatedAt($created_at);
        $this->setUpdatedAt($updated_at);
    }

    public function getNome(): string {return $this->nome;}
    public function getEmail(): string {return $this->email;}
    public function getSenha(): string {return $this->senha;}
    public function getTipoUsuario(): ?string{return $this->tipo_usuario;}
    public function getId(): ?int {return $this->id;}
    public function getCpf():?string{return $this->cpf;}
    public function getDataNascimento(): ?string {return $this->data_nascimento;}
    public function getCreatedAt(): ?string {return $this->created_at; }
    public function getUpdatedAt(): ?string {return $this->updated_at;}

    private function setNome(string $nome): void {$this->nome = $nome;}
    private function setEmail(string $email): void {$this->email= $email;}
    private function setSenha(string $senha): void {$this->senha = $senha;}
    private function setTipoUsuario(?string $tipo_usuario):void{$this->tipo_usuario = $tipo_usuario;}
    private function setId(?int $id):void {$this->id = $id;}
    private function setCpf(?string $cpf):void{$this->cpf = $cpf;}
    private function setDataNascimento(?string $data_nascimento):void{$this->data_nascimento = $data_nascimento;}
    private function setCreatedAt(?string $created_at):void {$this->created_at = $created_at;}
    private function setUpdatedAt(?string $updated_at):void {$this->updated_at = $updated_at;}
}