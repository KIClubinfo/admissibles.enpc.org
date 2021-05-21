<?php

session_start();
if (isset($_SESSION['loggedin'])) {
    header('Location: profil.php');
    exit();
}

$db_password = $_ENV["mysql_password"];
$con = new mysqli('db', 'admissibles_user', $db_password, 'admissibles');
if ($con->connect_error) {
    header('Location: connexion.php?erreur=bdderror');
	exit();
}

if (isset($_GET['email'], $_GET['code'])) {
	if ($stmt = $con->prepare('SELECT * FROM eleves WHERE mail = ? AND activation_code = ?')) {
		$stmt->bind_param('ss', $_GET['email'], $_GET['code']);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			if ($stmt = $con->prepare('UPDATE eleves SET activation_code = ? WHERE mail = ? AND activation_code = ?')) {
				$newcode = 'activated';
				$stmt->bind_param('sss', $newcode, $_GET['email'], $_GET['code']);
				$stmt->execute();
				header('Location: connexion.php?info=activation');
	    		exit();
			}
		} else {
			header('Location: connexion.php?info=alreadyactive');
			exit();
		}
	}
}
?>