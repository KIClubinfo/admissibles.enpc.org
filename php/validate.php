<?php

//---------NOT FOR PROD---------//
error_reporting(E_ALL);
ini_set('display_errors', 'On');
//---------NOT FOR PROD---------//

//include("mailer.php");

$db_password = $_ENV["mysql_password"];
$con = new mysqli('db', 'admissibles_user', $db_password, 'admissibles');
if ($con->connect_error) {
    die('Erreur lors de la connexion à la base de donnée: ' . $con->connect_error);
}

if (!isset($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['tel'], $_POST['password'], $_POST['confpassword'])) {
	exit('Merci de compléter le formulaire d\'inscription.');
}
if (empty($_POST['prenom']) || empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['tel']) || empty($_POST['password']) || empty($_POST['confpassword'])){
	exit('Merci de compléter le formulaire d\'inscription.');
}
if ($_POST['password']!=$_POST['confpassword']){
    exit('Les mots de passe ne correspondent pas.');
}
if (preg_match("/^([a-zA-Z'àáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+)$/", $_POST['prenom']) == 0) {
    exit('Prénom incorrect.');
}
if (preg_match("/^([a-zA-Z'àáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+)$/", $_POST['nom']) == 0) {
    exit('Nom incorrect.');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('Adresse email incorrecte.');
}
if (preg_match("/^(?:(?:\+|00)33|0)[1-9](\d{8})$/", $_POST['tel']) == 0) {
    exit('Numéro de téléphone incorrect.');
}


if ($stmt = $con->prepare('SELECT id, password FROM eleves WHERE mail = ?')) {
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		echo 'Cet email est déjà utilisé.';
	} else {
		$stmt = $con->prepare('INSERT INTO eleves (prenom, nom, password, mail, tel, admin, activation_code) VALUES (?, ?, ?, ?, ?, 0, ?)');
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$uniqid = uniqid();
	    $stmt->bind_param('ssssss', $_POST['prenom'], $_POST['nom'], $password, $_POST['email'], $_POST['tel'], $uniqid);
	    $stmt->execute();

		//send_mail($_POST['email'], $uniqid, $_POST['prenom']);
	    //echo 'Un email vous a été envoyé. Merci de vérifier vos emails pour activer votre compte.';

		//******Only while there is no mailer******//
		header('Location: temp.php?email='.$_POST['email'].'&code='.$uniqid.'');
	    exit();
		//*****************************************//
	}
	$stmt->close();
}

$con->close();
?>