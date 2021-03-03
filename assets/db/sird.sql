-- PROJECT





CREATE VIEW comando_municipal_informacao AS SELECT cm.data_criacao, cml.provincia, cml.municipio, cml.distrito, cml.bairro, cml.rua  FROM comando_municipal cm JOIN comando_municipal_localizacao cml ON cm.id_comando_municipal = cml.id_cm;
SELECT * FROM comando_municipal_informacao;

INSERT INTO comando_municipal VALUES(NULL, current_timestamp());
INSERT INTO comando_municipal_localizacao VALUES(1, "Luanda", "Talatona", "SIAC", "Belas", "4");

UPDATE comando_municipal_localizacao 
SET provincia = "Luanda", municipio = "Talatona", distrito = "SIAC", bairro = "Belas", rua = "5" WHERE id_cm = 1;
SELECT * FROM comando_municipal_informacao WHERE id_cm = 1;
























-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema sird-db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sird-db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sird-db` DEFAULT CHARACTER SET utf8 ;
USE `sird-db` ;

-- -----------------------------------------------------
-- Table `sird-db`.`comando_municipal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`comando_municipal` (
  `id_comando_municipal` TINYINT(5) NOT NULL AUTO_INCREMENT,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comando_municipal`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`posto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`posto` (
  `id_posto` MEDIUMINT(5) NOT NULL,
  `id_comando_municipal` TINYINT NOT NULL,
  `tipo` TINYINT(2) NOT NULL DEFAULT 1,
  `nome` VARCHAR(55) NOT NULL,
  `data_criacao` DATETIME NOT NULL,
  `estado_actividade` TINYINT(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_posto`),
  INDEX `id_comando_municipal_idx` (`id_comando_municipal` ASC),
  CONSTRAINT `id_comando_municipal-p`
    FOREIGN KEY (`id_comando_municipal`)
    REFERENCES `sird-db`.`comando_municipal` (`id_comando_municipal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`oficial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`oficial` (
  `id_oficial` INT(10) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `sobrenome` VARCHAR(100) NOT NULL,
  `foto_arquivo` VARCHAR(200) NOT NULL,
  `data_nasc` DATE NOT NULL,
  `oficial_info_id_oficial` INT(10) NOT NULL,
  `genero` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_oficial`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`oficial_conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`oficial_conta` (
  `id_oficial` INT NOT NULL,
  `nip` MEDIUMINT(7) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `estado_conta` TINYINT(2) NOT NULL DEFAULT 1,
  `data_cadastro` DATETIME NOT NULL,
  UNIQUE INDEX `nip_UNIQUE` (`nip` ASC),
  INDEX `id_oficial_idx` (`id_oficial` ASC),
  CONSTRAINT `id_oficial-oc`
    FOREIGN KEY (`id_oficial`)
    REFERENCES `sird-db`.`oficial` (`id_oficial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`oficial_posto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`oficial_posto` (
  `id_oficial` INT NOT NULL,
  `id_posto` MEDIUMINT NOT NULL,
  `cargo` TINYINT(2) NOT NULL DEFAULT 1,
  INDEX `id_oficial_idx` (`id_oficial` ASC),
  INDEX `id_posto_idx` (`id_posto` ASC),
  CONSTRAINT `id_oficial-op`
    FOREIGN KEY (`id_oficial`)
    REFERENCES `sird-db`.`oficial` (`id_oficial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_posto-op`
    FOREIGN KEY (`id_posto`)
    REFERENCES `sird-db`.`posto` (`id_posto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`permissao_edicao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`permissao_edicao` (
  `id_permissao` INT(10) NOT NULL,
  `id_oficial` INT NOT NULL,
  `campo_editado` VARCHAR(60) NOT NULL,
  `novo_valor` VARCHAR(200) NOT NULL,
  `estado` TINYINT(2) NULL DEFAULT 1,
  PRIMARY KEY (`id_permissao`),
  INDEX `id_oficial_idx` (`id_oficial` ASC),
  CONSTRAINT `id_oficial-pe`
    FOREIGN KEY (`id_oficial`)
    REFERENCES `sird-db`.`oficial` (`id_oficial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`propietario_documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`propietario_documento` (
  `id_proprietario` MEDIUMINT(8) NOT NULL,
  `nome_completo` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`id_proprietario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`proprietario_telefone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`proprietario_telefone` (
  `id_proprietario` MEDIUMINT NOT NULL,
  `telefone` MEDIUMINT(20) NOT NULL,
  INDEX `id_proprietario_idx` (`id_proprietario` ASC),
  CONSTRAINT `id_proprietario-pt`
    FOREIGN KEY (`id_proprietario`)
    REFERENCES `sird-db`.`propietario_documento` (`id_proprietario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`documentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`documentos` (
  `id_documento` INT(10) NOT NULL,
  `id_posto` MEDIUMINT NOT NULL,
  `tipo` VARCHAR(60) NOT NULL,
  `data_emissao` DATE NULL,
  `identifacador` VARCHAR(20) NULL,
  `id_proprietario` MEDIUMINT NOT NULL,
  `estado` TINYINT(2) NOT NULL,
  PRIMARY KEY (`id_documento`),
  INDEX `id_posto_idx` (`id_posto` ASC),
  INDEX `id_proprietario_idx` (`id_proprietario` ASC),
  CONSTRAINT `id_posto-d`
    FOREIGN KEY (`id_posto`)
    REFERENCES `sird-db`.`posto` (`id_posto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_proprietario-d`
    FOREIGN KEY (`id_proprietario`)
    REFERENCES `sird-db`.`propietario_documento` (`id_proprietario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`foto_documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`foto_documento` (
  `id_foto` MEDIUMINT(8) NOT NULL,
  `id_documento` INT NOT NULL,
  `arquivo` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_foto`),
  INDEX `id_documento_idx` (`id_documento` ASC),
  CONSTRAINT `id_documento-fd`
    FOREIGN KEY (`id_documento`)
    REFERENCES `sird-db`.`documentos` (`id_documento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`operacao_documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`operacao_documento` (
  `id_operacao` INT(10) NOT NULL,
  `id_documento` INT NOT NULL,
  `id_oficial` INT NOT NULL,
  `tipo` TINYINT(2) NOT NULL DEFAULT 1,
  `data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_operacao`),
  INDEX `id_documento_idx` (`id_documento` ASC),
  INDEX `id_oficial_idx` (`id_oficial` ASC),
  CONSTRAINT `id_documento-od`
    FOREIGN KEY (`id_documento`)
    REFERENCES `sird-db`.`documentos` (`id_documento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_oficial-od`
    FOREIGN KEY (`id_oficial`)
    REFERENCES `sird-db`.`oficial` (`id_oficial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`posto_localizacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`posto_localizacao` (
  `id_posto` MEDIUMINT NOT NULL,
  `distrito` VARCHAR(45) NOT NULL,
  `bairro` VARCHAR(50) NOT NULL,
  `rua` VARCHAR(40) NULL,
  INDEX `id_posto_idx` (`id_posto` ASC),
  CONSTRAINT `id_posto-pl`
    FOREIGN KEY (`id_posto`)
    REFERENCES `sird-db`.`posto` (`id_posto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`operacao_posto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`operacao_posto` (
  `id_operacao` MEDIUMINT(8) NOT NULL,
  `id_oficial` INT NOT NULL,
  `id_posto` MEDIUMINT NOT NULL,
  `tipo` TINYINT(2) NOT NULL,
  `data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_operacao`),
  INDEX `id_oficial_idx` (`id_oficial` ASC),
  INDEX `id_posto_idx` (`id_posto` ASC),
  CONSTRAINT `id_oficial-opt`
    FOREIGN KEY (`id_oficial`)
    REFERENCES `sird-db`.`oficial` (`id_oficial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_posto-opt`
    FOREIGN KEY (`id_posto`)
    REFERENCES `sird-db`.`posto` (`id_posto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`comando_municipal_localizacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`comando_municipal_localizacao` (
  `id_cm` TINYINT NOT NULL,
  `provincia` VARCHAR(65) NOT NULL,
  `municipio` VARCHAR(100) NOT NULL,
  `distrito` VARCHAR(100) NOT NULL,
  `bairro` VARCHAR(100) NOT NULL,
  `rua` VARCHAR(40) NULL,
  INDEX `id_cm_idx` (`id_cm` ASC),
  CONSTRAINT `id_cm-cml`
    FOREIGN KEY (`id_cm`)
    REFERENCES `sird-db`.`comando_municipal` (`id_comando_municipal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`oficial_comando_municipal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`oficial_comando_municipal` (
  `id_oficial` INT NOT NULL,
  `id_cm` TINYINT NOT NULL,
  `cargo` TINYINT(2) NOT NULL,
  INDEX `id_oficial_idx` (`id_oficial` ASC),
  INDEX `id_cm_idx` (`id_cm` ASC),
  CONSTRAINT `id_oficial-ocm`
    FOREIGN KEY (`id_oficial`)
    REFERENCES `sird-db`.`oficial` (`id_oficial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_cm-ocm`
    FOREIGN KEY (`id_cm`)
    REFERENCES `sird-db`.`comando_municipal` (`id_comando_municipal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
