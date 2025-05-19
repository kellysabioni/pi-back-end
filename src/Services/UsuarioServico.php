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
    public function inserir(Usuario $usuario): void
    {
        $sql = "
        INSERT INTO usuarios (nome,email,senha)
        VALUES (:nome,:usuario,:senha)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $usuario->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(":usuario", $usuario->getEmail(), PDO::PARAM_STR);
            $consulta->bindValue(":senha", password_hash($usuario->getSenha(), PASSWORD_DEFAULT), PDO::PARAM_STR);
            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao inserir usuário: " . $erro->getMessage());
        }
    }

    // Validação de login
    public function validarLogin(string $email, string $senha): ?Usuario
    {

        try {
            $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":email", $email, PDO::PARAM_STR);
            $consulta->execute();
            $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                return new Usuario(
                    $usuario['id'],
                    $usuario['nome'],
                    $usuario['email'],
                    $usuario['senha'],
                    $usuario['created_at'] ?? null,
                    $usuario['updated_at'] ?? null
                );
            }
        } catch (Throwable $erro) {
            error_log($erro->getMessage()); // para log interno
            throw new Exception("Erro ao tentar efetuar login. Tente novamente.");
        }

    }
}

