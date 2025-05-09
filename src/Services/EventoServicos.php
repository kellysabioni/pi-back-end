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
    usuarios.nome AS nome_usuario, 
    projetos.nome AS nome_projeto
    FROM eventos
    LEFT JOIN usuarios ON eventos.usuarios_id = usuarios.id
    LEFT JOIN projetos ON eventos.projetos_id = projetos.id
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
