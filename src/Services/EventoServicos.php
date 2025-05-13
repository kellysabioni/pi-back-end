<?php

namespace ProjetaBD\Services;

use Exception;
use ProjetaBD\Database\ConexaoBD;
use PDO;
use Throwable;

class EventoServicos
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = ConexaoBD::getConexao();
    }

    public function listarTodos(): array
    {
        $sql = "SELECT 
    -- Campos da tabela usuarios
    usuarios.*,
    -- Campos da tabela projetos
    projetos.id AS projeto_id,
    projetos.nome AS projeto_nome,
    projetos.CEP AS projeto_CEP,
    projetos.RUA AS projeto_RUA,
    projetos.numero AS projeto_numero,
    projetos.bairro AS projeto_bairro,
    projetos.cidade AS projeto_cidade,
    projetos.UF AS projeto_UF,
    projetos.telefone AS projeto_telefone,
    projetos.categoria AS projeto_categoria,
    projetos.usuarios_id AS projeto_usuarios_id,

    -- Campos da tabela eventos
    eventos.id AS evento_id,
    eventos.nome AS evento_nome,
    eventos.descricao AS evento_descricao,
    eventos.data AS evento_data,
    eventos.CEP AS evento_CEP,
    eventos.RUA AS evento_RUA,
    eventos.numero AS evento_numero,
    eventos.bairro AS evento_bairro,
    eventos.cidade AS evento_cidade,
    eventos.UF AS evento_UF,
    eventos.telefone AS evento_telefone,
    eventos.categoria AS evento_categoria,
    eventos.usuarios_id AS evento_usuarios_id,
    eventos.projetos_id AS evento_projetos_id

FROM 
    usuarios
LEFT JOIN projetos ON projetos.usuarios_id = usuarios.id
LEFT JOIN eventos ON eventos.usuarios_id = usuarios.id
ORDER BY eventos.data DESC;

    ";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("ERRO: " . $erro->getMessage());
        }
    }
}
