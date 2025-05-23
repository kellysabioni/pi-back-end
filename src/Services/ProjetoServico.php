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

    public function getConexao(): PDO {
        return $this->conexao;
    }

    public function inserir(Projeto $projeto): void {
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
            $consulta->bindValue(":categoria", $projeto->getCategoria()->value, PDO::PARAM_STR);
            $consulta->bindValue(":usuarios_id", $projeto->getUsuariosId(), PDO::PARAM_STR);
            
            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao inserir projeto: ".$erro->getMessage());
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
}