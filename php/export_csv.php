<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include("config.php");
    if (!isset($_SESSION['loggedin'])) {
	    header('Location: connexion.php?erreur=notconnected');
	    exit();
    } 
    if (!is_admin()){
        header('Location: profil.php?erreur=interdit');
        exit();
    }

    // HTTP CSV HEADERS
    header("Content-Type: application/octet-stream");
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"export.csv\"");
 
    // GET DATA FROM DATABASE
    if ($stmt = $con->prepare('SELECT id_res, numero_chambre, type, nom, prenom, gender  
                               FROM `reservation` 
                               JOIN eleves ON reservation.id_res=eleves.id
                               JOIN chambre ON reservation.numero_chambre=chambre.numero;')) {
        $stmt->execute();
    }
    else {
        header('Location: connexion.php?erreur=querry_error');
        exit();
    }

    $stmt->bind_result($id_res, $numero, $type, $nom, $prenom, $gender);

    // DIRECT OUTPUT
    echo implode(",", ["N° logement", "Typologie", "Nom", "Prenom", "Sexe"]);
    echo "\r\n";
    while ($row = $stmt->fetch()) {
      echo implode(",", [$numero, $type, $nom, $prenom, $gender]);
      echo "\r\n";
    }
?>


