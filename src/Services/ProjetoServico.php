<?php

namespace ProjetaBD\Services;

use Exception, PDO, Throwable;
use ProjetaBD\Database\ConexaoBD;
use ProjetaBD\Models\Projeto;

class ProjetoServico
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = ConexaoBD::getConexao();
    }

    public function getConexao(): PDO
    {
        return $this->conexao;
    }

    public function inserir(Projeto $projeto): void
    {
        $sql = "INSERT INTO projetos(
        nome, CEP, rua, numero, bairro, cidade, UF, telefone, categoria, usuarios_id)
        VALUES (
        :nome, :CEP, :rua, :numero, :bairro, :cidade, :UF, :telefone, :categoria, :usuarios_id)";

        try {
            $consulta = $this->conexao->prepare($sql);

            $consulta->bindValue(":nome", $projeto->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(":CEP", $projeto->getCEP(), PDO::PARAM_STR);
            $consulta->bindValue(":rua", $projeto->getRua(), PDO::PARAM_STR);
            $consulta->bindValue(":numero", $projeto->getNumero(), PDO::PARAM_STR);
            $consulta->bindValue(":bairro", $projeto->getBairro(), PDO::PARAM_STR);
            $consulta->bindValue(":cidade", $projeto->getCidade(), PDO::PARAM_STR);
            $consulta->bindValue(":UF", $projeto->getUF(), PDO::PARAM_STR);
            $consulta->bindValue(":telefone", $projeto->getTelefone(), PDO::PARAM_STR);
            $consulta->bindValue(":categoria", $projeto->getCategoria()->name, PDO::PARAM_STR);
            $consulta->bindValue(":usuarios_id", $projeto->getUsuariosId(), PDO::PARAM_STR);

            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao inserir projeto: " . $erro->getMessage());
        }
    }

    public function listarTodos(): array
    {
        $sql = "SELECT projetos.*,
        usuarios.id AS usuario_id,
        usuarios.nome AS usuario_nome,
        fotos.nome_arquivo AS imagem
        FROM 
        projetos
        LEFT JOIN usuarios ON projetos.usuarios_id = usuarios.id
        LEFT JOIN fotos ON projetos.id = fotos.projetos_id
        ORDER BY projetos.created_at DESC";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("ERRO: " . $erro->getMessage());
        }
    }

    public function listarTodosUser(int $id): array
    {
        $sql = "SELECT projetos.*
        FROM 
        projetos
        WHERE usuarios_id = :id
        ORDER BY projetos.created_at DESC";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("ERRO: " . $erro->getMessage());
        }
    }


    public function contarProjetos(int $id)
    {
        $sql = "SELECT COUNT(*) AS total_projetos FROM projetos WHERE usuarios_id = :usuarios_id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":usuarios_id", $id, PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $erro) {
            throw new Exception("Erro ao listar projetos do perfil: " . $erro->getMessage());
        }
    }

    public function projetosPerfil(int $id): array
    {
        $sql = "SELECT 
                    projetos.*,
                    usuarios.id AS usuario_id,
                    usuarios.nome AS usuario_nome,
                    fotos.nome_arquivo AS imagem
                FROM projetos
                LEFT JOIN usuarios ON projetos.usuarios_id = usuarios.id
                LEFT JOIN fotos ON projetos.id = fotos.projetos_id AND fotos.usuarios_id = projetos.usuarios_id
                WHERE projetos.usuarios_id = :usuarios_id
                ORDER BY projetos.created_at DESC";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':usuarios_id', $id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("ERRO: " . $erro->getMessage());
        }
    }

    public function excluir(int $id): void {
        $sql = "DELETE FROM projetos WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();

        } catch (Exception $erro) {
            die("Erro ao excluir projeto: ".$erro->getMessage());
        }
    }

    public function listarUm(int $id): array
    {
        $sql = "SELECT projetos.*,
                    usuarios.id AS usuario_id,
                    usuarios.nome AS usuario_nome,
                    fotos.nome_arquivo AS imagem
                FROM projetos
                LEFT JOIN usuarios ON projetos.usuarios_id = usuarios.id
                LEFT JOIN fotos ON projetos.id = fotos.projetos_id
                WHERE projetos.id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("Erro ao buscar projeto: " . $erro->getMessage());
        }
    }

    public function atualizar(Projeto $projeto): void
    {
        $sql = "UPDATE projetos SET
            nome = :nome,
            CEP = :CEP,
            rua = :rua,
            numero = :numero,
            bairro = :bairro,
            cidade = :cidade,
            UF = :UF,
            telefone = :telefone,
            categoria = :categoria,
            updated_at = :updated_at
            WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);

            $consulta->bindValue(":nome", $projeto->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(":CEP", $projeto->getCEP(), PDO::PARAM_STR);
            $consulta->bindValue(":rua", $projeto->getRua(), PDO::PARAM_STR);
            $consulta->bindValue(":numero", $projeto->getNumero(), PDO::PARAM_STR);
            $consulta->bindValue(":bairro", $projeto->getBairro(), PDO::PARAM_STR);
            $consulta->bindValue(":cidade", $projeto->getCidade(), PDO::PARAM_STR);
            $consulta->bindValue(":UF", $projeto->getUF(), PDO::PARAM_STR);
            $consulta->bindValue(":telefone", $projeto->getTelefone(), PDO::PARAM_STR);
            $consulta->bindValue(":categoria", $projeto->getCategoria()->name, PDO::PARAM_STR);
            $consulta->bindValue(":updated_at", $projeto->getUpdatedAt(), PDO::PARAM_STR);
            $consulta->bindValue(":id", $projeto->getId(), PDO::PARAM_INT);

            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao atualizar projeto: " . $erro->getMessage());
        }
    }
}
