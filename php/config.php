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
define("SENDGRID_API_KEY", "YOUR_API_KEY");

define("EMAIL_SENDER", "tomodify@tomodify.org");
define("NAME_SENDER", "tomodify");
define("EMAIL_REPLY", "tomodify@tomodify.org");
define("NAME_REPLY", "tomodify");

// global website address (for confirmation email) TO MODIFY
define("WEB_ADDRESS", "http://localhost:8123");


function is_admin()
{ // renvoie true si l'user est un admin
    if (isset($_SESSION['loggedin'])) {
        if ($_SESSION['admin']==1) {
            return True;
        }
    }
    return False;
}

$debut_demande=new DateTime('2022-06-01 20:00:00');//à modifier
$debut_inscription=new DateTime('2022-05-01 20:00:0');//à modifier
$debut_oraux=new DateTime('2022-06-05');//à modifier
$fin_oraux=new DateTime('2022-07-29');//à modifier

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
