<?php
namespace ProjetaBD\Helpers;

use Exception;

class Utils {
    public static function upload(?array $arquivo): ?string
    {
        // Se não houver arquivo, ou se o arquivo não for válido
        // (ou seja, não for um upload feito via $_FILES), aborta a execução
        if (
            !$arquivo ||
            !isset($arquivo["tmp_name"]) ||
            !is_uploaded_file($arquivo["tmp_name"])
        ) {
            self::alertaErro("Nenhum arquivo válido foi enviado.");
            return null;
        }

        // Variáveis de configuração para o upload
        // (pasta de destino, formatos permitidos e tamanho máximo)
        $pastaDeDestino = __DIR__ . "/../../images/";
        $formatosPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];
        $tamanhoMaximo = 2 * 1024 * 1024; // 2MB

        // Verifica se a pasta existe, se não, cria
        if (!is_dir($pastaDeDestino)) {
            mkdir($pastaDeDestino, 0777, true);
        }

        // Captura o mime type do arquivo enviado
        $formatoDoArquivoEnviado = mime_content_type($arquivo["tmp_name"]);

        // Se o arquivo não for do tipo permitido, aborta a execução
        if (!in_array($formatoDoArquivoEnviado, $formatosPermitidos)) {
            self::alertaErro("Apenas arquivos JPG, PNG, GIF e SVG são permitidos.");
            return null;
        }

        // Se o arquivo for maior que o tamanho máximo, aborta a execução
        if ($arquivo["size"] > $tamanhoMaximo) {
            self::alertaErro("O arquivo é muito grande. Tamanho máximo: 2MB.");
            return null;
        }

        // Gera um nome único para o arquivo
        $extensao = pathinfo($arquivo["name"], PATHINFO_EXTENSION);
        $nomeUnico = uniqid() . '_' . time() . '.' . $extensao;
        
        // Define o nome do arquivo de destino
        $nomeDoArquivo = $pastaDeDestino . $nomeUnico;

        // Se o processo de upload falhar, aborta a execução
        if (!move_uploaded_file($arquivo["tmp_name"], $nomeDoArquivo)) {
            throw new Exception("Erro ao mover o arquivo. Código de erro: " . $arquivo["error"]);
        }

        // Retorna apenas o nome do arquivo para ser salvo no banco
        return $nomeUnico;
    }

    public static function alertaErro(string $mensagem): void
    {
        // Implementar lógica de alerta de erro
        echo "<script>alert('$mensagem');</script>";
    }

    public static function getCaminhoImagem(string $nomeArquivo): string 
    {
        return "/pi-back-end/images/" . $nomeArquivo;
    }
}