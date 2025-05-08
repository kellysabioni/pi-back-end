<?php
namespace ProjetaBD\Enums;

enum Categoria: string {
    case Indefinido = 'Indefinido';
    case Cultura = 'Cultura';
    case Saude = 'Saúde'; 
    case Educacao = 'Educação';
    case MeioAmbiente = 'Meio Ambiente';
    case DesenvolvimentoSocial = 'DesenvolvimentoSocial';
    case AssistenciaSocial = 'Assistência Social';
    case Esportes = 'Esportes';
    case ApoioAGruposVulneráveis = 'Apoio a Grupos Vulneráveis';
    case CombateAViolencia = 'Combate à Violência';
    case ApoioAAnimais = 'Apoio a Animais';
    case AcoesDeVoluntariado = 'Ações de Voluntariado';
}