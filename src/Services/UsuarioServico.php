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

        public function getConexao(): PDO {
        return $this->conexao;
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
        // Validação do CPF antes de atualizar o banco
        if (!$this->validarCPF($usuario->getCpf())) {
            throw new Exception("CPF inválido! Cadastro não pode ser atualizado.");
        }

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

    private function validarCPF($cpf): bool
    {
        // Remove todos os caracteres que não são números
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se o CPF tem exatamente 11 dígitos e se não é uma sequência repetida (ex: "11111111111")
        if (strlen($cpf) != 11 || preg_match('/^(\d)\1{10}$/', $cpf)) return false;

        // Cálculo do primeiro dígito verificador
        for ($t = 9, $soma = 0, $i = 0; $i < $t; $i++) {
            $soma += $cpf[$i] * (($t + 1) - $i); // Multiplica cada número do CPF por pesos decrescentes de 10 a 2
        }
        $digito1 = ($soma * 10) % 11;
        if ($digito1 == 10) $digito1 = 0; // Se o resto for 10, o dígito deve ser 0

        // Cálculo do segundo dígito verificador
        for ($t = 10, $soma = 0, $i = 0; $i < $t; $i++) {
            $soma += $cpf[$i] * (($t + 1) - $i); // Multiplica cada número do CPF por pesos decrescentes de 11 a 2
        }
        $digito2 = ($soma * 10) % 11;
        if ($digito2 == 10) $digito2 = 0; // Se o resto for 10, o dígito deve ser 0

        // Verifica se os dígitos calculados coincidem com os dígitos fornecidos no CPF
        return ($cpf[9] == $digito1 && $cpf[10] == $digito2);
    }

    /*     public function completarCadastro(Usuario $usuario): void
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
     */    
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

    public function buscarPorId(int $id): ?array
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (Throwable $e) {
            throw new Exception("Erro ao buscar usuário por ID.");
        }
    }
}

