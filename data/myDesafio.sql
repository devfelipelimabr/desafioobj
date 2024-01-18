-- Criação da tabela `cliente`
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) DEFAULT NULL,
  `observacao` VARCHAR(450) DEFAULT NULL,
  `cliente_telefone_id_cliente_telefone` INT NOT NULL,
  `data_cadastro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cliente`),
  KEY `fk_cliente_cliente_telefone_idx` (`cliente_telefone_id_cliente_telefone`),
  CONSTRAINT `fk_cliente_cliente_telefone` FOREIGN KEY (`cliente_telefone_id_cliente_telefone`) REFERENCES `cliente_telefone` (`id_cliente_telefone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Criação da tabela `cliente_telefone`
CREATE TABLE IF NOT EXISTS `cliente_telefone` (
  `id_cliente_telefone` INT NOT NULL,
  `telefone` VARCHAR(45) DEFAULT NULL,
  PRIMARY KEY (`id_cliente_telefone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
