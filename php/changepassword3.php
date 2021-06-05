<?php
include("config.php");
if (isset($_SESSION['loggedin'])) {
    header('Location: profil.php');
    exit();
}
if (!isset($_SESSION['email'])) {
    header('Location: changepassword2.php');
    exit();
}
if (!isset($_SESSION['code'])) {
    header('Location: changepassword2.php');
    exit();
}

if (!isset($_POST['password'], $_POST['confpassword'])) {
	header('Location: changepassword2.php?erreur=form');
	exit();
}
if (empty($_POST['password']) || empty($_POST['confpassword'])){
	header('Location: changepassword2.php?erreur=form');
	exit();
}
if ($_POST['password']!=$_POST['confpassword']){
    header('Location: changepassword2.php?erreur=password');
	exit();
}

$safepass=sanitize_string($_POST['password']);

if ($stmt = $con->prepare('SELECT * FROM eleves WHERE mail = ?')) {
	$stmt->bind_param('s', $_SESSION['email']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		$stmt = $con->prepare('UPDATE eleves SET password = ?, change_password = ? WHERE mail=?');
        $password = password_hash($safepass, PASSWORD_DEFAULT);
        $newcode = 'no';
	    $stmt->bind_param('sss', $password, $newcode, $_SESSION['email']);
	    $stmt->execute();
	}
	$stmt->close();
}
$con->close();
header('Location: connexion.php?info=mdpchanged');
exit();
?>