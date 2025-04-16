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
2. Cadastro Projetos
``` sql
CREATE TABLE projetos( 
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    nome VARCHAR(100) NOT NULL, 
    CEP VARCHAR(9) NOT NULL,
    RUA VARCHAR(100) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    bairro VARCHAR(50) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    UF CHAR(2) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    usuarios_id INT NOT NULL,
    eventos_id INT,
    foto_id INT,  
    FOREIGN KEY (usuarios_id) REFERENCES usuarios(id),
    FOREIGN KEY (eventos_id) REFERENCES eventos(id)
    FOREIGN KEY (fotos_id) REFERENCES fotos(id)
);
```
---
3. Cadastro Eventos
``` sql
CREATE TABLE eventos( 
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    nome VARCHAR(100) NOT NULL, 
    CEP VARCHAR(9) NOT NULL,
    RUA VARCHAR(100) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    bairro VARCHAR(50) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    UF CHAR(2) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    usuarios_id INT NOT NULL,
    projetos_id INT,
    foto_id INT,  
    FOREIGN KEY (usuarios_id) REFERENCES usuarios(id),
    FOREIGN KEY (projetos_id) REFERENCES projetos(id)
    FOREIGN KEY (fotos_id) REFERENCES fotos(id)
);
```
4. Fotos
``` sql
CREATE TABLE fotos( 
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    nome_arquivo VARCHAR(100) NOT NULL, 
    usuarios_id INT NOT NULL,
    projetos_id INT,
    eventos_id INT,  
    FOREIGN KEY (usuarios_id) REFERENCES usuarios(id),
    FOREIGN KEY (projetos_id) REFERENCES projetos(id)
    FOREIGN KEY (eventos_id) REFERENCES eventos(id)
);
```
