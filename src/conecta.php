<?php
// Parâmetros de conexão com o banco de dados
$servidor = "localhost"; // Servidor
$usuario = "root"; // Usuário
$senha = ""; // Senha
$banco = "projeta_bd"; // Nome do BD

// Conexão com o banco de dados
try {
    $conexao = new PDO(
        "mysql:host=$servidor;dbname=$banco;charset=utf8", $usuario, $senha
    );
    $conexao->setAttribute(
        PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
    );
} catch (Exception $erro) {
    die("Erro ao conectar ao banco de dados: " . $erro->getMessage());
}
