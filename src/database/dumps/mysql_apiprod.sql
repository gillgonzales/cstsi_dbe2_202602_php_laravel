-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Tempo de geração: 28/12/2025 às 17:46
-- Versão do servidor: 12.1.2-MariaDB-ubu2404
-- Versão do PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `apiprods`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `descontos`
--

CREATE TABLE `descontos` (
  `id_desc` bigint(20) UNSIGNED NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `taxa` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `descontos`
--

INSERT INTO `descontos` (`id_desc`, `descricao`, `taxa`) VALUES
(5, 'Black Friday', 20.00),
(6, 'Cyber Monday', 15.00),
(7, 'Natal', 25.00),
(8, 'Ano Novo', 22.00),
(9, 'Carnaval', 10.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `extras`
--

CREATE TABLE `extras` (
  `id_ext` bigint(20) UNSIGNED NOT NULL,
  `descricao` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `extras`
--

INSERT INTO `extras` (`id_ext`, `descricao`) VALUES
(1, 'cumque'),
(2, 'accusamus'),
(3, 'veniam'),
(4, 'sint');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_prod` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(200) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `qtd_estoque` int(11) NOT NULL DEFAULT 0,
  `preco` decimal(10,2) NOT NULL,
  `importado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_prod`, `nome`, `descricao`, `qtd_estoque`, `preco`, `importado`) VALUES
(111, 'Samsumg A5 - 2017 - Seminovo', 'Samsumg A5 2017 2GB Exynos 8Core', 2, 1350.00, 1),
(112, 'Notebook DELL Inspiron 15', 'I5 7600HQ 8GBMen GTX1030m SSD 1TB', 300, 8500.00, 0),
(113, 'Notebook Samsumg Gamer', 'I7 10800HQ 16GB MEM NVIDIA-RTX2060m SSD 2TB', 150, 17500.00, 0),
(114, 'SSD 4TB', 'SSD SAMSUMG EVO 860 4TB', 200, 5750.00, 0),
(115, 'SSD 2TB', 'SSD SAMSUMG EVO 860 2TB', 150, 3750.00, 0),
(121, 'SSD 4TB', 'SSD WESTERN DIGITAL', 50, 4150.00, 0),
(122, 'GAINWARD PHOENIX RTX3080ti', 'GPU NVIDIA 12GB MEM GDDR6 256BITS GAINWARD PHOENIX ', 30, 14150.00, 0),
(123, 'GAINWARD PHOENIX RTX3070', 'GPU NVIDIA 8GB MEM GDDR6 256BITS GAINWARD PHOENIX ', 60, 7399.00, 0),
(124, 'ECHO DOT ALEXA', 'AMAZON ALEX ECHO DOT 3 GEN SMART SPEAKER', 1000, 200.00, 0),
(125, 'Monitor Asus BK 35\'\'', 'LED 35\" 3440x1440 Preto 1 HDMI(v1.4)', 500, 9990.00, 0),
(129, 'PEN DRIVE', '256GB KINGSTON ', 200, 250.00, 1),
(130, 'Placa de Vídeo Branca', 'Placa de Vídeo 24GB RTX 5090 NVidia', 100, 12400.00, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `prod_desc`
--

CREATE TABLE `prod_desc` (
  `id_prod` bigint(20) UNSIGNED NOT NULL,
  `id_desc` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `prod_desc`
--

INSERT INTO `prod_desc` (`id_prod`, `id_desc`) VALUES
(122, 5),
(123, 5),
(125, 5),
(124, 6),
(121, 7),
(123, 7),
(124, 7),
(125, 7),
(124, 8),
(123, 9),
(125, 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `prod_ext`
--

CREATE TABLE `prod_ext` (
  `id_prod` bigint(20) UNSIGNED NOT NULL,
  `id_ext` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `nome` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`nome`, `email`, `password`, `id`) VALUES
('admin', 'admin@dev.test', '$2y$12$qkgnxyTLFpxcTe/QvTg4MOFUUtnrxASqd0/t5qZVnzpJ0CmqbEjZS', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `descontos`
--
ALTER TABLE `descontos`
  ADD PRIMARY KEY (`id_desc`);

--
-- Índices de tabela `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id_ext`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_prod`);

--
-- Índices de tabela `prod_desc`
--
ALTER TABLE `prod_desc`
  ADD PRIMARY KEY (`id_prod`,`id_desc`),
  ADD KEY `id_desc` (`id_desc`);

--
-- Índices de tabela `prod_ext`
--
ALTER TABLE `prod_ext`
  ADD PRIMARY KEY (`id_prod`,`id_ext`),
  ADD KEY `id_ext` (`id_ext`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `descontos`
--
ALTER TABLE `descontos`
  MODIFY `id_desc` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `extras`
--
ALTER TABLE `extras`
  MODIFY `id_ext` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_prod` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `prod_desc`
--
ALTER TABLE `prod_desc`
  ADD CONSTRAINT `prod_desc_ibfk_1` FOREIGN KEY (`id_prod`) REFERENCES `produtos` (`id_prod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prod_desc_ibfk_2` FOREIGN KEY (`id_desc`) REFERENCES `descontos` (`id_desc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `prod_ext`
--
ALTER TABLE `prod_ext`
  ADD CONSTRAINT `prod_ext_ibfk_1` FOREIGN KEY (`id_prod`) REFERENCES `produtos` (`id_prod`),
  ADD CONSTRAINT `prod_ext_ibfk_2` FOREIGN KEY (`id_ext`) REFERENCES `extras` (`id_ext`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
