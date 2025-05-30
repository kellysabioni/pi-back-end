-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/05/2025 às 03:27
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
  `hora` time NOT NULL,
  `CEP` varchar(9) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `UF` char(2) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `categoria` enum('Indefinido','Cultura','Saude','Educacao','MeioAmbiente','DesenvolvimentoSocial','AssistenciaSocial','Esportes','ApoioAGruposVulneraveis','CombateAViolencia','ApoioAAnimais','AcoesDeVoluntariado') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  `projetos_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id`, `nome`, `descricao`, `data`, `hora`, `CEP`, `rua`, `numero`, `bairro`, `cidade`, `UF`, `telefone`, `categoria`, `created_at`, `updated_at`, `usuarios_id`, `projetos_id`) VALUES
(1, 'Mãos que Transformam', 'Bora ajudar ', '2025-07-12', '15:00:00', '01045-000', 'Praça da República', 's/n', 'República', 'São Paulo', 'SP', '(11) 99999-1515', 'AcoesDeVoluntariado', '2025-05-29 22:07:04', NULL, 5, 1),
(2, 'Feira de Adoção e Bem-Estar Animal', 'Me leva pra casa', '2025-09-06', '12:00:00', '03178-200', 'Rua Joá', '10', 'Alto da Mooca', 'São Paulo', 'SP', '(11) 99999-1515', 'ApoioAAnimais', '2025-05-29 22:09:21', NULL, 5, NULL),
(3, 'Rede de Apoio e Inclusão', 'Conte com a gente ', '2025-08-20', '20:00:00', '02236-000', 'Rua Rei Alberto', '20', 'Parque Edu Chaves', 'São Paulo', 'SP', '(11) 99999-9999', 'ApoioAGruposVulneraveis', '2025-05-29 22:17:48', NULL, 6, NULL),
(4, 'Conexão Solidária SP', 'Não sei mais o que escrever', '2025-06-15', '15:00:00', '02995-000', 'Rua Friedrich Von Voith', '10', 'Jardim São João (Jaraguá)', 'São Paulo', 'SP', '(11) 99558-8441', 'AssistenciaSocial', '2025-05-29 22:26:07', NULL, 8, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `nome_arquivo` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `usuarios_id` int(11) NOT NULL,
  `projetos_id` int(11) DEFAULT NULL,
  `eventos_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fotos`
--

INSERT INTO `fotos` (`id`, `nome_arquivo`, `created_at`, `usuarios_id`, `projetos_id`, `eventos_id`) VALUES
(5, '6838fbd5081d8_1748564949.PNG', '2025-05-29 21:29:09', 5, NULL, NULL),
(6, '6838fbea2f5ca_1748564970.PNG', '2025-05-29 21:29:30', 6, NULL, NULL),
(7, '6838fc3673f2d_1748565046.PNG', '2025-05-29 21:30:46', 7, NULL, NULL),
(8, '6838fc498d324_1748565065.PNG', '2025-05-29 21:31:05', 8, NULL, NULL),
(9, '6838fc5e43b89_1748565086.PNG', '2025-05-29 21:31:26', 9, NULL, NULL),
(10, '6838fc7ede21f_1748565118.PNG', '2025-05-29 21:31:58', 10, NULL, NULL),
(11, '6838fcb322a91_1748565171.PNG', '2025-05-29 21:32:51', 11, NULL, NULL),
(12, '6838fcc5d4fcd_1748565189.PNG', '2025-05-29 21:33:09', 12, NULL, NULL),
(13, '6838fcdab932c_1748565210.PNG', '2025-05-29 21:33:30', 13, NULL, NULL),
(14, '6838fcfa0796c_1748565242.PNG', '2025-05-29 21:34:02', 14, NULL, NULL),
(15, '6838fd1dc7ed0_1748565277.PNG', '2025-05-29 21:34:37', 15, NULL, NULL),
(16, '6838fd396ff78_1748565305.PNG', '2025-05-29 21:35:05', 16, NULL, NULL),
(17, '6838fd4ef27d5_1748565326.PNG', '2025-05-29 21:35:26', 17, NULL, NULL),
(18, '6838fd6632bb2_1748565350.PNG', '2025-05-29 21:35:50', 18, NULL, NULL),
(19, '6838fd830cec1_1748565379.PNG', '2025-05-29 21:36:19', 19, NULL, NULL),
(20, '6838fdd3a826a_1748565459.PNG', '2025-05-29 21:37:39', 20, NULL, NULL),
(21, '6838fe6e3156f_1748565614.PNG', '2025-05-29 21:40:14', 21, NULL, NULL),
(22, '6838fe7f98163_1748565631.PNG', '2025-05-29 21:40:31', 22, NULL, NULL),
(23, '6839046e4e500_1748567150.PNG', '2025-05-29 22:05:50', 5, 1, NULL),
(24, '683904b84daf7_1748567224.PNG', '2025-05-29 22:07:04', 5, NULL, 1),
(25, '68390541c3f3f_1748567361.PNG', '2025-05-29 22:09:21', 5, NULL, 2),
(26, '6839073c64f37_1748567868.PNG', '2025-05-29 22:17:48', 6, NULL, 3),
(27, '683908055fc74_1748568069.PNG', '2025-05-29 22:21:09', 7, 2, NULL),
(28, '683908afb1d4e_1748568239.PNG', '2025-05-29 22:23:59', 8, 3, NULL),
(29, '6839092f68e7e_1748568367.PNG', '2025-05-29 22:26:07', 8, NULL, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `projetos`
--

CREATE TABLE `projetos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `CEP` varchar(9) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `UF` char(2) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `categoria` enum('Indefinido','Cultura','Saude','Educacao','MeioAmbiente','DesenvolvimentoSocial','AssistenciaSocial','Esportes','ApoioAGruposVulneraveis','CombateAViolencia','ApoioAAnimais','AcoesDeVoluntariado') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `projetos`
--

INSERT INTO `projetos` (`id`, `nome`, `CEP`, `rua`, `numero`, `bairro`, `cidade`, `UF`, `telefone`, `categoria`, `created_at`, `updated_at`, `usuarios_id`) VALUES
(1, 'Conecta Voluntário', '01156-000', 'Rua Tagipuru', '10', 'Barra Funda', 'São Paulo', 'SP', '(11) 99999-', 'AcoesDeVoluntariado', '2025-05-29 22:05:50', NULL, 5),
(2, 'Patas do Bem', '04849-000', 'Rua Gilberto Freyre', '10', 'Parque Residencial Cocaia', 'São Paulo', 'SP', '(11) 99955-', 'ApoioAAnimais', '2025-05-29 22:21:09', NULL, 7),
(3, 'Vozes Visíveis', '03977-000', 'Rua Tenente Godofredo Cerqueira Leite', '10', 'Fazenda da Juta', 'São Paulo', 'SP', '(11) 99665-', 'ApoioAGruposVulneraveis', '2025-05-29 22:23:59', NULL, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` enum('usuario','cadastro','admin') NOT NULL DEFAULT 'usuario',
  `cpf` varchar(14) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo_usuario`, `cpf`, `data_nascimento`, `created_at`, `updated_at`) VALUES
(5, 'Marilia dos Santos', 'teste01@teste.com', '$2y$10$XWobKsuhoAzlcDfPiTjPx.pahyeawxqHL/eieakHl33MgwMxwdQIm', 'cadastro', '595.472.050-99', '2000-11-20', '2025-05-29 21:29:09', '2025-05-29 21:43:39'),
(6, 'Cristina Ferreira', 'teste02@teste.com', '$2y$10$uOXVDzqqsc7yFbp1m1UawOucPqgPLbdO.GPqn59TBvfWx4yzJKyja', 'cadastro', '605.505.382-79', '1999-03-15', '2025-05-29 21:29:30', '2025-05-29 22:12:29'),
(7, 'Gilberto Correa', 'teste03@teste.com', '$2y$10$MnUxkH9ifh.FIYxicFGe9.1PGg1.QL5EMJWiLbGRfEgkD6bF9EcIO', 'cadastro', '723.732.359-67', '1995-05-05', '2025-05-29 21:30:46', '2025-05-29 22:19:58'),
(8, 'Silvia Barbosa', 'teste04@teste.com', '$2y$10$M6QdtwS4BaGn0XIhrd8xN.gFtnXGKT80bdgDOuMqmNrpKt3jJfQ7S', 'cadastro', '136.596.478-55', '1990-12-31', '2025-05-29 21:31:05', '2025-05-29 22:22:19'),
(9, 'Livia Araujo', 'teste05@teste.com', '$2y$10$vXtePZ0P0u0igYm8xTRozeu4Q0ZxCCdlbpYtHMEp7G.XLapLYRmgi', 'usuario', NULL, NULL, '2025-05-29 21:31:26', NULL),
(10, 'Luiz Gonzales', 'teste06@teste.com', '$2y$10$gGPtd3GC.YwCUjW.8q5UWeHQH5zuSrIjuGM0c8YOBVcQtort5hFTW', 'usuario', NULL, NULL, '2025-05-29 21:31:58', NULL),
(11, 'Mario Quintana', 'teste07@teste.com', '$2y$10$CFaPBv6m5TewXGypo7eKPekO5E9GueakH4LDyO0qjlp7C53rowzTe', 'usuario', NULL, NULL, '2025-05-29 21:32:51', NULL),
(12, 'Daniel Silva', 'teste08@teste.com', '$2y$10$7rti0CG1T/37MKZXokPLT.i6fSX/AbQv4Go0ryrv3r4eLxV2fEjtS', 'usuario', NULL, NULL, '2025-05-29 21:33:09', NULL),
(13, 'Guilherme de Almeida', 'teste09@teste.com', '$2y$10$iaHzs/MgQfQU8Pic/18hI.NsQcOzoQj444O.FMLrs25MMRcMF1CEm', 'usuario', NULL, NULL, '2025-05-29 21:33:30', NULL),
(14, 'Lucas Mendes', 'teste10@teste.com', '$2y$10$G0iLQ/fHcncJ4UoC6uHIderRdRGgNZN8yWsifcopv3wxLkZywyxsy', 'usuario', NULL, NULL, '2025-05-29 21:34:02', NULL),
(15, 'Mirela Muniz', 'teste11@teste.com', '$2y$10$uEjOZ4Fn.6jxVqiygHOQDe5RAxHYaX6WouCKURcPecslaWLr/anOS', 'usuario', NULL, NULL, '2025-05-29 21:34:37', NULL),
(16, 'Claudia Guimaraes', 'teste12@teste.com', '$2y$10$2loEcB5CG5x2zbByFhTZSuVaK72pPMFyvp0kF.oLpbschiXZZN8aO', 'usuario', NULL, NULL, '2025-05-29 21:35:05', NULL),
(17, 'Roberto Magalhaes', 'teste13@teste.com', '$2y$10$eFLb0QuUuxaGTXG0VlIrL.JI6ymYZ4sYrkTw6XSDZ43Q0gbGnjid.', 'usuario', NULL, NULL, '2025-05-29 21:35:26', NULL),
(18, 'Milton Neves', 'teste14@teste.com', '$2y$10$jkTegYZwEH3yd0BUtvLXKOZWh4xJpqnW1MESMm90iet5wp5atlO/C', 'usuario', NULL, NULL, '2025-05-29 21:35:50', NULL),
(19, 'Felipe Alves', 'teste15@teste.com', '$2y$10$yHkDIlRkfYOWSxIm32JYNual8ZK8Y6iu4BcLgeUqmeRp7xewTCuvm', 'usuario', NULL, NULL, '2025-05-29 21:36:19', NULL),
(20, 'Paula Duarte', 'teste16@teste.com', '$2y$10$eyfODcOL2uiJ2cImt1xREekvKn2GUOHbvM7l7QNY81XGJoU5glyIS', 'usuario', NULL, NULL, '2025-05-29 21:37:39', NULL),
(21, 'Aline Silva', 'teste17@teste.com', '$2y$10$LG3OTfOj1gzfXTEetTxvdOk9m.70kVaZ26Ons20ztzpJNtLnp2QTS', 'usuario', NULL, NULL, '2025-05-29 21:40:14', NULL),
(22, 'Juliana Santos', 'teste18@teste.com', '$2y$10$NS3GpoS2ScCOm.tIgM004eov8Mw/iclFlAXe6kXkKdotjYS5aVBla', 'usuario', NULL, NULL, '2025-05-29 21:40:31', NULL);

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
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `projetos`
--
ALTER TABLE `projetos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`projetos_id`) REFERENCES `projetos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fotos_ibfk_2` FOREIGN KEY (`projetos_id`) REFERENCES `projetos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fotos_ibfk_3` FOREIGN KEY (`eventos_id`) REFERENCES `eventos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `projetos`
--
ALTER TABLE `projetos`
  ADD CONSTRAINT `projetos_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
