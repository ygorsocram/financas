-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14-Dez-2018 às 01:25
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
  `vlr_limite` float(10,2) NOT NULL,
  `dia_fechamento` int(11) DEFAULT '1',
  `dia_pagamento` int(11) DEFAULT '1',
  `id_bandeira` int(11) NOT NULL,
  `id_conta` int(11) NOT NULL,
  `vlr_aberto` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cartoes`
--

INSERT INTO `cartoes` (`id_cartao`, `nome`, `vlr_limite`, `dia_fechamento`, `dia_pagamento`, `id_bandeira`, `id_conta`, `vlr_aberto`) VALUES
(1, 'NuBank Ygor', 9500.00, 3, 10, 2, 1, 563.54),
(2, 'Inter Ygor', 1000.00, 30, 10, 2, 1, 0.00),
(3, 'Digio Ygor', 1350.00, 15, 25, 1, 1, 0.00),
(4, 'NuBank Isaac', 3100.00, 17, 24, 2, 1, 0.00),
(5, 'Inter Isaac', 4225.00, 30, 10, 2, 1, 0.00);

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
(1, 'OUTRAS', 2),
(2, 'TELEFONIA', 2),
(3, 'SALARIO', 1),
(4, 'ALIMENTAÇÃO', 2),
(5, 'APARENCIA', 2),
(6, 'EDUCAÇÃO', 2),
(7, 'DESPESAS INUTEIS', 2),
(8, 'EMPRESTIMOS', 2),
(9, 'JUNK FOOD', 2),
(10, 'JUROS', 2),
(11, 'LAZER', 2),
(12, 'MORADIA', 2),
(13, 'PICPAY', 2),
(14, 'PRESENTES', 2),
(15, 'SAUDE', 2),
(16, 'TRANSPORTE', 2),
(17, 'VIAGENS', 2);

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
-- Estrutura da tabela `faturas`
--

CREATE TABLE `faturas` (
  `id_fatura` int(11) NOT NULL,
  `id_cartao` int(11) NOT NULL,
  `paga` char(2) NOT NULL,
  `dt_vencimento` date NOT NULL,
  `vlr_fatura` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `faturas`
--

INSERT INTO `faturas` (`id_fatura`, `id_cartao`, `paga`, `dt_vencimento`, `vlr_fatura`) VALUES
(1, 1, 'N', '2019-01-10', 456.51),
(2, 1, 'N', '2019-02-10', 15.29),
(3, 1, 'N', '2019-03-10', 15.29),
(4, 1, 'N', '2019-04-10', 15.29),
(5, 1, 'N', '2019-05-10', 15.29),
(6, 1, 'N', '2019-06-10', 15.29),
(7, 1, 'N', '2019-07-10', 15.29),
(8, 1, 'N', '2019-08-10', 15.29),
(9, 1, 'N', '2019-09-10', 0.00),
(10, 1, 'N', '2019-10-10', 0.00),
(11, 1, 'N', '2019-11-10', 0.00),
(12, 1, 'N', '2019-12-10', 0.00),
(13, 2, 'N', '2019-01-10', 0.00),
(14, 2, 'N', '2019-02-10', 0.00),
(15, 2, 'N', '2019-03-10', 0.00),
(16, 2, 'N', '2019-04-10', 0.00),
(17, 2, 'N', '2019-05-10', 0.00),
(18, 2, 'N', '2019-06-10', 0.00),
(19, 2, 'N', '2019-07-10', 0.00),
(20, 2, 'N', '2019-08-10', 0.00),
(21, 2, 'N', '2019-09-10', 0.00),
(22, 2, 'N', '2019-10-10', 0.00),
(23, 2, 'N', '2019-11-10', 0.00),
(24, 2, 'N', '2019-12-10', 0.00),
(25, 3, 'N', '2019-01-10', 0.00),
(26, 3, 'N', '2019-02-10', 0.00),
(27, 3, 'N', '2019-03-10', 0.00),
(28, 3, 'N', '2019-04-10', 0.00),
(29, 3, 'N', '2019-05-10', 0.00),
(30, 3, 'N', '2019-06-10', 0.00),
(31, 3, 'N', '2019-07-10', 0.00),
(32, 3, 'N', '2019-08-10', 0.00),
(33, 3, 'N', '2019-09-10', 0.00),
(34, 3, 'N', '2019-10-10', 0.00),
(35, 3, 'N', '2019-11-10', 0.00),
(36, 3, 'N', '2019-12-10', 0.00),
(37, 4, 'N', '2019-01-10', 0.00),
(38, 4, 'N', '2019-02-10', 0.00),
(39, 4, 'N', '2019-03-10', 0.00),
(40, 4, 'N', '2019-04-10', 0.00),
(41, 4, 'N', '2019-05-10', 0.00),
(42, 4, 'N', '2019-06-10', 0.00),
(43, 4, 'N', '2019-07-10', 0.00),
(44, 4, 'N', '2019-08-10', 0.00),
(45, 4, 'N', '2019-09-10', 0.00),
(46, 4, 'N', '2019-10-10', 0.00),
(47, 4, 'N', '2019-11-10', 0.00),
(48, 4, 'N', '2019-12-10', 0.00),
(49, 5, 'N', '2019-01-10', 0.00),
(50, 5, 'N', '2019-02-10', 0.00),
(51, 5, 'N', '2019-03-10', 0.00),
(52, 5, 'N', '2019-04-10', 0.00),
(53, 5, 'N', '2019-05-10', 0.00),
(54, 5, 'N', '2019-06-10', 0.00),
(55, 5, 'N', '2019-07-10', 0.00),
(56, 5, 'N', '2019-08-10', 0.00),
(57, 5, 'N', '2019-09-10', 0.00),
(58, 5, 'N', '2019-10-10', 0.00),
(59, 5, 'N', '2019-11-10', 0.00),
(60, 5, 'N', '2019-12-10', 0.00);

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
  `observacao` longtext,
  `id_fatura_cartao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `transacoes`
