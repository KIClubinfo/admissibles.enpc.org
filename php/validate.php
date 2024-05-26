<?php
include("config.php");
include("mailer.php");

if (isset($_SESSION['loggedin'])) {
    header('Location: profil.php');
    exit();
}

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
if (preg_match("/^(?:(?:\+|00)(33|93|27|355|213|49|376|244|1264|1268|966|54|374|297|247|61|43|994|1242|973|880|1246|32|501|229|1441|975|375|95|591|387|267|55|673|359|226|257|855|237|1|238|1345|236|56|86|357|57|269|243|242|682|850|82|506|225|385|53|599|45|246|253|1767|20|971|593|291|34|372|251|298|679|358|241|220|995|233|350|30|1473|299|590|1671|502|224|240|245|592|594|509|504|852|36|91|62|964|98|353|354|972|39|1876|81|962|7|254|996|686|383|965|856|266|371|961|231|218|423|370|352|853|389|261|60|265|960|223|500|356|1670|212|692|596|230|222|262|52|691|373|377|976|382|1664|258|264|674|977|505|227|234|683|47|687|64|968|256|998|92|680|970|507|675|595|31|51|63|48|689|351|974|262|40|44|7|250|1869|290|1758|378|508|1784|677|503|685|1684|239|221|381|248|232|65|421|386|252|249|211|94|46|41|597|268|963|992|255|886|235|420|672|66|670|228|690|676|1868|216|993|1649|90|688|380|598|678|39|58|1340|1284|84|681|967|260|263|881|882|21)|0)[0-9](\d{8})$/", $_POST['tel']) == 0) {
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
if ($_POST['gender'] != 1 && $_POST['gender'] != 2 && $_POST['gender'] != 3) {
	header('Location: inscription.php?erreur=autre');
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
		$uniqid = bin2hex(random_bytes(16));
	    $stmt->bind_param('ssisssdis', $safeprenom, $safenom, $safegender, $password, $safemail, $safetel, $safedistance, $safeboursier, $uniqid);
	    $stmt->execute();

		send_mail($_POST['email'], $uniqid,0);
		header('Location: connexion.php?info=mailinscription');
	    exit();
	}
	$stmt->close();
}
else {
	header('Location: connexion.php?erreur=querry_error');
    exit();
} 

$con->close();
?>
