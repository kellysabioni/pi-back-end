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
    eventos.*,

    usuarios.id AS usuario_id,
    usuarios.nome AS usuario_nome,

    projetos.id AS projeto_id,
    projetos.nome AS projeto_nome

    FROM 
    eventos
    LEFT JOIN usuarios ON eventos.usuarios_id = usuarios.id
    LEFT JOIN projetos ON eventos.projetos_id = projetos.id
    ORDER BY eventos.data DESC";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("ERRO: " . $erro->getMessage());
        }
    }

    public function listarUm($id): array
    {
        $sql = "SELECT 
    eventos.*,

    -- IDs e nomes diretos
    COALESCE(eventos.usuarios_id, projetos.usuarios_id) AS usuario_id,
    COALESCE(usuario_evento.nome, usuario_projeto.nome) AS usuario_nome,

    projetos.id AS projeto_id,
    projetos.nome AS projeto_nome

FROM 
    eventos
LEFT JOIN usuarios AS usuario_evento ON eventos.usuarios_id = usuario_evento.id
LEFT JOIN projetos ON eventos.projetos_id = projetos.id
LEFT JOIN usuarios AS usuario_projeto ON projetos.usuarios_id = usuario_projeto.id

WHERE 
    eventos.id = :id;
";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("ERRO: " . $erro->getMessage());
        }
    }
}