--

INSERT INTO `transacoes` (`id_transacao`, `nome`, `valor`, `id_categoria`, `data_cadastro`, `data_efetivada`, `pago`, `id_conta`, `observacao`, `id_fatura_cartao`) VALUES
(1, 'Capinha celular 3/10', 15.29, 2, '2018-12-13', NULL, 'N', 1, '', 1),
(2, 'Capinha celular 4/10', 15.29, 2, '2018-12-13', NULL, 'N', 1, '', 2),
(3, 'Capinha celular 5/10', 15.29, 2, '2018-12-13', NULL, 'N', 1, '', 3),
(4, 'Capinha celular 6/10', 15.29, 2, '2018-12-13', NULL, 'N', 1, '', 4),
(5, 'Capinha celular 7/10', 15.29, 2, '2018-12-13', NULL, 'N', 1, '', 5),
(6, 'Capinha celular 8/10', 15.29, 2, '2018-12-13', NULL, 'N', 1, '', 6),
(7, 'Capinha celular 9/10', 15.29, 2, '2018-12-13', NULL, 'N', 1, '', 7),
(8, 'Capinha celular 10/10', 15.29, 2, '2018-12-13', NULL, 'N', 1, '', 8),
(9, 'Bretas', 37.78, 4, '2018-11-27', NULL, 'N', 1, '', 1),
(10, 'Iugu*Grupocompeti', 49.90, 1, '2018-11-27', NULL, 'N', 1, '', 1),
(11, 'Pilhas', 13.50, 1, '2018-12-01', NULL, 'N', 1, '', 1),
(12, 'folhas chamex', 19.50, 6, '2018-12-01', NULL, 'N', 1, '', 1),
(13, 'Lanterna Carro', 72.50, 16, '2018-12-03', NULL, 'N', 1, '', 1),
(14, 'Natura Mãe', 248.04, 8, '2018-12-03', NULL, 'N', 1, '', 1);

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
-- Indexes for table `faturas`
--
ALTER TABLE `faturas`
  ADD PRIMARY KEY (`id_fatura`),
  ADD KEY `fk_fatura_cartao` (`id_cartao`);

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
  ADD KEY `fk_transacoes_faturas` (`id_fatura_cartao`),
  ADD KEY `fk_transacoes_categorias` (`id_categoria`);

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
  MODIFY `id_cartao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `faturas`
--
ALTER TABLE `faturas`
  MODIFY `id_fatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

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
  MODIFY `id_transacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- Limitadores para a tabela `faturas`
--
ALTER TABLE `faturas`
  ADD CONSTRAINT `fk_fatura_cartao` FOREIGN KEY (`id_cartao`) REFERENCES `cartoes` (`id_cartao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_transacoes_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transacoes_faturas` FOREIGN KEY (`id_fatura_cartao`) REFERENCES `faturas` (`id_fatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
