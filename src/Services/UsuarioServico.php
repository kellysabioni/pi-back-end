<?php

namespace ProjetaBD\Services;

use Exception;
use PDO;
use PDOException;
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

    public function inserir(Usuario $usuario): void
    {
        try {
            // Verificação de e-mail duplicado
            $sqlVerifica = "SELECT COUNT(*) AS total FROM usuarios WHERE email = :email";
            $consultaVerifica = $this->conexao->prepare($sqlVerifica);
            $consultaVerifica->bindValue(":email", $usuario->getEmail(), PDO::PARAM_STR);
            $consultaVerifica->execute();

            $resultado = $consultaVerifica->fetch(PDO::FETCH_ASSOC);

            if ($resultado && $resultado['total'] > 0) {
                echo "<script>alert('E-mail já cadastrado.');</script>";
                throw new Exception("E-mail já cadastrado.");
                return;
            }

            // Inserção do novo usuário
            $sqlInserir = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $consultaInserir = $this->conexao->prepare($sqlInserir);
            $consultaInserir->bindValue(":nome", $usuario->getNome(), PDO::PARAM_STR);
            $consultaInserir->bindValue(":email", $usuario->getEmail(), PDO::PARAM_STR);
            $consultaInserir->bindValue(":senha", password_hash($usuario->getSenha(), PASSWORD_DEFAULT), PDO::PARAM_STR);
            $consultaInserir->execute();

        } catch (PDOException $e) {
            throw new Exception("Erro ao inserir usuário: " . $e->getMessage());
        }
    }

    // Completar cadastro de usuario (atualiza tipo de usuario para 'cadastro', cpf e data de nascimento)
    public function completarCadastro(Usuario $usuario): void
    {
        $sql = "
        UPDATE usuarios
        SET 
        nome = :nome,
        email = :email,
        tipo_usuario = :tipo_usuario,
        cpf = :cpf, 
        data_nascimento = :data_nascimento,
        updated_at = NOW()
        WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $usuario->getId(), PDO::PARAM_INT);
            $consulta->bindValue(":nome", $usuario->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(":email", $usuario->getEmail(), PDO::PARAM_STR);
            $consulta->bindValue(":tipo_usuario", $usuario->getTipoUsuario(), PDO::PARAM_STR);
            $consulta->bindValue(":cpf", $usuario->getCpf(), PDO::PARAM_STR);
            $consulta->bindValue(":data_nascimento", $usuario->getDataNascimento(), PDO::PARAM_STR);
            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao atualizar usuário: " . $erro->getMessage());
        }
    }
    
    public function buscarPorEmail(string $email): ?array
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":email", $email, PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (Throwable $e) {
            
            throw new Exception("Erro ao buscar usuário por e-mail.");
        }
    }
}

