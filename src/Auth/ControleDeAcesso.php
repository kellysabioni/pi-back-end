<?php
namespace ProjetaBD\Auth;
final class ControleDeAcesso
{
    private function __construct() {}

    /* Inicia uma sessão caso não tenha nenhuma em andamento */
    private static function iniciarSessao():void
    {
        if(!isset($_SESSION)) session_start();
    }


    public static function exigirLogin(): void
    {
        // Inicia sessão (se necessário)
        self::iniciarSessao();

        // Se NÃO EXISTIR uma variável de sessão chamada id
        if(!isset($_SESSION['id'])){
            session_destroy();
            header("location:login.php");
            exit;
        }
    }

    public static function login(int $id, string $nome, string $tipo, string $email): void
    {
        self::iniciarSessao();

        // Definindo variáveis de sessão com os dados de quem logou
        $_SESSION['id'] = $id;
        $_SESSION['nome'] = $nome;
        $_SESSION['tipo'] = $tipo;
        $_SESSION['email'] = $email;

        if(!isset($_SESSION['id'])){
            session_destroy();
            header("location:../login.php?acesso_proibido");
            exit;
        }
    }

    public static function logout():void
    {
        self::iniciarSessao();
        session_destroy();
        header("location:../login.php?logout");
        exit;
    }

    public static function exigirCadastro():void
    {
        self::iniciarSessao();

        /* Se o usuário não for um admin, ele será redirecionado para nao-autorizado */ 
        if($_SESSION['tipo'] !== 'cadastro'){
            header("location:cadastrar-comp.php");
            exit;
        }
    }
}