<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require __DIR__ . '/vendor/autoload.php';
//require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
//require '/usr/local/lib/php/vendor/autoload.php';
//require '/var/www/html/vendor/autoload.php';
//require 'vendor/autoload.php';

function send_mail($email, $activation_code, $typemessage) {

if($typemessage==0){
$message= '
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Validation de ton compte Admissibles</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
    <p>
        Bonjour,
        <a href="localhost:8123/activate.php?email='.$email.'&code='.$activation_code.'">Clique ici pour activer ton compte</a>
    </p>
</body>
</html>
';
}
if($typemessage==1){
    $message= '
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Changement de ton mot de passe Admissibles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body style="margin: 0; padding: 0;">
        <p>
            Bonjour. Tu as demandé à modifier ton mot de passe Admissibles.
            <a href="localhost:8123/changepassword2.php?email='.$email.'&code='.$activation_code.'">Clique ici pour le modifier.</a>
        </p>
    </body>
    </html>
    ';
    }

$subject = 'Validation de ton compte Admissibles';
$mail = new PHPMailer(true);
try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'admissibles.enpc@gmail.com';                     //SMTP username
    $mail->Password   = getenv("gmail_password");                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('admissibles.enpc@gmail.com', 'Admissibles');
    $mail->addAddress($email);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
	   $mail->Body = $message;
    // $mail->Body    = $message;
    // $mail->AltBody = $message;
    $mail->CharSet = "UTF-8";

    $mail->send();
} catch (Exception $e) {

};
};
?>