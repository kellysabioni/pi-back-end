<?php
namespace ProjetaBD\Database;

use Exception, PDO, Throwable;

abstract class ConexaoBD
{
    private static PDO $conexao;
    private static string $servidor = "localhost"; 
    private static string $usuario = "root";
    private static string $senha = "";
    private static string $banco = "projeta_bd";

    public static function getConexao():PDO
    {
        if( !isset( self::$conexao ) ){
            try {
                self::$conexao = new PDO(
                    "mysql:host=".self::$servidor.";dbname=".self::$banco.";charset=utf8", self::$usuario, self::$senha
                );
                
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Throwable $erro) {
                // [A FAZER] Registra a exceção em um arquivo de log/texto interno

                throw new Exception ( "Erro ao conectar com o banco de dados!" );
            }
        }

        return self::$conexao;
    }
}