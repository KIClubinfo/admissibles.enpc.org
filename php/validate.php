<?php
include("config.php");
if (isset($_SESSION['loggedin'])) {
    header('Location: profil.php');
    exit();
}

include("mailer.php");

if (!isset($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['tel'], $_POST['distance'], $_POST['boursier'], $_POST['password'], $_POST['confpassword'])) {
	header('Location: inscription.php?erreur=form');
	exit();
}
if (empty($_POST['prenom']) || empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['tel']) || empty($_POST['distance']) || empty($_POST['password']) || empty($_POST['confpassword'])){
	header('Location: inscription.php?erreur=form');
	exit();
}
if ($_POST['password']!=$_POST['confpassword']){
    header('Location: inscription.php?erreur=password');
	exit();
}
if (preg_match("/^([a-zA-Z'àáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+)$/", $_POST['prenom']) == 0) {
    header('Location: inscription.php?erreur=prenom');
	exit();
}
if (preg_match("/^([a-zA-Z'àáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+)$/", $_POST['nom']) == 0) {
    header('Location: inscription.php?erreur=nom');
	exit();
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	header('Location: inscription.php?erreur=mail');
	exit();
}
if (preg_match("/^(?:(?:\+|00)33|0)[1-9](\d{8})$/", $_POST['tel']) == 0) {
    header('Location: inscription.php?erreur=phone');
	exit();
}
if (!is_numeric($_POST['distance']) || $_POST['distance'] < 0) {
	header('Location: inscription.php?erreur=distance');
	exit();
}
if ($_POST['boursier'] != 0 && $_POST['boursier'] != 1) {
	header('Location: inscription.php?erreur=boursier');
	exit();
}

$safemail=sanitize_string($_POST['email']);

if ($stmt = $con->prepare('SELECT id, password FROM eleves WHERE mail = ?')) {
	$stmt->bind_param('s', $safemail);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		header('Location: inscription.php?erreur=mailexist');
		exit();
	} else {
		$safepass=sanitize_string($_POST['password']);
		$safeprenom=sanitize_string($_POST['prenom']);
		$safenom=sanitize_string($_POST['nom']);
		$safegender=sanitize_string($_POST['gender']);
		$safetel=sanitize_string($_POST['tel']);
		$safedistance=sanitize_string($_POST['distance']);
		$safeboursier=sanitize_string($_POST['boursier']);

		$stmt = $con->prepare('INSERT INTO eleves (prenom, nom, gender, password, mail, tel, distance, boursier, admin, activation_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, ?)');
        $password = password_hash($safepass, PASSWORD_DEFAULT);
		$uniqid = uniqid();
	    $stmt->bind_param('ssisssdis', $safeprenom, $safenom, $safegender, $password, $safemail, $safetel, $safedistance, $safeboursier, $uniqid);
	    $stmt->execute();

		send_mail($_POST['email'], $uniqid,0);
		header('Location: connexion.php?info=mailinscription');
	    exit();
	    //echo 'Un email vous a été envoyé. Merci de vérifier vos emails pour activer votre compte.';

		//******Only while there is no mailer******//
		//header('Location: temp.php?email='.$safemail.'&code='.$uniqid.'');
	    //exit();
		//*****************************************//
	}
	$stmt->close();
}
else {
	header('Location: connexion.php?erreur=querry_error');
    exit();
} 

$con->close();
?>