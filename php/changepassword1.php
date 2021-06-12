<?php
include("config.php");
if (isset($_SESSION['loggedin'])) {
    header('Location: profil.php');
    exit();
}

include("mailer.php");

if (!isset($_POST['email']) || empty($_POST['email']) ) {
	header('Location: forgotpassword.php?erreur=mail');
	exit();
}
$safemail=sanitize_string($_POST['email']);
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	header('Location: forgotpassword.php?erreur=mail');
	exit();
}

$uniqid = uniqid();

if ($stmt = $con->prepare('SELECT admin FROM eleves WHERE mail = ?')){
    $stmt->bind_param('s', $safemail);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($isadmin);
        $stmt->fetch();
        $stmt->close();
        if($isadmin){
            header('Location: connexion.php?erreur=autre');
	        exit();
        }
        if ($stmt = $con->prepare('UPDATE eleves SET change_password=? WHERE mail=?')) {
            $stmt->bind_param('ss', $uniqid, $safemail);
            $stmt->execute();
            send_mail($_POST['email'], $uniqid,1);
            header('Location: connexion.php?info=changepassword');
	        exit();
        }
    }
}
$stmt->close();
$con->close();
?>