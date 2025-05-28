<?php

namespace ProjetaBD\Helpers;

use InvalidArgumentException;
use ProjetaBD\Enums\Categoria;

final class Validacoes
{
    private function __construct() {}

    public static function validarNome(string $nome): void
    {
        if (empty($nome)) {
            throw new InvalidArgumentException("Nome não pode ser vazio.");
        }
    }

    public static function validarEmail(string $email): void
    {
        if (empty($email)) {
            throw new InvalidArgumentException("Email não pode ser vazio.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Email inválido.");
        }
    }

    public static function validarSenha(string $senha): void
    {
        if (empty($senha)) {
            throw new InvalidArgumentException("Senha não pode ser vazia.");
        }
    }

    public static function validarDescricao(string $descricao): void
    {
        if (empty($descricao)) {
            throw new InvalidArgumentException("Descrição não pode ser vazia.");
        }
    }

    public static function validarData(string $data): void
    {
        if (empty($data)) {
            throw new InvalidArgumentException("Data não pode ser vazia.");
        }

        $dataFormatada = \DateTime::createFromFormat('Y-m-d', $data);
        if (!$dataFormatada || $dataFormatada->format('Y-m-d') !== $data) {
            throw new InvalidArgumentException("Data inválida. Use o formato YYYY-MM-DD.");
        }
    }

    public static function validarHora(string $hora): void
    {
        if (empty($hora)) {
            throw new InvalidArgumentException("Hora não pode ser vazia.");
        }

        $horaFormatada = \DateTime::createFromFormat('H:i', $hora);
        if (!$horaFormatada || $horaFormatada->format('H:i') !== $hora) {
            throw new InvalidArgumentException("Hora inválida. Use o formato HH:MM.");
        }
    }

    public static function validarCEP(string $cep): void
    {
        if (empty($cep)) {
            throw new InvalidArgumentException("CEP não pode ser vazio.");
        }

        $cep = preg_replace('/[^0-9]/', '', $cep);
        if (strlen($cep) !== 8) {
            throw new InvalidArgumentException("CEP inválido. Deve conter 8 dígitos.");
        }
    }

    public static function validarEndereco(string $endereco): void
    {
        if (empty($endereco)) {
            throw new InvalidArgumentException("Endereço não pode ser vazio.");
        }
    }

    public static function validarNumero(string $numero): void
    {
        if (empty($numero)) {
            throw new InvalidArgumentException("Número não pode ser vazio.");
        }
    }

    public static function validarBairro(string $bairro): void
    {
        if (empty($bairro)) {
            throw new InvalidArgumentException("Bairro não pode ser vazio.");
        }
    }

    public static function validarCidade(string $cidade): void
    {
        if (empty($cidade)) {
            throw new InvalidArgumentException("Cidade não pode ser vazia.");
        }
    }

    public static function validarUF(string $uf): void
    {
        if (empty($uf)) {
            throw new InvalidArgumentException("UF não pode ser vazia.");
        }

        if (strlen($uf) !== 2) {
            throw new InvalidArgumentException("UF inválida. Deve conter 2 caracteres.");
        }
    }

    public static function validarTelefone(string $telefone): void
    {
        if (empty($telefone)) {
            throw new InvalidArgumentException("Telefone não pode ser vazio.");
        }

        $telefone = preg_replace('/[^0-9]/', '', $telefone);
        if (strlen($telefone) < 10 || strlen($telefone) > 11) {
            throw new InvalidArgumentException("Telefone inválido. Deve conter 10 ou 11 dígitos.");
        }
    }

    public static function validarCategoria(string $categoria): void
    {
        if (empty($categoria)) {
            throw new InvalidArgumentException("Categoria não pode ser vazia.");
        }

        if (!Categoria::tryFrom($categoria)) {
            throw new InvalidArgumentException("Categoria inválida.");
        }
    }
}
