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
INSERT INTO bolo (idBolo, nome, votos, sabor, descricao, imagem)
VALUES
(1, 'Bolo de Chocolate', 0, 'Chocolate', 'Um bolo rico e fofinho, com cobertura de chocolate cremoso, perfeito para os chocólatras.', 'uploads/bolo-de-chocolate.jpg'),
(2, 'Bolo de Morango', 0, 'Morango', 'Delicado e doce, feito com massa macia e coberto com um creme suave de morango.', 'uploads/bolo-de-morango.jpg'),
(3, 'Bolo de Terra', 0, 'Terra', 'Perfeito e barato, ofereça à um amigo com imaginação fértil. Podendo também ser usado para o aniversário de sua minhoca de estimação.', 'uploads/bolo-terra.jpg'),
(4, 'Bolo de Coco', 0, 'Coco', 'Macio e úmido, coberto com flocos de coco para um sabor tropical.', 'uploads/bolo-coco.jpg'),
(5, 'Bolo de Abacaxi', 0, 'Abacaxi', 'Um bolo invertido com pedaços caramelizados de abacaxi, perfeito para um toque tropical.', 'uploads/bolo-abacaxi.jpg'),
(6, 'Bolo de Cenoura', 0, 'Cenoura', 'Um clássico brasileiro, com massa macia e cobertura irresistível de chocolate.', 'uploads/bolo-cenoura.jpg'),
(7, 'Bolo Evangélicos', 0, 'Shinji', 'Um bolo perfeito para cerimônias cristãs, com uma massa macia e cobertura de chocolate branco cremoso.', 'uploads/bolo-shinji.webp'),
(8, 'Bolo Evangélico', 0, 'Creme', 'Agora sim, um bolo perfeito para cerimônias cristãs, com uma massa macia e cobertura de chantily cremoso.', 'uploads/bolo-evangelico.jpg'),
(9, 'Bolo Red Velvet', 0, 'Baunilha e Cacau', 'Elegante e delicioso, com sabor suave e cobertura de cream cheese.', 'uploads/bolo-red-velvet.jpg'),
(10, 'Bolo Floresta Negra', 0, 'Chocolate e Cereja', 'Uma explosão de chocolate com recheio de chantilly e cerejas.', 'uploads/bolo-floresta-negra.jpg'),
(11, 'Yellow Cake', 0, 'Urânio', 'Inspirado na ciência, com um sabor único para aqueles que adoram curiosidades.', 'uploads/yellow-cake.webp'),
(12, 'Bolo de Maracujá', 0, 'Maracujá', 'Doce e azedinho na medida certa, com cobertura de calda de maracujá.', 'uploads/bolo-maracuja.jpg'),
(13, 'Bolo de Amêndoas', 0, 'Amêndoas', 'Rico e sofisticado, com textura leve e sabor marcante.', 'uploads/bolo-amendoa.jpg'),
(14, 'Bolo de Fubá', 0, 'Fubá', 'Um toque nostálgico, perfeito com café, macio e aromático.', 'uploads/bolo-fuba.jpg'),
(15, 'Januário', 0, 'Januário', 'Não era um bolo de fubá senhora, era o Januário 😭', 'uploads/bolo-gato.jpg'),
(16, 'Bolo Churros', 0, 'Canela e Doce de Leite', 'Bolo de churros desconstruído, também conhecido como churros.', 'uploads/bolo-churros.jpg'),
(17, 'Bolo do Vasco', 0, 'Vascão', 'Uma homenagem ao Vascão, com sabores que celebram o time do coração.', 'uploads/bolo-vasco.jpg'),
(18, 'Bolo Arco-Íris', 0, 'Baunilha Colorida', 'Camadas coloridas que encantam os olhos e um sabor clássico que agrada a todos.', 'uploads/bolo-arco-iris.jpg'),
(19, 'Guilherme Boulos com um bolo', 0, 'Boulos', 'Boulos te oferece um bolo, aceitas?', 'uploads/boulos.jpg'),
(20, 'Guilherme Boulos? com um bolo', 0, 'Mauricio Meireles', 'Este não é o Boulos. Mauricio Meireles te oferece um bolo, aceitas?', 'uploads/bolo-mauricio.jpg');
COMMIT;
