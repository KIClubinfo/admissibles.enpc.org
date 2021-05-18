CREATE TABLE IF NOT EXISTS `admissibles`.`eleves` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `prenom` VARCHAR(100) NOT NULL ,
  `nom` VARCHAR(100) NOT NULL ,
  `password` VARCHAR(128) NOT NULL ,
  `mail` VARCHAR(255) NOT NULL ,
  `tel` VARCHAR(15) NOT NULL ,
  `admin` BOOLEAN  DEFAULT FALSE ,
  `a_reserve` BOOLEAN DEFAULT FALSE , PRIMARY KEY (`id`))
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `admissibles`.`chambre` (
  `numero` INT NOT NULL , 
  `type` INT NOT NULL , PRIMARY KEY (`numero`)) -- 1 simple, 2 binomee, 3 double
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `admissibles`.`reservation` (
  `id_res` INT NOT NULL AUTO_INCREMENT ,
  `id_eleves` INT NOT NULL ,
  `numero_chambre` INT NOT NULL ,
  `date_arrivee` DATETIME ,
  `date_depart` DATETIME , PRIMARY KEY (`id_res`))
  ENGINE = InnoDB;

  INSERT INTO `admissibles`.`eleves` (`id`, `prenom`, `nom`, `password`, `mail`, `tel`, `admin` , `a_reserve`) 
  VALUES ('1', 'admin', 'admin', '', 'admin@admissibles.enpc.org', '00000000', '1', '0');