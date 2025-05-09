-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/05/2025 às 16:07
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeta_bd`
--
CREATE DATABASE IF NOT EXISTS `projeta_bd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `projeta_bd`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `data` date NOT NULL,
  `CEP` varchar(9) NOT NULL,
  `RUA` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `UF` char(2) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `categoria` enum('Cultura','Saúde','Educação','Meio Ambiente','Desenvolvimento Social','Assistência Social','Esportes','Apoio a Grupos Vulneráveis','Combate à Violência','Apoio a Animais','Ações de Voluntariado') NOT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  `projetos_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id`, `nome`, `descricao`, `data`, `CEP`, `RUA`, `numero`, `bairro`, `cidade`, `UF`, `telefone`, `categoria`, `usuarios_id`, `projetos_id`) VALUES
(1, 'Festival Vida Ativa 2025', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-03-10', '01001-000', 'Rua das Flores', '123', 'Centro', 'São Paulo', 'SP', '(11)91234-5678', '', 1, NULL),
(2, 'Copa Joga Junto Sub-15', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-04-20', '20031-005', 'Rua do Catete', '89', 'Glória', 'Rio de Janeiro', 'RJ', '(21)92345-6789', '', 3, NULL),
(3, 'Feira Crescer com Cidadania', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-05-05', '30150-030', 'Av. Augusto de Lima', '321', 'Centro', 'Belo Horizonte', 'MG', '(31)99812-1111', '', NULL, 10),
(4, 'Torneio Bola no Pé 2025', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-06-01', '80010-180', 'Rua XV de Novembro', '101', 'Centro', 'Curitiba', 'PR', '(41)91111-2222', '', NULL, 4),
(5, 'Mutirão Transformar Comunidade', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-06-15', '60165-121', 'Rua Silva Paulet', '88', 'Aldeota', 'Fortaleza', 'CE', '(85)93456-7890', '', NULL, 10),
(6, 'Campeonato Futuro Campeão', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-07-10', '69075-000', 'Rua Pará', '205', 'Adrianópolis', 'Manaus', 'AM', '(92)94567-1234', '', 3, NULL),
(7, 'Ação Solidária Mãos que Ajudam', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-08-03', '88110-200', 'Rua João Pio Duarte Silva', '98', 'Carvoeira', 'Florianópolis', 'SC', '(48)95544-6677', '', NULL, 10),
(8, 'Torneio Gol de Placa - Etapa Bahia', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-08-17', '40020-000', 'Av. Sete de Setembro', '505', 'Vitória', 'Salvador', 'BA', '(71)94444-5555', '', 3, NULL),
(9, 'Corrida Atletas do Amanhã', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-09-07', '64010-000', 'Av. Frei Serafim', '456', 'Centro', 'Teresina', 'PI', '(86)97777-8888', '', NULL, 6),
(10, 'Encontro Viver Bem em Família', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-09-21', '59064-200', 'Rua São José', '300', 'Candelária', 'Natal', 'RN', '(84)93333-7777', '', 1, NULL),
(11, 'Aulão Funcional Vida Ativa', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-10-05', '01012-000', 'Av. São João', '50', 'República', 'São Paulo', 'SP', '(11)98888-1122', '', 3, NULL),
(12, 'Festival de Dança Crescer', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-10-19', '30110-030', 'Rua Espírito Santo', '100', 'Centro', 'Belo Horizonte', 'MG', '(31)93222-1122', '', NULL, 7),
(13, 'Campeonato de Futsal Joga Junto', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-11-02', '22775-040', 'Rua Godofredo Viana', '300', 'Barra da Tijuca', 'Rio de Janeiro', 'RJ', '(21)99999-7777', '', NULL, 4),
(14, 'Feira de Saúde Viver Bem', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-11-16', '59070-400', 'Av. Salgado Filho', '999', 'Lagoa Nova', 'Natal', 'RN', '(84)98877-6655', '', NULL, 7),
(15, 'Festival Transformar Jovens', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-12-01', '60055-200', 'Av. Santos Dumont', '1500', 'Centro', 'Fortaleza', 'CE', '(85)91234-0099', '', NULL, 1),
(16, 'Festival Vida Ativa 2025', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-03-10', '01001-000', 'Rua das Flores', '123', 'Centro', 'São Paulo', 'SP', '(11)91234-5678', 'Esportes', 1, NULL),
(17, 'Copa Joga Junto Sub-15', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-04-20', '20031-005', 'Rua do Catete', '89', 'Glória', 'Rio de Janeiro', 'RJ', '(21)92345-6789', 'Esportes', 3, NULL),
(18, 'Feira Crescer com Cidadania', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-05-05', '30150-030', 'Av. Augusto de Lima', '321', 'Centro', 'Belo Horizonte', 'MG', '(31)99812-1111', 'Desenvolvimento Social', NULL, 10),
(19, 'Torneio Bola no Pé 2025', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-06-01', '80010-180', 'Rua XV de Novembro', '101', 'Centro', 'Curitiba', 'PR', '(41)91111-2222', 'Esportes', NULL, 4),
(20, 'Mutirão Transformar Comunidade', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-06-15', '60165-121', 'Rua Silva Paulet', '88', 'Aldeota', 'Fortaleza', 'CE', '(85)93456-7890', 'Desenvolvimento Social', NULL, 10),
(21, 'Campeonato Futuro Campeão', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-07-10', '69075-000', 'Rua Pará', '205', 'Adrianópolis', 'Manaus', 'AM', '(92)94567-1234', 'Esportes', 3, NULL),
(22, 'Ação Solidária Mãos que Ajudam', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-08-03', '88110-200', 'Rua João Pio Duarte Silva', '98', 'Carvoeira', 'Florianópolis', 'SC', '(48)95544-6677', 'Desenvolvimento Social', NULL, 10),
(23, 'Torneio Gol de Placa - Etapa Bahia', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-08-17', '40020-000', 'Av. Sete de Setembro', '505', 'Vitória', 'Salvador', 'BA', '(71)94444-5555', 'Esportes', 3, NULL),
(24, 'Corrida Atletas do Amanhã', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-09-07', '64010-000', 'Av. Frei Serafim', '456', 'Centro', 'Teresina', 'PI', '(86)97777-8888', 'Esportes', NULL, 6),
(25, 'Encontro Viver Bem em Família', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-09-21', '59064-200', 'Rua São José', '300', 'Candelária', 'Natal', 'RN', '(84)93333-7777', 'Desenvolvimento Social', 1, NULL),
(26, 'Aulão Funcional Vida Ativa', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-10-05', '01012-000', 'Av. São João', '50', 'República', 'São Paulo', 'SP', '(11)98888-1122', 'Esportes', 3, NULL),
(27, 'Festival de Dança Crescer', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-10-19', '30110-030', 'Rua Espírito Santo', '100', 'Centro', 'Belo Horizonte', 'MG', '(31)93222-1122', 'Desenvolvimento Social', NULL, 7),
(28, 'Campeonato de Futsal Joga Junto', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-11-02', '22775-040', 'Rua Godofredo Viana', '300', 'Barra da Tijuca', 'Rio de Janeiro', 'RJ', '(21)99999-7777', 'Esportes', NULL, 4),
(29, 'Feira de Saúde Viver Bem', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-11-16', '59070-400', 'Av. Salgado Filho', '999', 'Lagoa Nova', 'Natal', 'RN', '(84)98877-6655', 'Desenvolvimento Social', NULL, 7),
(30, 'Festival Transformar Jovens', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam nemo eligendi tenetur non distinctio qui dicta a dolorem exercitationem incidunt consequatur, quas et molestiae cumque similique atque dolorum? Aliquid, alias?', '2025-12-01', '60055-200', 'Av. Santos Dumont', '1500', 'Centro', 'Fortaleza', 'CE', '(85)91234-0099', 'Desenvolvimento Social', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `nome_arquivo` varchar(100) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `projetos_id` int(11) DEFAULT NULL,
  `eventos_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `projetos`
--

CREATE TABLE `projetos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `CEP` varchar(9) NOT NULL,
  `RUA` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `UF` char(2) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `categoria` enum('Cultura','Saúde','Educação','Meio Ambiente','Desenvolvimento Social','Assistência Social','Esportes','Apoio a Grupos Vulneráveis','Combate à Violência','Apoio a Animais','Ações de Voluntariado') NOT NULL,
  `usuarios_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `projetos`
--

INSERT INTO `projetos` (`id`, `nome`, `CEP`, `RUA`, `numero`, `bairro`, `cidade`, `UF`, `telefone`, `categoria`, `usuarios_id`) VALUES
(1, 'Projeto Vida Ativa', '01001-000', 'Rua das Flores', '123', 'Centro', 'São Paulo', 'SP', '(11)91234-5678', '', 2),
(2, 'Instituto Joga Junto', '20040-002', 'Av. Atlântica', '456', 'Copacabana', 'Rio de Janeiro', 'RJ', '(21)98765-4321', '', 2),
(3, 'Centro Social Crescer', '30130-010', 'Rua da Bahia', '789', 'Funcionários', 'Belo Horizonte', 'MG', '(31)99876-5432', '', 4),
(4, 'Projeto Bola no Pé', '80010-180', 'Rua XV de Novembro', '101', 'Centro', 'Curitiba', 'PR', '(41)98888-1111', '', 5),
(5, 'Associação Transformar', '60025-120', 'Av. Beira Mar', '202', 'Meireles', 'Fortaleza', 'CE', '(85)97777-2222', '', 4),
(6, 'Escola de Esportes Futuro Campeão', '69050-020', 'Rua Japurá', '303', 'Centro', 'Manaus', 'AM', '(92)96666-3333', '', 2),
(7, 'Projeto Mãos que Ajudam', '88010-400', 'Rua Felipe Schmidt', '404', 'Centro', 'Florianópolis', 'SC', '(48)95555-4444', '', 4),
(8, 'Instituto Gol de Placa', '40020-000', 'Av. Sete de Setembro', '505', 'Vitória', 'Salvador', 'BA', '(71)94444-5555', '', 5),
(9, 'Centro Esportivo Atletas do Amanhã', '64000-020', 'Rua Álvaro Mendes', '606', 'Centro', 'Teresina', 'PI', '(86)93333-6666', '', 2),
(10, 'Projeto Social Viver Bem', '59020-200', 'Av. Prudente de Morais', '707', 'Lagoa Nova', 'Natal', 'RN', '(84)92222-7777', '', 4),
(11, 'Projeto Vida Ativa', '01001-000', 'Rua das Flores', '123', 'Centro', 'São Paulo', 'SP', '(11)91234-5678', 'Esportes', 2),
(12, 'Instituto Joga Junto', '20040-002', 'Av. Atlântica', '456', 'Copacabana', 'Rio de Janeiro', 'RJ', '(21)98765-4321', 'Esportes', 2),
(13, 'Centro Social Crescer', '30130-010', 'Rua da Bahia', '789', 'Funcionários', 'Belo Horizonte', 'MG', '(31)99876-5432', 'Desenvolvimento Social', 4),
(14, 'Projeto Bola no Pé', '80010-180', 'Rua XV de Novembro', '101', 'Centro', 'Curitiba', 'PR', '(41)98888-1111', 'Esportes', 5),
(15, 'Associação Transformar', '60025-120', 'Av. Beira Mar', '202', 'Meireles', 'Fortaleza', 'CE', '(85)97777-2222', 'Desenvolvimento Social', 4),
(16, 'Escola de Esportes Futuro Campeão', '69050-020', 'Rua Japurá', '303', 'Centro', 'Manaus', 'AM', '(92)96666-3333', 'Esportes', 2),
(17, 'Projeto Mãos que Ajudam', '88010-400', 'Rua Felipe Schmidt', '404', 'Centro', 'Florianópolis', 'SC', '(48)95555-4444', 'Desenvolvimento Social', 4),
(18, 'Instituto Gol de Placa', '40020-000', 'Av. Sete de Setembro', '505', 'Vitória', 'Salvador', 'BA', '(71)94444-5555', 'Esportes', 5),
(19, 'Centro Esportivo Atletas do Amanhã', '64000-020', 'Rua Álvaro Mendes', '606', 'Centro', 'Teresina', 'PI', '(86)93333-6666', 'Esportes', 2),
(20, 'Projeto Social Viver Bem', '59020-200', 'Av. Prudente de Morais', '707', 'Lagoa Nova', 'Natal', 'RN', '(84)92222-7777', 'Desenvolvimento Social', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Ana Souza', 'ana.souza@email.com', 'senhaCriptografada123'),
(2, 'Bruno Lima', 'bruno.lima@email.com', 'seguraSenha456'),
(3, 'Carla Mendes', 'carla.mendes@email.com', 'senhaForte789'),
(4, 'Diego Rocha', 'diego.rocha@email.com', 'minhaSenha321'),
(5, 'Eduarda Castro', 'eduarda.castro@email.com', 'outraSenha654');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_id` (`usuarios_id`),
  ADD KEY `projetos_id` (`projetos_id`);

--
-- Índices de tabela `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_id` (`usuarios_id`),
  ADD KEY `projetos_id` (`projetos_id`),
  ADD KEY `eventos_id` (`eventos_id`);

--
-- Índices de tabela `projetos`
--
ALTER TABLE `projetos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_id` (`usuarios_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `projetos`
--
ALTER TABLE `projetos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`projetos_id`) REFERENCES `projetos` (`id`);

--
-- Restrições para tabelas `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `fotos_ibfk_2` FOREIGN KEY (`projetos_id`) REFERENCES `projetos` (`id`),
  ADD CONSTRAINT `fotos_ibfk_3` FOREIGN KEY (`eventos_id`) REFERENCES `eventos` (`id`);

--
-- Restrições para tabelas `projetos`
--
ALTER TABLE `projetos`
  ADD CONSTRAINT `projetos_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
