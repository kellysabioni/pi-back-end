# Lista de comandos CRUD 

## Populando tabela com dados fictícios 
---
### Usuarios
```sql
INSERT INTO usuarios (nome, email, senha, tipo_usuario) VALUES
('Ana Souza', 'ana.souza@email.com', 'senhaCriptografada123', 'usuario'),
('Bruno Lima', 'bruno.lima@email.com', 'seguraSenha456', 'usuario'),
('Carla Mendes', 'carla.mendes@email.com', 'senhaForte789', 'usuario'),
('Diego Rocha', 'diego.rocha@email.com', 'minhaSenha321', 'usuario'),
('Eduarda Castro', 'eduarda.castro@email.com', 'outraSenha654', 'usuario');
```
---
### Projetos
```sql
INSERT INTO projetos (nome, CEP, RUA, numero, bairro, cidade, UF, telefone, categoria, usuarios_id
) VALUES
('Projeto Vida Ativa', '01001-000', 'Rua das Flores', '123', 'Centro', 'São Paulo', 'SP', '(11)91234-5678', 'Esportivo', 2),
('Instituto Joga Junto', '20040-002', 'Av. Atlântica', '456', 'Copacabana', 'Rio de Janeiro', 'RJ', '(21)98765-4321', 'Esportivo', 3),
('Centro Social Crescer', '30130-010', 'Rua da Bahia', '789', 'Funcionários', 'Belo Horizonte', 'MG', '(31)99876-5432', 'Social', 1),
('Projeto Bola no Pé', '80010-180', 'Rua XV de Novembro', '101', 'Centro', 'Curitiba', 'PR', '(41)98888-1111', 'Esportivo', 5),
('Associação Transformar', '60025-120', 'Av. Beira Mar', '202', 'Meireles', 'Fortaleza', 'CE', '(85)97777-2222', 'Social', 4),
('Escola de Esportes Futuro Campeão', '69050-020', 'Rua Japurá', '303', 'Centro', 'Manaus', 'AM', '(92)96666-3333', 'Esportivo', 2),
('Projeto Mãos que Ajudam', '88010-400', 'Rua Felipe Schmidt', '404', 'Centro', 'Florianópolis', 'SC', '(48)95555-4444', 'Social', 1),
('Instituto Gol de Placa', '40020-000', 'Av. Sete de Setembro', '505', 'Vitória', 'Salvador', 'BA', '(71)94444-5555', 'Esportivo', 5),
('Centro Esportivo Atletas do Amanhã', '64000-020', 'Rua Álvaro Mendes', '606', 'Centro', 'Teresina', 'PI', '(86)93333-6666', 'Esportivo', 5),
('Projeto Social Viver Bem', '59020-200', 'Av. Prudente de Morais', '707', 'Lagoa Nova', 'Natal', 'RN', '(84)92222-7777', 'Social', 4);

```
---