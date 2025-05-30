<?php

namespace ProjetaBD\Services;

use Exception, PDO, Throwable;
use ProjetaBD\Database\ConexaoBD as DatabaseConexaoBD;
use ProjetaBD\Database\ConexaoBD;

class FotoServico
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = DatabaseConexaoBD::getConexao();
    }

    public function inserir(string $nomeArquivo, int $usuariosId, ?int $eventosId = null, ?int $projetosId = null): void
    {
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

    public function buscarPorEvento(int $eventoId): ?array
    {
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

    public function atualizar(string $nomeArquivo, int $usuariosId, ?int $eventosId = null, ?int $projetosId = null): void {
        // Primeiro, verifica se já existe uma foto para este projeto/evento
        $sql = "SELECT id FROM fotos WHERE ";
        $params = [];
        
        if ($eventosId !== null) {
            $sql .= "eventos_id = :eventos_id";
            $params[':eventos_id'] = $eventosId;
        } else if ($projetosId !== null) {
            $sql .= "projetos_id = :projetos_id";
            $params[':projetos_id'] = $projetosId;
        } else {
            $sql .= "usuarios_id = :usuarios_id";
            $params[':usuarios_id'] = $usuariosId;
        }

        try {
            $consulta = $this->conexao->prepare($sql);
            foreach ($params as $key => $value) {
                $consulta->bindValue($key, $value, PDO::PARAM_INT);
            }
            $consulta->execute();
            $fotoExistente = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($fotoExistente) {
                // Se existe, atualiza
                $sql = "UPDATE fotos SET 
                    nome_arquivo = :nome_arquivo,
                    usuarios_id = :usuarios_id,
                    eventos_id = :eventos_id,
                    projetos_id = :projetos_id
                    WHERE ";
                if ($eventosId !== null) {
                    $sql .= "eventos_id = :eventos_id";
                } else if ($projetosId !== null) {
                    $sql .= "projetos_id = :projetos_id";
                } else {
                    $sql .= "usuarios_id = :usuarios_id";
                }
            } else {
                // Se não existe, insere
                $sql = "INSERT INTO fotos (nome_arquivo, usuarios_id, eventos_id, projetos_id) 
                        VALUES (:nome_arquivo, :usuarios_id, :eventos_id, :projetos_id)";
            }

            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome_arquivo", $nomeArquivo, PDO::PARAM_STR);
            $consulta->bindValue(":usuarios_id", $usuariosId, PDO::PARAM_INT);
            $consulta->bindValue(":eventos_id", $eventosId, PDO::PARAM_INT);
            $consulta->bindValue(":projetos_id", $projetosId, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao atualizar foto: " . $erro->getMessage());
        }
    }
    
    public function buscarPorUsuario(int $usuarioId): ?array
    {
        $sql = "SELECT * FROM fotos WHERE usuarios_id = :usuario_id";
        
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":usuario_id", $usuarioId, PDO::PARAM_INT);
            $consulta->execute();
            
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            error_log("Resultado da busca de foto do usuário {$usuarioId}: " . print_r($resultado, true));
            return $resultado !== false ? $resultado : null;
        } catch (Throwable $erro) {
            throw new Exception("Erro ao buscar foto do usuário: " . $erro->getMessage());
        }
    }
} 

