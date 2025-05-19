<?php

namespace ProjetaBD\Services;

use Exception;
use PDO;
use ProjetaBD\Database\ConexaoBD;
use ProjetaBD\Models\Usuario;
use Throwable;

class UsuarioServico
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = ConexaoBD::getConexao();
    }

    // inserir um registro de novo usuario
    public function inserir(Usuario $usuario): void{
        $sql = "
        INSERT INTO usuarios (nome,email,senha)
        VALUES (:nome,:email,:senha)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $usuario->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(":email", $usuario->getEmail(), PDO::PARAM_STR);
            $consulta->bindValue(":senha", password_hash($usuario->getSenha(), PASSWORD_DEFAULT), PDO::PARAM_STR);
            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao inserir usuário: " . $erro->getMessage());
        }
    }
}