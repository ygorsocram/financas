-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Dez-2018 às 17:38
-- Versão do servidor: 10.1.35-MariaDB
-- versão do PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `financas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bandeiras`
--

CREATE TABLE `bandeiras` (
  `id_bandera` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bandeiras`
--

INSERT INTO `bandeiras` (`id_bandera`, `nome`) VALUES
(1, 'Visa'),
(2, 'MasterCard'),
(3, 'HiperCard'),
(4, 'American Express'),
(5, 'SoroCard'),
(6, 'BNDS'),
(7, 'Dinners'),
(8, 'Outra bandeira');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartoes`
--

CREATE TABLE `cartoes` (
  `id_cartao` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `limite` double NOT NULL,
  `dia_fechamento` int(11) DEFAULT '1',
  `dia_pagamento` int(11) DEFAULT '1',
  `id_bandeira` int(11) NOT NULL,
  `id_conta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cartoes`
--

INSERT INTO `cartoes` (`id_cartao`, `nome`, `limite`, `dia_fechamento`, `dia_pagamento`, `id_bandeira`, `id_conta`) VALUES
(1, 'Nu Bank Ygor', 10000, 3, 10, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nome`, `id_tipo`) VALUES
(0, 'OPA', 1),
(1, 'GERAL', 2),
(2, 'GERAL2', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas`
--

CREATE TABLE `contas` (
  `id_conta` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `saldo` float(10,2) NOT NULL,
  `inclui_somatorio` varchar(1) NOT NULL DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `contas`
--

INSERT INTO `contas` (`id_conta`, `nome`, `saldo`, `inclui_somatorio`) VALUES
(1, 'CARTEIRA', 0.00, 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tags`
--

CREATE TABLE `tags` (
  `id_tag` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tags_transacoes`
--

CREATE TABLE `tags_transacoes` (
  `id_tag` int(11) NOT NULL,
  `id_transacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos`
--

CREATE TABLE `tipos` (
  `id_tipo` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipos`
--

INSERT INTO `tipos` (`id_tipo`, `nome`) VALUES
(1, 'Receita'),
(2, 'Despesa'),
(3, 'Cartão'),
(4, 'Transferência');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transacoes`
--

CREATE TABLE `transacoes` (
  `id_transacao` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `valor` float(10,2) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `data_cadastro` date NOT NULL,
  `data_efetivada` date DEFAULT NULL,
  `pago` varchar(1) DEFAULT 'N',
  `id_conta` int(11) NOT NULL,
  `observacao` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `transacoes`
--

INSERT INTO `transacoes` (`id_transacao`, `nome`, `valor`, `id_categoria`, `data_cadastro`, `data_efetivada`, `pago`, `id_conta`, `observacao`) VALUES
(17, 'teste', 12.00, 1, '2018-12-12', '2018-12-11', 'S', 1, ''),
(33, 'miauuu', 12.00, 1, '2018-12-12', NULL, 'N', 1, ''),
(34, 'miauuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu', 12.00, 1, '2018-12-11', NULL, 'S', 1, ''),
(35, 'esta pago sim', 666.00, 1, '2018-12-11', NULL, 'S', 1, ''),
(36, 'ta pago não', 23.00, 1, '2018-12-11', NULL, 'N', 1, ''),
(37, 'miauu', 12.00, 0, '2018-12-11', '2018-12-12', 'S', 1, ''),
(38, 'teste', 15.00, 0, '2018-11-11', '0000-00-00', 'N', 1, ''),
(39, 'transacao geral2', 12.12, 2, '2018-12-12', NULL, 'S', 1, ''),
(40, 'eits', 12.00, 0, '2018-12-12', '2018-12-12', 'S', 1, ''),
(42, 'hoje', 120.00, 0, '2018-12-12', '2018-12-12', 'S', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bandeiras`
--
ALTER TABLE `bandeiras`
  ADD PRIMARY KEY (`id_bandera`);

--
-- Indexes for table `cartoes`
--
ALTER TABLE `cartoes`
  ADD PRIMARY KEY (`id_cartao`),
  ADD KEY `fk_cartao_conta` (`id_conta`),
  ADD KEY `fk_cartao_bandeira` (`id_bandeira`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `fk_grupos_tipos` (`id_tipo`);

--
-- Indexes for table `contas`
--
ALTER TABLE `contas`
  ADD PRIMARY KEY (`id_conta`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tag`);

--
-- Indexes for table `tags_transacoes`
--
ALTER TABLE `tags_transacoes`
  ADD PRIMARY KEY (`id_tag`,`id_transacao`),
  ADD KEY `fk_tags_has_lancameto1` (`id_transacao`);

--
-- Indexes for table `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indexes for table `transacoes`
--
ALTER TABLE `transacoes`
  ADD PRIMARY KEY (`id_transacao`),
  ADD KEY `fk_lancamentos_contas1` (`id_conta`),
  ADD KEY `fk_lancamentos_grupos1` (`id_categoria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bandeiras`
--
ALTER TABLE `bandeiras`
  MODIFY `id_bandera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cartoes`
--
ALTER TABLE `cartoes`
  MODIFY `id_cartao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transacoes`
--
ALTER TABLE `transacoes`
  MODIFY `id_transacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `cartoes`
--
ALTER TABLE `cartoes`
  ADD CONSTRAINT `fk_cartao_bandeira` FOREIGN KEY (`id_bandeira`) REFERENCES `bandeiras` (`id_bandera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cartao_conta` FOREIGN KEY (`id_conta`) REFERENCES `contas` (`id_conta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_grupos_tipos` FOREIGN KEY (`id_tipo`) REFERENCES `tipos` (`id_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tags_transacoes`
--
ALTER TABLE `tags_transacoes`
  ADD CONSTRAINT `fk_tags_has_lancamentos_tags1` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id_tag`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tags_has_lancameto1` FOREIGN KEY (`id_transacao`) REFERENCES `transacoes` (`id_transacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `transacoes`
--
ALTER TABLE `transacoes`
  ADD CONSTRAINT `fk_lancamentos_contas1` FOREIGN KEY (`id_conta`) REFERENCES `contas` (`id_conta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lancamentos_grupos1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
