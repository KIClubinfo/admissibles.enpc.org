<?php
session_start();
//---------NOT FOR PROD---------//
error_reporting(E_ALL);
ini_set('display_errors', 'On');
//---------NOT FOR PROD---------//
$db_password = $_ENV["mysql_password"];
$con = new mysqli('db', 'admissibles_user', $db_password, 'admissibles');
if ($con->connect_error) {
    header('Location: connexion.php?erreur=bdderror');
	exit();
}

function is_admin()
{ // renvoie true si l'user est un admin
    if (isset($_SESSION['loggedin'])) {
        if ($_SESSION['admin']==1) {
            return True;
        }
    }
    return False;
}

$debut_inscription=new DateTime('2021-06-16 12:00:00');//à modifier

function protect($dateprotection) {
    $date = new DateTime(null, new DateTimeZone('Europe/Paris'));
    if ($date<$dateprotection and !is_admin()) {
        return True;
    }
    else{
        return False;
    }
}
?>