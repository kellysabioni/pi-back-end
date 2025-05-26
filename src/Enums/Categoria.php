<?php
namespace ProjetaBD\Enums;

enum Categoria: string {
    case Indefinido = 'Selecione uma categoria';
    case AcoesDeVoluntariado = 'Ações de Voluntariado';
    case ApoioAAnimais = 'Apoio a Animais';
    case ApoioAGruposVulneraveis = 'Apoio a Grupos Vulneráveis';
    case AssistenciaSocial = 'Assistência Social';
    case CombateAViolencia = 'Combate à Violência';
    case Cultura = 'Cultura';
    case DesenvolvimentoSocial = 'Desenvolvimento Social';
    case Educacao = 'Educação';
    case Esportes = 'Esportes';
    case MeioAmbiente = 'Meio Ambiente';
    case Saude = 'Saúde'; 
}