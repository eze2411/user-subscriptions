-- -----------------------------------------------------
-- Table `alitaware`.`login`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `alitaware`.`logins` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `latitude` DECIMAL NULL,
  `longitude` DECIMAL NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_logins_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_logins_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `alitaware`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Cargar datos de prueba (login table)
-- -----------------------------------------------------

INSERT INTO logins (user_id, latitude, longitude) VALUES (
(SELECT id from users WHERE email = 'user11@mail.com'),
-40.658982,
-71.396414
);

INSERT INTO logins (user_id, latitude, longitude) VALUES (
(SELECT id from users WHERE email = 'user21@mail.com'),
-40.658982,
-71.396414
);

INSERT INTO logins (user_id, latitude, longitude) VALUES (
(SELECT id from users WHERE email = 'user12@mail.com'),
-37.011535,
-66.119168
);

INSERT INTO logins (user_id, latitude, longitude) VALUES (
(SELECT id from users WHERE email = 'user22@mail.com'),
-37.011535,
-66.119168
);


INSERT INTO logins (user_id, latitude, longitude) VALUES (
(SELECT id from users WHERE email = 'user13@mail.com'),
-26.083521,
-65.958911
);

INSERT INTO logins (user_id, latitude, longitude) VALUES (
(SELECT id from users WHERE email = 'user11@mail.com'),
-26.083521,
-65.958911
);

INSERT INTO logins (user_id, latitude, longitude) VALUES (
(SELECT id from users WHERE email = 'admin1@mail.com'),
-31.537263,
-60.888858
);

INSERT INTO logins (user_id, latitude, longitude) VALUES (
(SELECT id from users WHERE email = 'admin2@mail.com'),
-28.505187,
-57.846210
);

INSERT INTO logins (user_id, latitude, longitude) VALUES (
(SELECT id from users WHERE email = 'user23@mail.com'),
-40.658982,
-71.396414
);

INSERT INTO logins (user_id, latitude, longitude) VALUES (
(SELECT id from users WHERE email = 'user14@mail.com'),
-40.658982,
-71.396414
);
