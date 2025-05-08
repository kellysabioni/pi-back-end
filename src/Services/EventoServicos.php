<?php 
namespace ProjetaBD\Services;

use Exception;
use ProjetaBD\Database\ConexaoBD;
use PDO;
use Throwable;

class Evento {
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = ConexaoBD::getConexao();
    }

    public function listarTodos():array {
        $sql = "SELECT * FROM eventos ORDER BY data_evento DESC";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);

        } catch (Throwable $erro) {
            throw new Exception("ERRO: ".$erro->getMessage());
        }

    }

}
?>