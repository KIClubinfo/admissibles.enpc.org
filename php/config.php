<?php
session_start();

$debug = $_ENV["DEBUG"];
if ($debug) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}

$db_password = $_ENV["MYSQL_PASSWORD"];
$con = new mysqli('db', 'admissibles_user', $db_password, 'admissibles');
if ($con->connect_error) {
        header('Location: connexion.php?erreur=bdderror');
	exit();
}

// email configuration TO MODIFY
define("SENDGRID_API_KEY", "SG.C7GBSvOpSbGEUVe2B668hg.cEGS-rnWsnzWg30e-F_cBM71hzSVg99sBtFcew6mg2w");
define("EMAIL_SENDER", "admissibles@enpc.org");
define("NAME_SENDER", "Logements ENPC admissibles");
define("EMAIL_REPLY", "noreply@enpc.org");
define("NAME_REPLY", "no reply");
define("URL_WEBSITE", "https://admissibles.enpc.org/");

function is_admin()
{ // renvoie true si l'user est un admin
    if (isset($_SESSION['loggedin'])) {
        if ($_SESSION['admin']==1) {
            return True;
        }
    }
    return False;
}

$debut_inscription=new DateTime('2025-06-13 18:00:00');//à modifier
$debut_demande=new DateTime('2025-06-16 10:00:00');//à modifier
$debut_oraux=new DateTime('2025-06-23');//à modifier
$fin_oraux=new DateTime('2025-07-19');//à modifier

function protect($dateprotection) {
    $date = new DateTime(null, new DateTimeZone('Europe/Paris'));
    if ($date<$dateprotection and !is_admin()) {
        return True;
    }
    else{
        return False;
    }
}

function sanitize_string($str)
{
    global $con;
    $sanitize = mysqli_real_escape_string($con, $str);
    return $sanitize;
}
?>
