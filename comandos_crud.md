# Comandos utilizados

## Criando banco de dados 

``` sql
CREATE DATABASE conectacao CHARACTER SET utf8mb4 ;
```

## Criando Tabelas 

1. Cadastro Pessoas
``` sql
CREATE TABLE pessoas( 
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    nome VARCHAR(100) NOT NULL , 
    email VARCHAR(50) NOT NULL , 
    senha INT NULL 
    tipo_usuario ENUM (pessoa, evento, projeto) 
    );
```
