<?php
namespace ProjetaBD\Enums;

enum Categoria: string {
    case Indefinido = 'Selecione uma categoria';
    case Cultura = 'Cultura';
    case Saude = 'Saúde'; 
    case Educacao = 'Educação';
    case MeioAmbiente = 'Meio Ambiente';
    case DesenvolvimentoSocial = 'Desenvolvimento Social';
    case AssistenciaSocial = 'Assistência Social';
    case Esportes = 'Esportes';
    case ApoioAGruposVulneraveis = 'Apoio a Grupos Vulneráveis';
    case CombateAViolencia = 'Combate à Violência';
    case ApoioAAnimais = 'Apoio a Animais';
    case AcoesDeVoluntariado = 'Ações de Voluntariado';
}