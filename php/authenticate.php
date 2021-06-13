<?php
include("config.php");

if ( !isset($_POST['email'], $_POST['password']) ) {
	exit('Merci de remplir l\'email et le mot de passe.');
}

$safemail=sanitize_string($_POST['email']);
$safepass=sanitize_string($_POST['password']);

if ($stmt = $con->prepare('SELECT id, password, admin, a_reserve, activation_code FROM eleves WHERE mail = ?')) {
	$stmt->bind_param('s', $safemail);
	$stmt->execute();
	$stmt->store_result();
}

else {
	header('Location: connexion.php?erreur=querry_error');
    exit();
} 

if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password, $admin, $a_reserve, $activation_code);
	$stmt->fetch();
	//on arrête la réinitialisation du mot de passe si l'élève se connecte
	$stmt = $con->prepare('UPDATE eleves SET change_password = ? WHERE mail=?');
	$newcode = 'no';
	$stmt->bind_param('ss', $newcode, $safemail);
	$stmt->execute();
	if (password_verify($safepass, $password)) {
		if($activation_code=='activated'){
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['id'] = $id;
			$_SESSION['admin'] = $admin;
			$_SESSION['a_reserve'] = $a_reserve;
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
$con->close();
?>