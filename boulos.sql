-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/11/2024 às 12:32
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bolos`
--
-- --------------------------------------------------------
--
-- Estrutura para tabela `bolos`
--
CREATE
OR REPLACE DATABASE `bolos`;

USE `bolos`;

CREATE
OR REPLACE TABLE `bolo` (
  `nome` varchar(60) NOT NULL,
  `votos` int (11) NOT NULL,
  `sabor` int (11) NOT NULL,
  `descricao` text NOT NULL,
  `idBolo` int (11) NOT NULL,
  `imagem` text NOT NULL,
  PRIMARY KEY (`idBolo`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE
OR REPLACE TABLE `bolo_usuario` (
  `id` int (11) NOT NULL,
  `voto` tinyint (1) NOT NULL,
  `idUsuario` int (11) NOT NULL,
  `idBolo` int (11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idBolo` (`idBolo`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE
OR REPLACE TABLE `usuario` (
  `nome` varchar(60) NOT NULL,
  `idUsuario` int (11) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- AUTO_INCREMENT para tabelas despejadas
--
--
-- AUTO_INCREMENT de tabela `bolo`
--
ALTER TABLE `bolo` MODIFY `idBolo` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario` MODIFY `idUsuario` int (11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--
--
-- Restrições para tabelas `bolo_usuario`
--
ALTER TABLE `bolo_usuario` ADD CONSTRAINT `bolo_usuario_ibfk_1` FOREIGN KEY (`idBolo`) REFERENCES `bolo` (`idBolo`),
ADD CONSTRAINT `bolo_usuario_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Inserindo o gerente no banco
--
INSERT INTO
  `usuario` (`idUsuario`, `nome`, `email`, `senha`)
VALUES
  (
    1,
    'Administrador',
    'admin@tinder.com',
    '$2y$10$V7H2oyxLxDBCKtegSFx/S.DlG2CAQBMVpIFA2GcfoOsTVA5aQz0Dq'
  );

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;