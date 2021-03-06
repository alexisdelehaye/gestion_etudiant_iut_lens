-- MySQL Script generated by MySQL Workbench
-- Wed Oct  3 14:31:36 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Abscence`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Abscence` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Abscence` (
  `idAbscence` INT NOT NULL,
  `heures` INT NULL,
  `Etudiant_idEtudiant` INT NOT NULL,
  `UE_idUE` INT NOT NULL,
  PRIMARY KEY (`idAbscence`),
  INDEX `fk_Abscence_Etudiant1_idx` (`Etudiant_idEtudiant` ASC),
  INDEX `fk_Abscence_UE1_idx` (`UE_idUE` ASC),
  CONSTRAINT `fk_Abscence_Etudiant1`
    FOREIGN KEY (`Etudiant_idEtudiant`)
    REFERENCES `mydb`.`Etudiant` (`idEtudiant`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Abscence_UE1`
    FOREIGN KEY (`UE_idUE`)
    REFERENCES `mydb`.`UE` (`idUE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`DecisionSemestre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`DecisionSemestre` ;

CREATE TABLE IF NOT EXISTS `mydb`.`DecisionSemestre` (
  `idDecisionSemestre` INT NOT NULL,
  `decision` VARCHAR(45) NULL,
  `Etudiant_idEtudiant` INT NOT NULL,
  `Semestre_idSemestre` INT NOT NULL,
  PRIMARY KEY (`idDecisionSemestre`),
  INDEX `fk_DecisionSemestre_Etudiant1_idx` (`Etudiant_idEtudiant` ASC),
  INDEX `fk_DecisionSemestre_Semestre1_idx` (`Semestre_idSemestre` ASC),
  CONSTRAINT `fk_DecisionSemestre_Etudiant1`
    FOREIGN KEY (`Etudiant_idEtudiant`)
    REFERENCES `mydb`.`Etudiant` (`idEtudiant`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DecisionSemestre_Semestre1`
    FOREIGN KEY (`Semestre_idSemestre`)
    REFERENCES `mydb`.`Semestre` (`idSemestre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`DecisionUE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`DecisionUE` ;

CREATE TABLE IF NOT EXISTS `mydb`.`DecisionUE` (
  `idDecisionUE` INT NOT NULL,
  `decision` VARCHAR(45) NULL,
  `Etudiant_idEtudiant` INT NOT NULL,
  `UE_idUE` INT NOT NULL,
  PRIMARY KEY (`idDecisionUE`),
  INDEX `fk_DecisionUE_Etudiant1_idx` (`Etudiant_idEtudiant` ASC),
  INDEX `fk_DecisionUE_UE1_idx` (`UE_idUE` ASC),
  CONSTRAINT `fk_DecisionUE_Etudiant1`
    FOREIGN KEY (`Etudiant_idEtudiant`)
    REFERENCES `mydb`.`Etudiant` (`idEtudiant`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DecisionUE_UE1`
    FOREIGN KEY (`UE_idUE`)
    REFERENCES `mydb`.`UE` (`idUE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Diplome`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Diplome` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Diplome` (
  `idDiplome` INT NOT NULL,
  `nom` VARCHAR(45) NULL,
  `debut` DATE NULL,
  `fin` DATE NULL,
  `Etudiant_idEtudiant` INT NOT NULL,
  PRIMARY KEY (`idDiplome`),
  INDEX `fk_Diplome_Etudiant1_idx` (`Etudiant_idEtudiant` ASC),
  CONSTRAINT `fk_Diplome_Etudiant1`
    FOREIGN KEY (`Etudiant_idEtudiant`)
    REFERENCES `mydb`.`Etudiant` (`idEtudiant`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Etudiant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Etudiant` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Etudiant` (
  `idEtudiant` INT NOT NULL,
  `nom` VARCHAR(45) NOT NULL,
  `prenom` VARCHAR(45) NOT NULL,
  `numEtu` VARCHAR(45) NOT NULL,
  `groupe` VARCHAR(5) NULL,
  `Formation_idFormation` INT NOT NULL,
  PRIMARY KEY (`idEtudiant`),
  INDEX `fk_Etudiant_Formation1_idx` (`Formation_idFormation` ASC),
  CONSTRAINT `fk_Etudiant_Formation1`
    FOREIGN KEY (`Formation_idFormation`)
    REFERENCES `mydb`.`Formation` (`idFormation`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Formation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Formation` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Formation` (
  `idFormation` INT NOT NULL,
  `nom` VARCHAR(45) NULL,
  PRIMARY KEY (`idFormation`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Matiere`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Matiere` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Matiere` (
  `idMatiere` INT NOT NULL,
  `nom` VARCHAR(150) NULL,
  `ref` CHAR(5) NULL,
  `abreviation` VARCHAR(10) NULL,
  `coefficient` DECIMAL(2,1) NULL,
  `UE_idUE` INT NOT NULL,
  PRIMARY KEY (`idMatiere`),
  INDEX `fk_Matiere_UE1_idx` (`UE_idUE` ASC),
  CONSTRAINT `fk_Matiere_UE1`
    FOREIGN KEY (`UE_idUE`)
    REFERENCES `mydb`.`UE` (`idUE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Note`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Note` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Note` (
  `idNote` INT NOT NULL,
  `note` DECIMAL(4,2) NULL,
  `Etudiant_idEtudiant` INT NOT NULL,
  `Matiere_idMatiere` INT NOT NULL,
  PRIMARY KEY (`idNote`),
  INDEX `fk_Note_Etudiant_idx` (`Etudiant_idEtudiant` ASC),
  INDEX `fk_Note_Matiere1_idx` (`Matiere_idMatiere` ASC),
  CONSTRAINT `fk_Note_Etudiant`
    FOREIGN KEY (`Etudiant_idEtudiant`)
    REFERENCES `mydb`.`Etudiant` (`idEtudiant`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Note_Matiere1`
    FOREIGN KEY (`Matiere_idMatiere`)
    REFERENCES `mydb`.`Matiere` (`idMatiere`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Photo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Photo` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Photo` (
  `idPhoto` INT NOT NULL,
  `chemin` VARCHAR(45) NULL,
  `image` BLOB NULL,
  `Etudiant_idEtudiant` INT NOT NULL,
  PRIMARY KEY (`idPhoto`),
  INDEX `fk_Photo_Etudiant1_idx` (`Etudiant_idEtudiant` ASC),
  CONSTRAINT `fk_Photo_Etudiant1`
    FOREIGN KEY (`Etudiant_idEtudiant`)
    REFERENCES `mydb`.`Etudiant` (`idEtudiant`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Semestre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Semestre` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Semestre` (
  `idSemestre` INT NOT NULL,
  `nom` VARCHAR(45) NULL,
  `debut` DATE NULL,
  `fin` DATE NULL,
  `Formation_idFormation` INT NOT NULL,
  PRIMARY KEY (`idSemestre`),
  INDEX `fk_Semestre_Formation1_idx` (`Formation_idFormation` ASC),
  CONSTRAINT `fk_Semestre_Formation1`
    FOREIGN KEY (`Formation_idFormation`)
    REFERENCES `mydb`.`Formation` (`idFormation`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`UE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`UE` ;

CREATE TABLE IF NOT EXISTS `mydb`.`UE` (
  `idUE` INT NOT NULL,
  `nomUE` VARCHAR(45) NULL,
  `debut` DATE NULL,
  `fin` DATE NULL,
  `Semestre_idSemestre` INT NOT NULL,
  PRIMARY KEY (`idUE`),
  INDEX `fk_UE_Semestre1_idx` (`Semestre_idSemestre` ASC),
  CONSTRAINT `fk_UE_Semestre1`
    FOREIGN KEY (`Semestre_idSemestre`)
    REFERENCES `mydb`.`Semestre` (`idSemestre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
