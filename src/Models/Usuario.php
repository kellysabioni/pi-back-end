<?php
namespace ProjetaBD\Models;

class Usuario {
    private ?int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private ?string $created_at;
    private ?string $updated_at;

    public function __construct(  string $nome, string $email, string $senha ,?int $id = null, ?string $created_at = null ,?string $updated_at= null)
    {
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSenha($senha);
        $this->setId($id);
        $this->setCreatedAt($created_at);
        $this->setUpdatedAt($updated_at) ;
    }

    public function getNome(): string {return $this->nome;}
    public function getEmail(): string {return $this->email;}
    public function getSenha(): string {return $this->senha;}
    public function getId(): ?int {return $this->id;}
    public function getCreatedAt(): ?string {return $this->created_at; }
    public function getUpdatedAt(): ?string {return $this->updated_at;}

    private function setNome(string $nome): void {$this->nome = $nome;}
    private function setEmail(string $email): void {$this->email= $email;}
    private function setSenha(string $senha): void {$this->senha = $senha;}
    private function setId(?int $id): void {$this->id = $id;}
    private function setCreatedAt(?string $created_at):void {$this->created_at = $created_at;}
    public function setUpdatedAt(?string $updated_at):void {$this->updated_at = $updated_at; }

}