<?php
session_start();

//---------NOT FOR PROD---------//
error_reporting(E_ALL);
ini_set('display_errors', 'On');
//---------NOT FOR PROD---------//


$db_password = $_ENV["mysql_password"];
$con = new mysqli('db', 'admissibles_user', $db_password, 'admissibles');
if ($con->connect_error) {
    die('Erreur lors de la connexion à la base de donnée: ' . $con->connect_error);
}

if ( !isset($_POST['email'], $_POST['password']) ) {
	exit('Merci de remplir l\'email et le mot de passe.');
}

if ($stmt = $con->prepare('SELECT id, password, activation_code FROM eleves WHERE mail = ?')) {
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
}

if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password, $code);
	$stmt->fetch();
	if (password_verify($_POST['password'], $password)) {
		if($code=='activated'){
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['id'] = $id;
        	header('Location: index.php');
		}
		else{
			header('Location: connexion.php?erreur=2');
		}
	} else {
		header('Location: connexion.php?erreur=1');
	}
} else {
	header('Location: connexion.php?erreur=1'); 
}
$stmt->close();
?>