<?php
namespace ProjetaBD\Services;

use Exception, PDO, Throwable;
use ProjetaBD\Database\ConexaoBD;

class FotoServico {
    private PDO $conexao;

    public function __construct() {
        $this->conexao = ConexaoBD::getConexao();
    }

    public function inserir(string $nomeArquivo, int $usuariosId, ?int $eventosId = null, ?int $projetosId = null): void {
        $sql = "INSERT INTO fotos (nome_arquivo, usuarios_id, eventos_id, projetos_id) 
                VALUES (:nome_arquivo, :usuarios_id, :eventos_id, :projetos_id)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome_arquivo", $nomeArquivo, PDO::PARAM_STR);
            $consulta->bindValue(":usuarios_id", $usuariosId, PDO::PARAM_INT);
            $consulta->bindValue(":eventos_id", $eventosId, PDO::PARAM_INT);
            $consulta->bindValue(":projetos_id", $projetosId, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao inserir foto: " . $erro->getMessage());
        }
    }

    public function buscarPorEvento(int $eventoId): ?array {
        $sql = "SELECT * FROM fotos WHERE eventos_id = :evento_id";
        
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":evento_id", $eventoId, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("Erro ao buscar foto do evento: " . $erro->getMessage());
        }
    }
} 