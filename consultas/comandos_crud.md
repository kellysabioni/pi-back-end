# Lista de comandos CRUD 

## Populando tabela com dados fictícios 
---
> Usuarios
```sql
INSERT INTO usuarios (nome, email, senha, tipo_usuario) VALUES
('Ana Souza', 'ana.souza@email.com', 'senhaCriptografada123', 'usuario'),
('Bruno Lima', 'bruno.lima@email.com', 'seguraSenha456', 'usuario'),
('Carla Mendes', 'carla.mendes@email.com', 'senhaForte789', 'usuario'),
('Diego Rocha', 'diego.rocha@email.com', 'minhaSenha321', 'usuario'),
('Eduarda Castro', 'eduarda.castro@email.com', 'outraSenha654', 'usuario');
```
---
> Projetos
```sql
INSERT INTO projetos (nome, CEP, RUA, numero, bairro, cidade, UF, telefone, categoria, usuarios_id
) VALUES
('Projeto Vida Ativa', '01001-000', 'Rua das Flores', '123', 'Centro', 'São Paulo', 'SP', '(11)91234-5678', 'Esportivo', 2),
('Instituto Joga Junto', '20040-002', 'Av. Atlântica', '456', 'Copacabana', 'Rio de Janeiro', 'RJ', '(21)98765-4321', 'Esportivo', 2),
('Centro Social Crescer', '30130-010', 'Rua da Bahia', '789', 'Funcionários', 'Belo Horizonte', 'MG', '(31)99876-5432', 'Social', 4),
('Projeto Bola no Pé', '80010-180', 'Rua XV de Novembro', '101', 'Centro', 'Curitiba', 'PR', '(41)98888-1111', 'Esportivo', 5),
('Associação Transformar', '60025-120', 'Av. Beira Mar', '202', 'Meireles', 'Fortaleza', 'CE', '(85)97777-2222', 'Social', 4),
('Escola de Esportes Futuro Campeão', '69050-020', 'Rua Japurá', '303', 'Centro', 'Manaus', 'AM', '(92)96666-3333', 'Esportivo', 2),
('Projeto Mãos que Ajudam', '88010-400', 'Rua Felipe Schmidt', '404', 'Centro', 'Florianópolis', 'SC', '(48)95555-4444', 'Social', 4),
('Instituto Gol de Placa', '40020-000', 'Av. Sete de Setembro', '505', 'Vitória', 'Salvador', 'BA', '(71)94444-5555', 'Esportivo', 5),
('Centro Esportivo Atletas do Amanhã', '64000-020', 'Rua Álvaro Mendes', '606', 'Centro', 'Teresina', 'PI', '(86)93333-6666', 'Esportivo', 2),
('Projeto Social Viver Bem', '59020-200', 'Av. Prudente de Morais', '707', 'Lagoa Nova', 'Natal', 'RN', '(84)92222-7777', 'Social', 4);
```
---
> Eventos
```sql
INSERT INTO eventos (nome, descricao, data, CEP, RUA, numero, bairro, cidade, UF, telefone, categoria, usuarios_id, projetos_id
) VALUES
('Festival Vida Ativa 2025', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-03-10', '01001-000', 'Rua das Flores', '123', 'Centro', 'São Paulo', 'SP', '(11)91234-5678', 'Esportivo', 1, NULL),
('Copa Joga Junto Sub-15', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-04-20', '20031-005', 'Rua do Catete', '89', 'Glória', 'Rio de Janeiro', 'RJ', '(21)92345-6789', 'Esportivo', 3, NULL),
('Feira Crescer com Cidadania', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-05-05', '30150-030', 'Av. Augusto de Lima', '321', 'Centro', 'Belo Horizonte', 'MG', '(31)99812-1111', 'Social', NULL, 10),
('Torneio Bola no Pé 2025', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-06-01', '80010-180', 'Rua XV de Novembro', '101', 'Centro', 'Curitiba', 'PR', '(41)91111-2222', 'Esportivo', NULL, 4),
('Mutirão Transformar Comunidade', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-06-15', '60165-121', 'Rua Silva Paulet', '88', 'Aldeota', 'Fortaleza', 'CE', '(85)93456-7890', 'Social', NULL, 10),
('Campeonato Futuro Campeão', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-07-10', '69075-000', 'Rua Pará', '205', 'Adrianópolis', 'Manaus', 'AM', '(92)94567-1234', 'Esportivo', 3, NULL),
('Ação Solidária Mãos que Ajudam', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-08-03', '88110-200', 'Rua João Pio Duarte Silva', '98', 'Carvoeira', 'Florianópolis', 'SC', '(48)95544-6677', 'Social', NULL, 10),
('Torneio Gol de Placa - Etapa Bahia', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-08-17', '40020-000', 'Av. Sete de Setembro', '505', 'Vitória', 'Salvador', 'BA', '(71)94444-5555', 'Esportivo', 3, NULL),
('Corrida Atletas do Amanhã', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-09-07', '64010-000', 'Av. Frei Serafim', '456', 'Centro', 'Teresina', 'PI', '(86)97777-8888', 'Esportivo', NULL, 6),
('Encontro Viver Bem em Família', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-09-21', '59064-200', 'Rua São José', '300', 'Candelária', 'Natal', 'RN', '(84)93333-7777', 'Social', 1, NULL),
('Aulão Funcional Vida Ativa', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-10-05', '01012-000', 'Av. São João', '50', 'República', 'São Paulo', 'SP', '(11)98888-1122', 'Esportivo', 3, NULL),
('Festival de Dança Crescer', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-10-19', '30110-030', 'Rua Espírito Santo', '100', 'Centro', 'Belo Horizonte', 'MG', '(31)93222-1122', 'Social', NULL, 7),
('Campeonato de Futsal Joga Junto', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-11-02', '22775-040', 'Rua Godofredo Viana', '300', 'Barra da Tijuca', 'Rio de Janeiro', 'RJ', '(21)99999-7777', 'Esportivo', NULL, 4),
('Feira de Saúde Viver Bem', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-11-16', '59070-400', 'Av. Salgado Filho', '999', 'Lagoa Nova', 'Natal', 'RN', '(84)98877-6655', 'Social', NULL, 7),
('Festival Transformar Jovens', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-12-01', '60055-200', 'Av. Santos Dumont', '1500', 'Centro', 'Fortaleza', 'CE', '(85)91234-0099', 'Social', NULL, );
```
---
> 