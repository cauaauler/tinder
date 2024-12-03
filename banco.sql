-- phpMyAdmin SQL Dump - Revisado
-- Banco de Dados: `bolos`

-- Remover o banco de dados se já existir e recriar
DROP DATABASE IF EXISTS `bolos`;
CREATE DATABASE `bolos`;
USE `bolos`;

-- Estrutura para tabela `bolo`
CREATE TABLE `bolo` (
  `idBolo` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(60) NOT NULL,
  `votos` INT(11) NOT NULL DEFAULT 0,
  `sabor` VARCHAR(30) NOT NULL,
  `descricao` TEXT NOT NULL,
  `imagem` TEXT NOT NULL,
  PRIMARY KEY (`idBolo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estrutura para tabela `usuario`
CREATE TABLE `usuario` (
  `idUsuario` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(60) NOT NULL,
  `email` VARCHAR(60) NOT NULL,
  `senha` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estrutura para tabela `bolo_usuario`
CREATE TABLE `bolo_usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `voto` TINYINT(1) NOT NULL,
  `idUsuario` INT(11) NOT NULL,
  `idBolo` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idBolo` (`idBolo`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `bolo_usuario_ibfk_1` FOREIGN KEY (`idBolo`) REFERENCES `bolo` (`idBolo`) ON DELETE CASCADE,
  CONSTRAINT `bolo_usuario_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserir usuário administrador
INSERT INTO `usuario` (`idUsuario`, `nome`, `email`, `senha`)
VALUES 
  (1, 'Administrador', 'admin@tinder.com', '$2y$10$V7H2oyxLxDBCKtegSFx/S.DlG2CAQBMVpIFA2GcfoOsTVA5aQz0Dq');

-- Inserir dados iniciais de bolos
INSERT INTO `bolo` (`nome`, `votos`, `sabor`, `descricao`, `imagem`)
VALUES 
  ('Bolo de Chocolate', 0, 'Chocolate', 'Bolo de chocolate com cobertura de chocolate', '/uploads/bolo-de-chocolate.jpg'),
  ('Bolo de Morango', 0, 'Morango', 'Bolo de morango com cobertura de morango', '/uploads/bolo-de-morango.jpg');
