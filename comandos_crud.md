# Comandos utilizados

## Criando banco de dados 

``` sql
CREATE DATABASE conectacao CHARACTER SET utf8mb4 ;
```

## Criando Tabelas 

1. Cadastro Pessoas
``` sql
CREATE TABLE usuarios( 
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    nome VARCHAR(100) NOT NULL , 
    email VARCHAR(50) NOT NULL , 
    senha INT NULL 
    tipo_usuario ENUM (usuario, evento, projeto),
    projetos_id ,
    eventos_id   
    );
```
---
2. Cadastro Projetos
``` sql
CREATE TABLE projetos( 
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    nome VARCHAR(100) NOT NULL , 
    CEP 
    RUA
    numero
    bairro
    cidade
    UF
    telefone
    categoria
    usuarios_id
    eventos_id
    );
```
---
3. Cadastro Projetos
``` sql
CREATE TABLE eventos( 
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    nome VARCHAR(100) NOT NULL , 
    CEP 
    RUA
    numero
    bairro
    cidade
    UF
    telefone
    categoria
    usuarios_id
    eventos_id
    );
```
