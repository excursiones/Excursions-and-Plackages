
USE `mydb`;
-- -----------------------------------------------------
-- Table `mydb`.`Excursions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Excursions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `price` INT(11) NULL DEFAULT NULL,
  `location` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `photo_path` VARCHAR(45) NULL DEFAULT NULL,
  `duration` INT(11) NULL DEFAULT NULL,
  `state` TINYINT(4) NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 8 DEFAULT CHARACTER SET = utf8;
-- -----------------------------------------------------
-- Table `mydb`.`Packages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Packages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `price` INT(11) NULL DEFAULT NULL,
  `state` TINYINT(4) NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARACTER SET = utf8;
-- -----------------------------------------------------
-- Table `mydb`.`Excursions_packages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Excursions_packages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_excursions` INT(11) NULL DEFAULT NULL,
  `id_packages` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  INDEX `packages_idx` (`id_packages` ASC),
  INDEX `excursions_idx` USING BTREE (`id_excursions`),
  CONSTRAINT `excursions` FOREIGN KEY (`id_excursions`) REFERENCES `mydb`.`Excursions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `packages` FOREIGN KEY (`id_packages`) REFERENCES `mydb`.`Packages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 11 DEFAULT CHARACTER SET = utf8;
SET
  SQL_MODE = @OLD_SQL_MODE;
SET
  FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;
SET
  UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS;