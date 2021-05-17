CREATE TABLE IF NOT EXISTS `admissibles`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `prenom` VARCHAR(100) NOT NULL ,
  `nom` VARCHAR(100) NOT NULL ,
  `password` VARCHAR(128) NOT NULL ,
  `mail` VARCHAR(255) NOT NULL ,
  `mdp_a_changer` BOOLEAN NOT NULL ,
  `tel` VARCHAR(15) NOT NULL ,
  `admin` BOOLEAN  DEFAULT FALSE,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;

INSERT INTO `admissibles`.`users` (`id`, `prenom`, `nom`, `password`, `mail`, `mdp_a_changer`, `tel`, `admin`) VALUES ('1', 'admin', 'admin', '$2y$12$F6Q4LapmPtZw8RzpVuAhd.47PJ7KG2xQTUeRB/d3XCI7cjG9qW8OG', 'admin@admissibles.enpc.org', '1', '00000000','1');