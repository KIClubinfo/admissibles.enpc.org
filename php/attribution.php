<?php
include("config.php");

$db_password = $_ENV["mysql_password"];
$con = new mysqli('db', 'admissibles_user', $db_password, 'admissibles');
if ($con->connect_error) {
    header('Location: connexion.php?erreur=bdderror');
    exit();
}
$test = $con->query("SELECT * FROM eleves JOIN demande ON id = id_eleve ORDER BY boursier ASC, distance DESC");
var_dump($test);
?>

