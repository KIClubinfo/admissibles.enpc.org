CREATE TABLE IF NOT EXISTS `admissibles`.`eleves` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `prenom` VARCHAR(100) NOT NULL ,
  `nom` VARCHAR(100) NOT NULL ,
  `password` VARCHAR(128) NOT NULL ,
  `mail` VARCHAR(255) NOT NULL ,
  `admin` BOOLEAN  DEFAULT FALSE ,
  `reservation` BOOLEAN DEFAULT FALSE ,
  `tel` VARCHAR(15) NOT NULL , PRIMARY KEY (`id`))
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `admissibles`.`chambre` (
  `numero` INT NOT NULL , 
  `type` INT NOT NULL , PRIMARY KEY (`numero`)) -- 1 simple, 2 binomee, 3 double
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `admissibles`.`reservation` (
  `id_eleves` INT NOT NULL ,
  `numero_chambre` INT NOT NULL ,
  `date_arrivee` INT NOT NULL ,
  `date_depart` INT NOT NULL , PRIMARY KEY (`numero`))
  ENGINE = InnoDB;

  INSERT INTO `admissibles`.`eleves` (`id`, `prenom`, `nom`, `password`, `mail`, `tel`, `admin`, `reservation`) VALUES ('1', 'admin', 'admin', '', 'admin@admissibles.enpc.org', '00000000','1', `TRUE'); --ajouter mot de passe