-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Jun-2023 às 19:16
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `3dsams-2023`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `area`
--

INSERT INTO `area` (`id`, `nome`) VALUES
(2, 'DS'),
(3, 'DS'),
(5, 'a'),
(6, 'nn'),
(7, 'a'),
(8, 'a'),
(9, 'a'),
(10, 'a');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `ramal` int(11) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `descricao`, `ramal`, `imagem`) VALUES
(2, 'teste', 456, NULL),
(4, 'a', 132, 'eab3732532982793cc03b061d9c4130feb1cf67d.png'),
(6, 'a', 123, '600da3739274770619891789e8ada5b4fdd32454.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `duracao` varchar(24) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `nome`, `duracao`, `id_categoria`) VALUES
(4, 'a', '4', NULL),
(8, 'TMA', '3', NULL),
(20, 'DS', '2 horas', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `id_categoria`) VALUES
(7, 'a', 2),
(8, 'a', 2),
(9, 'produto', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `area` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`id`, `nome`, `email`, `area`) VALUES
(2, 'Teste', 'a', 'DS'),
(4, 'Teste', 'teste@email.com', 'ADM');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `id` (`id_categoria`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices para tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `area` (`id`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
