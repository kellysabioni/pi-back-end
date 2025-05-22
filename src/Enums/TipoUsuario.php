<?php
namespace ProjetaBD\Enums;

enum TipoUsuario: string {
    case usuario = 'Usuario';
    case cadastro = 'Projeto/Eventos';
    case admin = 'Administrador'; 
}