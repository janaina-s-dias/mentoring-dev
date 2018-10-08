-- MySQL Script generated by MySQL Workbench
-- Mon Sep 24 23:07:23 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Mentoring
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Mentoring
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Mentoring` DEFAULT CHARACTER SET utf8 ;
USE `Mentoring` ;

-- -----------------------------------------------------
-- Table `Mentoring`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Mentoring`.`users` (
  `users_id` INT NOT NULL AUTO_INCREMENT,
  `users_login` VARCHAR(45) NOT NULL,
  `users_hash` VARCHAR(45) NOT NULL,
  `users_nivel` INT NOT NULL,
  `users_cpf` VARCHAR(10) NOT NULL,
  `users_nome` VARCHAR(45) NOT NULL,
  `users_rg` VARCHAR(10) NOT NULL,
  `users_email` VARCHAR(30) NOT NULL,
  `users_telefone` VARCHAR(10) NULL,
  `users_celular` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`users_id`),
  UNIQUE INDEX `users_cpf_UNIQUE` (`users_cpf` ASC),
  UNIQUE INDEX `users_rg_UNIQUE` (`users_rg` ASC),
  UNIQUE INDEX `users_email_UNIQUE` (`users_email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Mentoring`.`profession`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Mentoring`.`profession` (
  `profession_id` INT NOT NULL AUTO_INCREMENT,
  `profession_descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`profession_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Mentoring`.`area`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Mentoring`.`area` (
  `area_id` INT NOT NULL AUTO_INCREMENT,
  `area_descricao` VARCHAR(30) NOT NULL,
  `fk_area_profession` INT NULL,
  PRIMARY KEY (`area_id`),
  INDEX `fk_profession_id_idx` (`fk_area_profession` ASC),
  CONSTRAINT `fk_profession_id`
    FOREIGN KEY (`fk_area_profession`)
    REFERENCES `Mentoring`.`profession` (`profession_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Mentoring`.`carrer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Mentoring`.`carrer` (
  `carrer_id` INT NOT NULL AUTO_INCREMENT,
  `carrer_descricao` VARCHAR(45) NOT NULL,
  `fk_carrer_area` INT NULL,
  PRIMARY KEY (`carrer_id`),
  INDEX `fk_carrer_area_idx` (`fk_carrer_area` ASC),
  CONSTRAINT `fk_carrer_area`
    FOREIGN KEY (`fk_carrer_area`)
    REFERENCES `Mentoring`.`area` (`area_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Mentoring`.`subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Mentoring`.`subject` (
  `subject_id` INT NOT NULL AUTO_INCREMENT,
  `subject_descricao` VARCHAR(45) NOT NULL,
  `fk_carrer_id` INT NULL,
  PRIMARY KEY (`subject_id`),
  INDEX `fk_carrer_id_idx` (`fk_carrer_id` ASC),
  CONSTRAINT `fk_carrer_id`
    FOREIGN KEY (`fk_carrer_id`)
    REFERENCES `Mentoring`.`carrer` (`carrer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Mentoring`.`content`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Mentoring`.`content` (
  `content_tipo` VARCHAR(15) NOT NULL,
  `content_descricao` TEXT(100) NOT NULL,
  `fk_content_users_id` INT NULL,
  `fk_subject_id` INT NULL,
  INDEX `conteudo_users_id_idx` (`fk_content_users_id` ASC),
  INDEX `fk_subject_id_idx` (`fk_subject_id` ASC),
  CONSTRAINT `conteudo_users_id`
    FOREIGN KEY (`fk_content_users_id`)
    REFERENCES `Mentoring`.`users` (`users_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subject_id`
    FOREIGN KEY (`fk_subject_id`)
    REFERENCES `Mentoring`.`subject` (`subject_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Mentoring`.`conection`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Mentoring`.`conection` (
  `conection_inicio` TIMESTAMP(10) NULL,
  `conection_fim` TIMESTAMP(10) NULL,
  `conection_mentor` INT NULL,
  `conection_torado` INT NULL,
  `fk_subject_id` INT NULL,
  `fk_users_id` INT NULL,
  PRIMARY KEY (`conection_inicio`),
  INDEX `fk_subject_id_idx` (`fk_subject_id` ASC),
  INDEX `fk_users_id_idx` (`fk_users_id` ASC),
  CONSTRAINT `fk_subject_id`
    FOREIGN KEY (`fk_subject_id`)
    REFERENCES `Mentoring`.`subject` (`subject_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_id`
    FOREIGN KEY (`fk_users_id`)
    REFERENCES `Mentoring`.`users` (`users_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Mentoring`.`knowledge`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Mentoring`.`knowledge` (
  `fk_users_id` INT NULL,
  `fk_subject_id` INT NULL,
  `knowledge_rank` INT NULL,
  `knowledge_level` INT NULL,
  INDEX `fk_users_id_idx` (`fk_users_id` ASC),
  INDEX `fk_subject_id_idx` (`fk_subject_id` ASC),
  CONSTRAINT `fk_users_id`
    FOREIGN KEY (`fk_users_id`)
    REFERENCES `Mentoring`.`users` (`users_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subject_id`
    FOREIGN KEY (`fk_subject_id`)
    REFERENCES `Mentoring`.`subject` (`subject_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
