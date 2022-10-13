-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema fullstackproject
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema fullstackproject
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `id18733800_fullstackproject` DEFAULT CHARACTER SET latin1 ;
-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- Table `fullstackproject`.`account`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id18733800_fullstackproject`.`account` (
  `email` VARCHAR(45) NOT NULL,
  `nickname` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `picture` VARCHAR(45) NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fullstackproject`.`animes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id18733800_fullstackproject`.`animes` (
  `idanimes` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `genre` VARCHAR(45) NOT NULL,
  `afbeelding` VARCHAR(240) NOT NULL,
  PRIMARY KEY (`idanimes`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fullstackproject`.`account_has_animes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id18733800_fullstackproject`.`account_has_animes` (
  `account_email` VARCHAR(45) NOT NULL,
  `animes_idanimes` INT(11) NOT NULL,
  `bool` TINYINT NOT NULL,
  `rating` INT(1) NULL,
  PRIMARY KEY (`account_email`, `animes_idanimes`),
  INDEX `fk_account_has_animes_animes1_idx` (`animes_idanimes` ASC),
  INDEX `fk_account_has_animes_account_idx` (`account_email` ASC),
  CONSTRAINT `fk_account_has_animes_account`
    FOREIGN KEY (`account_email`)
    REFERENCES `id18733800_fullstackproject`.`account` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_account_has_animes_animes1`
    FOREIGN KEY (`animes_idanimes`)
    REFERENCES `id18733800_fullstackproject`.`animes` (`idanimes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fullstackproject`.`genres`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id18733800_fullstackproject`.`genres` (
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`name`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fullstackproject`.`animes_has_genres`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id18733800_fullstackproject`.`animes_has_genres` (
  `animes_idanimes` INT(11) NOT NULL,
  `genres_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`animes_idanimes`, `genres_name`),
  INDEX `fk_animes_has_genres_genres1_idx` (`genres_name` ASC),
  INDEX `fk_animes_has_genres_animes1_idx` (`animes_idanimes` ASC),
  CONSTRAINT `fk_animes_has_genres_animes1`
    FOREIGN KEY (`animes_idanimes`)
    REFERENCES `id18733800_fullstackproject`.`animes` (`idanimes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_animes_has_genres_genres1`
    FOREIGN KEY (`genres_name`)
    REFERENCES `id18733800_fullstackproject`.`genres` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
