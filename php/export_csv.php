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

    $serie = sanitize_string($_GET['serie']);

    // HTTP CSV HEADERS
    header("Content-Type: application/octet-stream");
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"serie_$serie.csv\"");

    // GET DATA FROM DATABASE
    if ($stmt = $con->prepare("SELECT id_res, numero_chambre, type, nom, prenom, gender, mail, tel, paid
                               FROM `reservation` 
                               JOIN eleves ON reservation.id_eleves=eleves.id
                               JOIN chambre ON reservation.numero_chambre=chambre.numero
                               JOIN serie ON reservation.date_arrivee=serie.arrival_date WHERE serie.id_serie = $serie;")) {
        $stmt->execute();
    }
    else {
        header('Location: connexion.php?erreur=querry_error');
        exit();
    }

    $stmt->bind_result($id_res, $numero, $type, $nom, $prenom, $gender, $mail, $tel, $paid);

    // DIRECT OUTPUT
    function fancy_gender($g) {
        if ($g == 1) {
            return "F";
        }
        elseif ($g == 2) {
            return "H";
        }
        else {
            return "Autre/Ne souhaite pas préciser";
        }
    }

    function fancy_typo($t) {
        if ($t == 1) {
            return "Simple";
        }
        elseif ($t == 2) {
            return "Binômée";
        }
        else {
            return "Double";
        }
    }

    function fancy_paid($paid){
        if ($paid == 1) {
            return "Oui";
        }
        else {
            return "Non";
        }
    }


    echo implode(",", ["N° logement", "Typologie", "Nom", "Prenom", "Mail", "Telephone", "Sexe", "Payé"]);
    echo "\r\n";
    while ($row = $stmt->fetch()) {
      echo implode(",", [$numero, fancy_typo($type), $nom, $prenom, $mail, $tel, fancy_gender($gender), fancy_paid($paid)]);
      echo "\r\n";
    }
?>


