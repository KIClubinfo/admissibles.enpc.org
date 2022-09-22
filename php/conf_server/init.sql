CREATE TABLE IF NOT EXISTS `admissibles`.`eleves` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `prenom` VARCHAR(100) NOT NULL ,
  `nom` VARCHAR(100) NOT NULL ,
  `gender`INT NOT NULL ,
  `password` VARCHAR(255) NOT NULL ,
  `mail` VARCHAR(100) NOT NULL ,
  `tel` VARCHAR(15) NOT NULL ,
  `distance` FLOAT NOT NULL ,
  `boursier` BOOLEAN ,
  `admin` BOOLEAN  DEFAULT FALSE ,
  `a_reserve` BOOLEAN DEFAULT FALSE ,
  `change_password` VARCHAR(50) DEFAULT 'no',
  `activation_code` VARCHAR(50) DEFAULT '', PRIMARY KEY (`id`)) -- genre 1 femme, 2 homme, 3 autre ou ne precise pas
  ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `admissibles`.`chambre` (
  `numero` INT NOT NULL , 
  `type` INT NOT NULL , PRIMARY KEY (`numero`)) -- 1 simple, 2 binomee, 3 double
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `admissibles`.`reservation` (
  `id_res` INT NOT NULL AUTO_INCREMENT ,
  `id_eleves` INT NOT NULL ,
  `numero_chambre` INT NOT NULL ,
  `email_send` BOOLEAN NOT NULL DEFAULT FALSE,
  `date_arrivee` VARCHAR(15),
  `date_depart` VARCHAR(15), PRIMARY KEY (`id_res`))
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `admissibles`.`demande` (
  `id_demande` INT NOT NULL AUTO_INCREMENT ,
  `id_eleve` INT NOT NULL ,
  `type_chambre` INT NOT NULL ,
  `remplace` BOOLEAN ,
  `gender_choice` INT NOT NULL ,
  `arrival_date` VARCHAR(15) ,
  `arrival_time` VARCHAR(10) ,
  `departure_date` VARCHAR(15) ,
  `departure_time` VARCHAR(10) ,
  `mate` BOOLEAN ,
  `mate_email` VARCHAR(100) ,
  `validee` BOOLEAN DEFAULT FALSE, 
  `demand_time` INT NOT NULL, PRIMARY KEY (`id_demande`)) -- genre 2 homme, 1 femme, 3 autre ou ne precise pas
  ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `admissibles`.`serie`(
  `id_serie` INT NOT NULL ,
  `arrival_date` VARCHAR(15) , PRIMARY KEY (`id_serie`))
ENGINE = InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `admissibles`.`serie` (`id_serie`, `arrival_date`)
VALUES ('1', '2022-06-19');
INSERT INTO `admissibles`.`serie` (`id_serie`, `arrival_date`)
VALUES ('2', '2022-06-26');
INSERT INTO `admissibles`.`serie` (`id_serie`, `arrival_date`)
VALUES ('3', '2022-07-03');
INSERT INTO `admissibles`.`serie` (`id_serie`, `arrival_date`)
VALUES ('4', '2022-07-10');

INSERT INTO `admissibles`.`eleves` (`id`, `prenom`, `nom`, `gender`, `password`, `mail`, `tel`, `distance`, `boursier`, `admin` , `a_reserve`, `change_password`, `activation_code`)
VALUES ('1', 'admin', 'admin', '3', '$2y$10$ppuRHjYx.70aBjBV/5SfPeQCw1Jylop3JQUATbWGIpgsoZ34jSnT.', 'admin@enpc.org', '00000000', '0', '0', '1', '0', 'no', 'activated');
