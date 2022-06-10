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

INSERT INTO `admissibles`.`eleves` (`id`, `prenom`, `nom`, `gender`, `password`, `mail`, `tel`, `distance`, `boursier`, `admin` , `a_reserve`, `change_password`, `activation_code`)
VALUES ('1', 'admin', 'admin', '3', '$2y$10$5prxR9BDJwZXM1WMikJBX.j/G/h1zMf2bZTUJEdzUlpokEMrMnYrO', 'admin@enpc.org', '00000000', '0', '0', '1', '0', 'no', 'activated');
