<?php

namespace ProjetaBD\Services;

use Exception, PDO, Throwable;
use ProjetaBD\Database\ConexaoBD;
use ProjetaBD\Models\Evento;

class EventoServico
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = ConexaoBD::getConexao();
    }

    public function getConexao(): PDO {
        return $this->conexao;
    }

    public function listarTodos(): array
    {
        $sql = "SELECT eventos.*,
        usuarios.id AS usuario_id,
        usuarios.nome AS usuario_nome,
        projetos.id AS projeto_id,
        projetos.nome AS projeto_nome,
        fotos.nome_arquivo AS imagem
        FROM 
        eventos
        LEFT JOIN usuarios ON eventos.usuarios_id = usuarios.id
        LEFT JOIN projetos ON eventos.projetos_id = projetos.id
        LEFT JOIN fotos ON eventos.id = fotos.eventos_id
        ORDER BY eventos.created_at DESC";

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
        $sql = "SELECT eventos.*,
        COALESCE(eventos.usuarios_id, projetos.usuarios_id) AS usuario_id,
        COALESCE(usuario_evento.nome, usuario_projeto.nome) AS usuario_nome,
        projetos.id AS projeto_id,
        projetos.nome AS projeto_nome,
        fotos.nome_arquivo AS imagem
        FROM 
            eventos
        LEFT JOIN usuarios AS usuario_evento ON eventos.usuarios_id = usuario_evento.id
        LEFT JOIN projetos ON eventos.projetos_id = projetos.id
        LEFT JOIN usuarios AS usuario_projeto ON projetos.usuarios_id = usuario_projeto.id
        LEFT JOIN fotos ON eventos.id = fotos.eventos_id
        WHERE 
            eventos.id = :id; ";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("ERRO: " . $erro->getMessage());
        }
    }

    public function inserir(Evento $evento): void
    {
        $sql = "INSERT INTO eventos(
        nome, descricao, data, hora, CEP, rua, numero, bairro, cidade, UF, telefone, categoria, usuarios_id, projetos_id)
        VALUES (
        :nome, :descricao, :data, :hora, :CEP, :rua, :numero, :bairro, :cidade, :UF, :telefone, :categoria, :usuarios_id, :projetos_id)";

        try {
            $consulta = $this->conexao->prepare($sql);

            $consulta->bindValue(":nome", $evento->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(":descricao", $evento->getDescricao(), PDO::PARAM_STR);
            $consulta->bindValue(":data", $evento->getData(), PDO::PARAM_STR);
            $consulta->bindValue(":hora", $evento->getHora(), PDO::PARAM_STR);
            $consulta->bindValue(":CEP", $evento->getCEP(), PDO::PARAM_STR);
            $consulta->bindValue(":rua", $evento->getRua(), PDO::PARAM_STR);
            $consulta->bindValue(":numero", $evento->getNumero(), PDO::PARAM_STR);
            $consulta->bindValue(":bairro", $evento->getBairro(), PDO::PARAM_STR);
            $consulta->bindValue(":cidade", $evento->getCidade(), PDO::PARAM_STR);
            $consulta->bindValue(":UF", $evento->getUF(), PDO::PARAM_STR);
            $consulta->bindValue(":telefone", $evento->getTelefone(), PDO::PARAM_STR);
            $consulta->bindValue(":categoria", $evento->getCategoria()->value, PDO::PARAM_STR);
            $consulta->bindValue(":usuarios_id", $evento->getUsuarios_id(), PDO::PARAM_STR);
            $consulta->bindValue(":projetos_id", $evento->getProjetos_id(), PDO::PARAM_INT);

            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao inserir evento: " . $erro->getMessage());
        }
    }

    public function buscar(string $termo): array
    {
        $sql = "SELECT id, nome, data, descricao 
                FROM eventos
                WHERE nome LIKE :termo
                   OR descricao LIKE :termo 
                ORDER BY data DESC";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(':termo', '%' . $termo . '%', PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("Erro ao buscar notícias: " . $erro->getMessage());
        }
    }

    public function filtro(string $categoria): array
    {
       $sql = "SELECT eventos.*,
           usuarios.id AS usuario_id,
           usuarios.nome AS usuario_nome,
           projetos.id AS projeto_id,
           projetos.nome AS projeto_nome,
           fotos.nome_arquivo AS imagem
            FROM eventos
            LEFT JOIN usuarios ON eventos.usuarios_id = usuarios.id
            LEFT JOIN projetos ON eventos.projetos_id = projetos.id
            LEFT JOIN fotos ON eventos.id = fotos.eventos_id
            WHERE eventos.categoria = :categoria
            ORDER BY eventos.created_at DESC";

        try {
            error_log("Filtrando por categoria: " . $categoria); // Log para debug
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":categoria", $categoria, PDO::PARAM_STR);
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            error_log("Resultados encontrados: " . count($resultados)); // Log para debug
            return $resultados;
        } catch (\Throwable $erro) {
            throw new Exception("Erro ao selecionar categoria: " . $erro->getMessage());
        }
    }

    public function contarEventos($id)
    {
        $sql = "SELECT COUNT(*) AS total_eventos FROM eventos WHERE usuarios_id = :usuarios_id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":usuarios_id", $id, PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $erro) {
            throw new Exception("Erro ao listar eventos do perfil: " . $erro->getMessage());
        }
    }

    public function eventosPerfil(int $id): array
    {
        $sql = "SELECT 
                    eventos.*,
                    usuarios.id AS usuario_id,
                    usuarios.nome AS usuario_nome,
                    fotos.nome_arquivo AS imagem
                FROM eventos
                LEFT JOIN usuarios ON eventos.usuarios_id = usuarios.id
                LEFT JOIN fotos ON eventos.id = fotos.eventos_id AND fotos.usuarios_id = eventos.usuarios_id
                WHERE eventos.usuarios_id = :usuarios_id
                ORDER BY eventos.created_at DESC";

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
        $sql = "DELETE FROM eventos WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();

        } catch (Exception $erro) {
            die("Erro ao excluir evento: ".$erro->getMessage());
        }
    }

    public function atualizar(Evento $evento): void
    {
        $sql = "UPDATE eventos
                SET 
                nome = :nome,
                descricao = :descricao,
                data = :data,
                hora = :hora,
                CEP = :CEP,
                rua = :rua,
                numero = :numero,
                bairro = :bairro,
                cidade = :cidade,
                UF = :UF,
                telefone = :telefone,
                categoria = :categoria,
                projetos_id = :projetos_id,
                updated_at = NOW()
                WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $evento->getId(), PDO::PARAM_INT);
            $consulta->bindValue(":nome", $evento->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(":descricao", $evento->getDescricao(), PDO::PARAM_STR);
            $consulta->bindValue(":data", $evento->getData(), PDO::PARAM_STR);
            $consulta->bindValue(":hora", $evento->getHora(), PDO::PARAM_STR);
            $consulta->bindValue(":CEP", $evento->getCEP(), PDO::PARAM_STR);
            $consulta->bindValue(":rua", $evento->getRua(), PDO::PARAM_STR);
            $consulta->bindValue(":numero", $evento->getNumero(), PDO::PARAM_STR);
            $consulta->bindValue(":bairro", $evento->getBairro(), PDO::PARAM_STR);
            $consulta->bindValue(":cidade", $evento->getCidade(), PDO::PARAM_STR);
            $consulta->bindValue(":UF", $evento->getUF(), PDO::PARAM_STR);
            $consulta->bindValue(":telefone", $evento->getTelefone(), PDO::PARAM_STR);
            $consulta->bindValue(":categoria", $evento->getCategoria()->value, PDO::PARAM_STR);

            $projetosId = $evento->getProjetos_id();
            if ($projetosId === "-1" || empty($projetosId)) {
                $consulta->bindValue(":projetos_id", null, PDO::PARAM_NULL);
            } else {
                $consulta->bindValue(":projetos_id", $projetosId, PDO::PARAM_INT);
            }
            
            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao atualizar evento: " . $erro->getMessage());
        }
    }
}
