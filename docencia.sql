-- MySQL Script generated by MySQL Workbench
-- Mon Sep 30 07:15:17 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema docencia_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema docencia_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `docencia_db` DEFAULT CHARACTER SET utf8 ;
USE `docencia_db` ;

-- -----------------------------------------------------
-- Table `docencia_db`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `docencia_db`.`user` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `nic` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NULL,
  `role` VARCHAR(45) NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE INDEX `nic_UNIQUE` (`nic` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `docencia_db`.`subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `docencia_db`.`subject` (
  `id_subject` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id_subject`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `docencia_db`.`activity`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `docencia_db`.`activity` (
  `id_activity` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(250) NULL,
  `date_created` DATETIME NULL,
  `deadline` DATETIME NULL,
  `user_id_professor` INT NOT NULL,
  `subject_id_subject` INT NOT NULL,
  PRIMARY KEY (`id_activity`),
  INDEX `fk_activity_user_idx` (`user_id_professor` ASC),
  INDEX `fk_activity_subject1_idx` (`subject_id_subject` ASC),
  CONSTRAINT `fk_activity_user`
    FOREIGN KEY (`user_id_professor`)
    REFERENCES `docencia_db`.`user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_subject1`
    FOREIGN KEY (`subject_id_subject`)
    REFERENCES `docencia_db`.`subject` (`id_subject`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `docencia_db`.`activity_done`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `docencia_db`.`activity_done` (
  `id_activity_done` INT NOT NULL,
  `score` INT NULL,
  `answer` VARCHAR(250) NULL,
  `user_id_user` INT NOT NULL,
  `activity_id_activity` INT NOT NULL,
  PRIMARY KEY (`id_activity_done`),
  INDEX `fk_activity_done_user1_idx` (`user_id_user` ASC),
  INDEX `fk_activity_done_activity1_idx` (`activity_id_activity` ASC),
  CONSTRAINT `fk_activity_done_user1`
    FOREIGN KEY (`user_id_user`)
    REFERENCES `docencia_db`.`user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_done_activity1`
    FOREIGN KEY (`activity_id_activity`)
    REFERENCES `docencia_db`.`activity` (`id_activity`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nic`, `password`, `role`) VALUES
(1, 'Jess', 'Jess', 'professor'),
(2, 'Anna', 'Anna', 'student'),
(3, 'Jack', 'Jack', 'student'),
(4, 'Robert', 'Robert', 'student'),
(5, 'Melyssa', 'Melyssa', 'student');


--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id_subject`, `name`) VALUES
(1, 'Math'),
(2, 'Geography'),
(3, 'Technology'),
(4, 'History');


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
