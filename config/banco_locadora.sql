-- phpMyAdmin SQL Dump
-- version 5.2.1deb1+deb12u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 22/12/2025 às 08:59
-- Versão do servidor: 10.11.14-MariaDB-0+deb12u2
-- Versão do PHP: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `locadora_agil`
--
CREATE DATABASE IF NOT EXISTS `locadora_agil` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `locadora_agil`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `carros`
--

CREATE TABLE `carros` (
  `id` int(11) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `imagem_url` varchar(255) DEFAULT NULL,
  `preco_diaria` decimal(10,2) NOT NULL,
  `ano_fabricacao` int(11) DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `cambio` enum('Manual','Automático') DEFAULT 'Manual',
  `motor` varchar(50) DEFAULT '1.0 Flex',
  `lugares` int(11) DEFAULT 5,
  `portas` int(11) DEFAULT 4,
  `ar_condicionado` tinyint(1) DEFAULT 1,
  `direcao` varchar(50) DEFAULT 'Elétrica',
  `cor` varchar(30) DEFAULT NULL,
  `km_atual` int(11) DEFAULT 0,
  `tipo_combustivel` enum('Gasolina','Etanol','Flex','Diesel','Elétrico') DEFAULT 'Flex',
  `status_carro` enum('DISPONIVEL','ALUGADO','MANUTENCAO','LAVAGEM') DEFAULT 'DISPONIVEL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carros`
--

INSERT INTO `carros` (`id`, `modelo`, `placa`, `descricao`, `imagem_url`, `preco_diaria`, `ano_fabricacao`, `categoria_id`, `cambio`, `motor`, `lugares`, `portas`, `ar_condicionado`, `direcao`, `cor`, `km_atual`, `tipo_combustivel`, `status_carro`) VALUES
(1, 'Econômico Compacto', 'ABC-1234', 'Perfeito para a cidade. Baixo consumo.', 'img/carros/photo-1542362567-b07e54358753.avif', 95.00, NULL, 1, 'Manual', '1.6 Flex', 5, 4, 1, 'Elétrica', NULL, 0, 'Flex', 'DISPONIVEL'),
(2, 'Executivo Sedã', 'DEF-5678', 'Conforto premium e tecnologia de ponta.', 'img/carros/photo-1503736334956-4c8f8e92946d.avif', 180.00, NULL, 2, 'Automático', '2.0 Turbo', 5, 4, 1, 'Elétrica', NULL, 0, 'Gasolina', 'DISPONIVEL'),
(3, 'SUV Confort', 'GHI-9012', 'Espaço de sobra e segurança total.', 'img/carros/photo-1511919884226-fd3cad34687c.avif', 240.00, NULL, 3, 'Automático', '1.6 Turbo Diesel', 7, 4, 1, 'Elétrica', NULL, 0, 'Diesel', 'DISPONIVEL'),
(4, 'Hatch Ágil', 'JKL-3456', 'Combinação ideal de economia e design.', 'img/carros/2013_Volkswagen_up.jpg', 110.00, NULL, 1, 'Manual', '1.0 Flex', 5, 4, 1, 'Elétrica', NULL, 0, 'Flex', 'DISPONIVEL');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `descricao`) VALUES
(1, 'Econômico', NULL),
(2, 'Executivo', NULL),
(3, 'SUV', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cnh` varchar(20) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `senha`, `cnh`, `telefone`, `data_cadastro`) VALUES
(1, 'João Silva', 'joao@email.com', '123456', '12345678900', NULL, '2025-12-19 18:55:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `matricula` varchar(20) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cargo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `nome`, `matricula`, `senha`, `cargo`) VALUES
(1, 'Maria Gerente', 'FUNC01', 'admin123', 'Gerente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `carro_id` int(11) NOT NULL,
  `data_reserva` datetime DEFAULT current_timestamp(),
  `data_retirada` datetime NOT NULL,
  `data_devolucao_prevista` datetime NOT NULL,
  `data_devolucao_real` datetime DEFAULT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `status` enum('CONFIRMADA','ATIVA','CONCLUIDA','CANCELADA') DEFAULT 'CONFIRMADA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reservas`
--

INSERT INTO `reservas` (`id`, `cliente_id`, `carro_id`, `data_reserva`, `data_retirada`, `data_devolucao_prevista`, `data_devolucao_real`, `valor_total`, `status`) VALUES
(1, 1, 1, '2025-12-19 18:55:11', '2023-10-01 10:00:00', '2023-10-05 10:00:00', '2023-10-05 09:30:00', 380.00, 'CONCLUIDA'),
(2, 1, 2, '2025-12-19 18:55:11', '2025-12-19 18:55:11', '2025-12-22 18:55:11', NULL, 540.00, 'ATIVA'),
(3, 1, 3, '2025-12-19 18:55:11', '2025-12-14 18:55:11', '2025-12-18 18:55:11', NULL, 960.00, 'ATIVA');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carros`
--
ALTER TABLE `carros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `placa` (`placa`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cnh` (`cnh`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricula` (`matricula`);

--
-- Índices de tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `carro_id` (`carro_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carros`
--
ALTER TABLE `carros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carros`
--
ALTER TABLE `carros`
  ADD CONSTRAINT `carros_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Restrições para tabelas `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`carro_id`) REFERENCES `carros` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
