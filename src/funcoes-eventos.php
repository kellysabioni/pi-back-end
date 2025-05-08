<?php 
require_once 'src/conecta.php';

// Função para listar todos os eventos
function listarEventos(PDO $conexao) : array {
    $sql = "SELECT * FROM eventos ORDER BY data_evento DESC";
    
    try {
        // Prepara consulta SQL antes de executar no servidor
        $consulta = $conexao->prepare($sql);

        // Executa a consulta SQL no banco de dados
        $consulta->execute();

        // returna os resultados da consulta
        return $consulta->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $erro) {
        die("Erro ao listar eventos: " . $erro->getMessage());
    }
    
}
