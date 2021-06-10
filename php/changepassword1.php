<?php
include("config.php");
if (isset($_SESSION['loggedin'])) {
    header('Location: profil.php');
    exit();
}

include("mailer.php");

if (!isset($_POST['email']) ) {
	exit('Merci d\'indiquer votre email.');
}
$safemail=sanitize_string($_POST['email']);
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	header('Location: forgotpassword.php?erreur=mail');
	exit();
}

$uniqid = uniqid();

if ($stmt = $con->prepare('SELECT * FROM eleves WHERE mail = ?')){
    $stmt->bind_param('s', $safemail);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        if ($stmt = $con->prepare('UPDATE eleves SET change_password=? WHERE mail=?')) {
            $stmt->bind_param('ss', $uniqid, $safemail);
            $stmt->execute();

            send_mail($_POST['email'], $uniqid,1);
            header('Location: connexion.php?info=changepassword');
	        exit();
	        //echo 'Un email vous a été envoyé. Merci de vérifier vos emails pour activer votre compte.';

		    //******Only while there is no mailer******//
		    //header('Location: temp2.php?email='.htmlspecialchars($_POST['email']).'&code='.$uniqid.'');
	        //exit();
		    //*****************************************//
        }
    }
}
$stmt->close();
$con->close();
?>