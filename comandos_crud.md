# Comandos utilizados

## Criando banco de dados 

``` sql
CREATE DATABASE conectacao CHARACTER SET utf8mb4 ;
```

## Criando Tabelas 

1. Cadastro Usuários
``` sql
CREATE TABLE usuarios( 
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    nome VARCHAR(100) NOT NULL, 
    email VARCHAR(50) NOT NULL UNIQUE, 
    senha VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('usuario', 'evento', 'projeto') NOT NULL,
    projetos_id INT,
    eventos_id INT,
    fotos_id INT,  
    FOREIGN KEY (projetos_id) REFERENCES projetos(id),
    FOREIGN KEY (eventos_id) REFERENCES eventos(id)
    FOREIGN KEY (fotos_id) REFERENCES fotos(id)
);
```
---
