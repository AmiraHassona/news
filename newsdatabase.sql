-- MySQL Script generated by MySQL Workbench
-- Thu Sep 30 16:53:22 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema news_site
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema news_site
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `news_site` DEFAULT CHARACTER SET utf8mb4 ;
USE `news_site` ;

-- -----------------------------------------------------
-- Table `news_site`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `news_site`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(225) NOT NULL,
  `email` VARCHAR(225) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `gender` BIT NULL DEFAULT 0,
  `role` ENUM('admin', 'editor', 'user') NULL DEFAULT 'user',
  `avtar` VARCHAR(225) NULL,
  `created_by` INT NULL,
  `created_at` TIMESTAMP NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)  ,
  INDEX `type_user_id_idx` (`created_by` ASC)  ,
  CONSTRAINT `fk_created_by`
    FOREIGN KEY (`created_by`)
    REFERENCES `news_site`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `news_site`.`posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `news_site`.`posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `post_title` VARCHAR(225) NULL,
  `post_body` TEXT(1000) NOT NULL,
  `image_post` VARCHAR(225) NULL,
  `created_at` TIMESTAMP NULL DEFAULT current_timestamp,
  `created_by` INT NOT NULL,
  `statues` ENUM('panding', 'approved', 'regicted') NULL DEFAULT 'panding',
  `action_by` INT  NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_posts_users1_idx` (`created_by` ASC)  ,
  INDEX `fk_posts_users2_idx` (`action_by` ASC)  ,
  CONSTRAINT `fk_posts_users1`
    FOREIGN KEY (`created_by`)
    REFERENCES `news_site`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_posts_users2`
    FOREIGN KEY (`action_by`)
    REFERENCES `news_site`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `news_site`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `news_site`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comment_body` VARCHAR(225) NULL,
  `created_at` TIMESTAMP NULL DEFAULT current_timestamp,
  `post_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comments_posts1_idx` (`post_id` ASC)  ,
  INDEX `fk_comments_users1_idx` (`user_id` ASC)  ,
  CONSTRAINT `fk_comments_posts1`
    FOREIGN KEY (`post_id`)
    REFERENCES `news_site`.`posts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `news_site`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;