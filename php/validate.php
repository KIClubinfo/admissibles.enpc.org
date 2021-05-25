<?php
include("config.php");
if (isset($_SESSION['loggedin'])) {
    header('Location: profil.php');
    exit();
}

//include("mailer.php");

if (!isset($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['tel'], $_POST['password'], $_POST['confpassword'])) {
	header('Location: inscription.php?erreur=form');
	exit();
}
if (empty($_POST['prenom']) || empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['tel']) || empty($_POST['password']) || empty($_POST['confpassword'])){
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


if ($stmt = $con->prepare('SELECT id, password FROM eleves WHERE mail = ?')) {
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		header('Location: inscription.php?erreur=mailexist');
		exit();
	} else {
		$stmt = $con->prepare('INSERT INTO eleves (prenom, nom, gender, password, mail, tel, admin, activation_code) VALUES (?, ?, ?, ?, ?, ?, 0, ?)');
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$uniqid = uniqid();
	    $stmt->bind_param('ssissss', $_POST['prenom'], $_POST['nom'], $_POST['gender'], $password, $_POST['email'], $_POST['tel'], $uniqid);
	    $stmt->execute();

		//send_mail($_POST['email'], $uniqid,0);
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