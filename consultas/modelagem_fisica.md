# Comandos utilizados

## Criando banco de dados 
``` sql
CREATE DATABASE projeta_bd CHARACTER SET utf8mb4;
```

## Selecionando banco 
``` sql
USE projeta_bd;
```

## Criando Tabelas 
1. Cadastro Usuários
``` sql
CREATE TABLE usuarios( 
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('usuario', 'cadastro', 'admin') NOT NULL DEFAULT 'usuario',
    cpf VARCHAR(14) NULL UNIQUE,
    data_nascimento DATE NULL,
    created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL
);
```
---
2. Cadastro Projetos
``` sql
CREATE TABLE projetos( 
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    CEP VARCHAR(9) NOT NULL,
    rua VARCHAR(100) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    bairro VARCHAR(50) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    UF CHAR(2) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    categoria ENUM('Indefinido','Cultura','Saude', 'Educacao', 'MeioAmbiente', 'DesenvolvimentoSocial', 'AssistenciaSocial', 'Esportes', 'ApoioAGruposVulneraveis', 'CombateAViolencia', 'ApoioAAnimais', 'AcoesDeVoluntariado') NOT NULL,
    created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL,
    usuarios_id INT NOT NULL,
    FOREIGN KEY (usuarios_id) REFERENCES usuarios(id) ON DELETE CASCADE
);
```
---
3. Cadastro Eventos
``` sql
CREATE TABLE eventos( 
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(300) NOT NULL,
    data DATE NOT NULL,
    hora TIME NOT NULL, 
    CEP VARCHAR(9) NOT NULL,
    rua VARCHAR(100) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    bairro VARCHAR(50) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    UF CHAR(2) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    categoria ENUM('Indefinido','Cultura','Saude', 'Educacao', 'MeioAmbiente', 'DesenvolvimentoSocial', 'AssistenciaSocial', 'Esportes', 'ApoioAGruposVulneraveis', 'CombateAViolencia', 'ApoioAAnimais', 'AcoesDeVoluntariado') NOT NULL,
    created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL,
    usuarios_id INT,
    projetos_id INT,
    FOREIGN KEY (usuarios_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (projetos_id) REFERENCES projetos(id) ON DELETE CASCADE
);
```
4. Fotos
``` sql
CREATE TABLE fotos( 
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome_arquivo VARCHAR(100) NOT NULL,
    created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    usuarios_id INT NOT NULL,
    projetos_id INT NULL,
    eventos_id INT NULL,
    FOREIGN KEY (usuarios_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (projetos_id) REFERENCES projetos(id) ON DELETE CASCADE,
    FOREIGN KEY (eventos_id) REFERENCES eventos(id) ON DELETE CASCADE
);
```

