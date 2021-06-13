<?php
$TABLE_CHAMBRE = "chambre";
$FIELD_NUMBER = "numero";
$FIELD_TYPE = "type";

$TABLE_DEMANDE = "demande";
$FIELD_DEMANDE_ID = "id_demande";
$FIELD_DEMANDE_ELEVE_ID = "id_eleve";
$FIELD_CHAMBRE_TYPE = "type_chambre";
$FIELD_REMPLACE = "remplace";
$FIELD_GENDER_CHOICE = "gender_choice";
$FIELD_ARRIVAL_DATE = "arrival_date";
$FIELD_ARRIVAL_TIME = "arrival_time";
$FIELD_DEPARTURE_DATE = "departure_date";
$FIELD_DEPARTURE_TIME = "departure_time";
$FIELD_MATE = "mate";
$FIELD_MATE_EMAIL = "mate_email";
$FIELD_VALIDEE = "validee";

$TABLE_ELEVES = "eleves";
$FIELD_ID = "id";
$FIELD_PRENOM = "prenom";
$FIELD_NOM = "nom";
$FIELD_GENDER = "gender";
$FIELD_PASWORD = "password";
$FIELD_MAIL = "mail";
$FIELD_TEL = "tel";
$FIELD_DISTANCE = "distance";
$FIELD_BOURSIER = "boursier";
$FIELD_ADMIN = "admin";
$FIELD_A_RESERVE = "a_reserve";

$TABLE_RESERVATION = "reservation";
$FIELD_RESERVATION_ID = "id_res";
$FIELD_RESERVATION_ELEVES_ID = "id_eleves";
$FIELD_CHAMBRE_NUMBER = "numero_chambre";
$FIELD_DATE_ARRIVEE = "date_arrivee";
$FIELD_DATE_DEPART = "date_depart";


$SIMPLE = "0";
$DOUBLE = "1";
$BINOMEE = "2";
?>



<?php
include("config.php");
include("field_names.php");

$liste_demandes_loin = $con->query("SELECT * FROM eleves JOIN demande ON id = id_eleve WHERE distance > 75 ORDER BY "); //On récupère toutes les demandes triées selon Voisard
$liste_demandes_pres = $con->query("SELECT * FROM eleves JOIN demande ON id = id_eleve WHERE distance <= 75 ORDER BY boursier DESC, distance DESC"); //On récupère toutes les demandes triées selon Voisard
while($demande = $liste_demandes_loin->fetch_assoc()){   //On regarde 1 à 1 les demandes
    var_dump($demande);
    $condition_type = " type = ";
    //join pour les binomes
    $voeu1 = $con->query("SELECT * FROM chambre WHERE".$condition_type.$demande[$FIELD_CHAMBRE_TYPE]); //Chambres du bon type (prio)
    $voeu2 = $con->query("SELECT * FROM chambre WHERE NOT".$condition_type.$demande[$FIELD_CHAMBRE_TYPE]); //Autres chambres
    $cherche = true;
    while($room = $voeu1->fetch_assoc() and $cherche){ //Cycle sur les chambres du bon type -> stock dans $room
        $same_room = $FIELD_CHAMBRE_NUMBER." = ".$room[$FIELD_NUMBER];
        $same_moment = true;
        var_dump($room);
        $occupe = $con->query("SELECT * FROM reservation JOIN eleves ON id_eleves = id WHERE ".$same_room." AND ".$same_moment);  //Autres locations de cette chambre
        $binome1 = $occupe -> fetch_assoc(); //1ere réservation sur la période
        $binome2 = $occupe -> fetch_assoc(); //2eme reservation sur la période
        $simple_pleine = $occupe -> num_rows > 0 and $room[$FIELD_TYPE]==0; //simple remplie
        $deux_personnes = $binome2 != NULL;//deux personnes
        $incompatible_gender = $binome1[$FIELD_GENDER] == $demande[$FIELD_GENDER]; //Genre incompatible
        $chambre_valide = !($simple_pleine or $deux_personnes or $incompatible_gender);
        if($chambre_valide){ //Si pas de conflit
            $con -> query("INSERT INTO reservation (".$FIELD_RESERVATION_ELEVES_ID.",".$FIELD_CHAMBRE_NUMBER.",".$FIELD_DATE_DEPART.",".$FIELD_DATE_ARRIVEE.") 
            VALUES (".$demande[$FIELD_ID].",".$room[$FIELD_NUMBER].",".$demande[$FIELD_DATE_DEPART].",".$demande[$FIELD_DATE_ARRIVEE].")"); //On réserve la chambre
            $cherche = false;//reussi -> affecter
        }
    }
    while($room = $voeu2->fetch_assoc() and $cherche) { //Cycle sur les chambres du mauvais type -> stock dans $room
        $same_room = $FIELD_CHAMBRE_NUMBER." = ".$room[$FIELD_NUMBER];
        $same_moment = true;
        $occupe = $con->query("SELECT * FROM reservation JOIN eleves ON id_eleves = id WHERE ".$same_room." AND ".$same_moment);  //Autres locations de cette chambre
        $binome1 = $occupe -> fetch_assoc(); //1ere réservation sur la période
        $binome2 = $occupe -> fetch_assoc(); //2eme reservation sur la période
        $simple_pleine = $occupe -> num_rows > 0 and $room[$FIELD_TYPE]==0; //simple remplie
        $deux_personnes = $binome2 != NULL;//deux personnes
        $incompatible_gender = $binome1[$FIELD_GENDER] == $demande[$FIELD_GENDER]; //Genre incompatible
        $chambre_valide = !($simple_pleine or $deux_personnes or $incompatible_gender);
        if($chambre_valide){ //Si pas de conflit
            $con -> query("INSERT INTO reservation (".$FIELD_RESERVATION_ELEVES_ID.",".$FIELD_CHAMBRE_NUMBER.",".$FIELD_DATE_DEPART.",".$FIELD_DATE_ARRIVEE.") 
            VALUES (".$demande[$FIELD_ID].",".$room[$FIELD_NUMBER].",".$demande[$FIELD_DATE_DEPART].",".$demande[$FIELD_DATE_ARRIVEE].")"); //On réserve la chambre
            $cherche = false;//reussi -> affecter
        }
    }
    if($cherche){ //si malgré tout on a pas trouvé
        $con -> query("UPDATE demande SET 'valide' = 3 WHERE 'id_demande' = ".$demande[$FIELD_DEMANDE_ID]); //On place sur liste d'attente
    }
}
?>

