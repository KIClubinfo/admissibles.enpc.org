<?php
include("config.php");
if (isset($_SESSION['loggedin'])) {
    header('Location: profil.php');
    exit();
}

if (isset($_GET['email'], $_GET['code'])) {

	$safemail=sanitize_string($_GET['email']);
	$safecode=sanitize_string($_GET['code']);
	
	if ($stmt = $con->prepare('SELECT * FROM eleves WHERE mail = ? AND activation_code = ?')) {
		$stmt->bind_param('ss', $safemail, $safecode);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			if ($stmt = $con->prepare('UPDATE eleves SET activation_code = ? WHERE mail = ? AND activation_code = ?')) {
				$newcode = 'activated';
				$stmt->bind_param('sss', $newcode, $safemail, $safecode);
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

else {
	header('Location: connexion.php?erreur=inconnue');
    exit();
} 
?>