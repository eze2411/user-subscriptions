SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema alitaware
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema alitaware
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `alitaware` DEFAULT CHARACTER SET utf8 ;
USE `alitaware` ;

-- -----------------------------------------------------
-- Table `alitaware`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `alitaware`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `alitaware`.`subscription`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `alitaware`.`subscription` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_subscription_user1_idx` (`user_id` ASC),
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC),
  CONSTRAINT `fk_subscription_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `alitaware`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `alitaware`.`team`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `alitaware`.`team` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `subscription_id` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_team_subscription1_idx` (`subscription_id` ASC),
  UNIQUE INDEX `subscription_id_UNIQUE` (`subscription_id` ASC),
  CONSTRAINT `fk_team_subscription1`
    FOREIGN KEY (`subscription_id`)
    REFERENCES `alitaware`.`subscription` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `alitaware`.`billing`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `alitaware`.`billing` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `subscription_id` INT NOT NULL,
  `period` DATE NOT NULL,
  `state` VARCHAR(255) NOT NULL,
  `amount` FLOAT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_billing_subscription_idx` (`subscription_id` ASC),
  UNIQUE INDEX `subscription_period_UNIQUE` (`subscription_id` ASC, `period` ASC),
  CONSTRAINT `fk_billing_subscription`
    FOREIGN KEY (`subscription_id`)
    REFERENCES `alitaware`.`subscription` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `alitaware`.`user_team`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `alitaware`.`user_team` (
  `user_id` INT NOT NULL,
  `team_id` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL NOT NULL,
  INDEX `fk_user_has_team_team1_idx` (`team_id` ASC),
  INDEX `fk_user_has_team_user1_idx` (`user_id` ASC),
  UNIQUE INDEX `user_team_UNIQUE` (`user_id` ASC, `team_id` ASC),
  CONSTRAINT `fk_user_has_team_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `alitaware`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_team_team1`
    FOREIGN KEY (`team_id`)
    REFERENCES `alitaware`.`team` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- -----------------------------------------------------
-- Cargar datos de prueba (user table)
-- -----------------------------------------------------

INSERT INTO user (email, password) VALUES ('admin1@mail.com', 'password');
INSERT INTO user (email, password) VALUES ('user11@mail.com', 'password');
INSERT INTO user (email, password) VALUES ('user12@mail.com', 'password');
INSERT INTO user (email, password) VALUES ('user13@mail.com', 'password');
INSERT INTO user (email, password) VALUES ('user14@mail.com', 'password');
INSERT INTO user (email, password) VALUES ('user15@mail.com', 'password');
INSERT INTO user (email, password) VALUES ('user16@mail.com', 'password');
INSERT INTO user (email, password) VALUES ('user17@mail.com', 'password');
INSERT INTO user (email, password) VALUES ('user18@mail.com', 'password');
INSERT INTO user (email, password) VALUES ('user19@mail.com', 'password');
INSERT INTO user (email, password) VALUES ('user110@mail.com', 'password');
INSERT INTO user (email, password) VALUES ('admin2@mail.com', 'password');
INSERT INTO user (email, password) VALUES ('user21@mail.com', 'password');
INSERT INTO user (email, password) VALUES ('user22@mail.com', 'password');
INSERT INTO user (email, password) VALUES ('user23@mail.com', 'password');
INSERT INTO user (email, password) VALUES ('user24@mail.com', 'password');

-- -----------------------------------------------------
-- Cargar datos de prueba (subscription table)
-- -----------------------------------------------------

INSERT INTO subscription (user_id) VALUES ((select id from user where email = 'admin1@mail.com'));
INSERT INTO subscription (user_id) VALUES ((select id from user where email = 'admin2@mail.com'));

-- -----------------------------------------------------
-- Cargar datos de prueba (team table)
-- -----------------------------------------------------

INSERT INTO team (subscription_id) VALUES ((select id from subscription where user_id = (select id from user where email = 'admin1@mail.com')));
INSERT INTO team (subscription_id) VALUES ((select id from subscription where user_id = (select id from user where email = 'admin2@mail.com')));

-- -----------------------------------------------------
-- Cargar datos de prueba (user_team table)
-- -----------------------------------------------------

INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'admin1@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin1@mail.com')))
);

INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'admin2@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin2@mail.com')))
);

INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'user11@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin1@mail.com')))
);

INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'user12@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin1@mail.com')))
);

INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'user13@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin1@mail.com')))
);

INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'user21@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin2@mail.com')))
);

INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'user22@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin2@mail.com')))
);

INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'user23@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin2@mail.com')))
);
INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'user14@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin1@mail.com')))
);

INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'user15@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin1@mail.com')))
);
INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'user16@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin1@mail.com')))
);
INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'user17@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin1@mail.com')))
);
INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'user18@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin1@mail.com')))
);
INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'user19@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin1@mail.com')))
);
INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'user110@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin1@mail.com')))
);
INSERT INTO user_team (user_id, team_id) VALUES (
(select id from user where email = 'user24@mail.com'),
(select id from team where subscription_id = (select id from subscription where user_id = (select id from user where email = 'admin2@mail.com')))
);

-- -----------------------------------------------------
-- Cargar datos de prueba (billing table)
-- -----------------------------------------------------

INSERT INTO billing (subscription_id, period, state, amount) VALUES (
(select id from subscription where user_id = (select id from user where email = 'admin1@mail.com')),
'2020-10-01', 'paid', 150);

INSERT INTO billing (subscription_id, period, state, amount) VALUES (
(select id from subscription where user_id = (select id from user where email = 'admin1@mail.com')),
'2020-11-01', 'pending', 150);

INSERT INTO billing (subscription_id, period, state, amount) VALUES (
(select id from subscription where user_id = (select id from user where email = 'admin1@mail.com')),
'2020-09-01', 'paid', 495);

INSERT INTO billing (subscription_id, period, state, amount) VALUES (
(select id from subscription where user_id = (select id from user where email = 'admin2@mail.com')),
'2020-10-01', 'paid', 150);

INSERT INTO billing (subscription_id, period, state, amount) VALUES (
(select id from subscription where user_id = (select id from user where email = 'admin2@mail.com')),
'2020-11-01', 'paid', 150);

INSERT INTO billing (subscription_id, period, state, amount) VALUES (
(select id from subscription where user_id = (select id from user where email = 'admin2@mail.com')),
'2020-09-01', 'paid', 250);
