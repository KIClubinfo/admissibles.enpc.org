<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    header('Location: profil.php');
    exit();
}

//include("mailer.php");

$db_password = $_ENV["mysql_password"];
$con = new mysqli('db', 'admissibles_user', $db_password, 'admissibles');
if ($con->connect_error) {
    die('Erreur lors de la connexion à la base de donnée: ' . $con->connect_error);
}

if ( !isset($_POST['email']) ) {
	exit('Merci d\'indiquer votre email.');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	header('Location: forgotpassword.php?erreur=mail');
	exit();
}

$uniqid = uniqid();

if ($stmt = $con->prepare('SELECT * FROM eleves WHERE mail = ?')){
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        if ($stmt = $con->prepare('UPDATE eleves SET change_password=? WHERE mail=?')) {
            $stmt->bind_param('ss', $uniqid, $_POST['email']);
            $stmt->execute();

            //send_mail($_POST['email'], $uniqid, $_POST['prenom'],1);
	        //echo 'Un email vous a été envoyé. Merci de vérifier vos emails pour activer votre compte.';

		    //******Only while there is no mailer******//
		    header('Location: temp2.php?email='.$_POST['email'].'&code='.$uniqid.'');
	        exit();
		    //*****************************************//
        }
    }
}
$stmt->close();
$con->close();
?>