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
$subject = 'Validation de ton compte Admissibles';
$message= '
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Validation de compte Admissibles</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
        <tr>
            <td style="padding: 10px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                    <tr>
                        <td align="center" bgcolor="#5fa8d3" style="padding: 40px 0 30px 0; color: #ffffff; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                            <b>Admissibles : École des Ponts</b>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="text-align: center; color: #2c2e50; font-family: Arial, sans-serif; font-size: 24px;">
                                        <b>Finalisation de ton inscription</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: justify; padding: 20px 0 30px 0; color: #2c2e50; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                        Bonjour,<br/>
                                        <br/>
                                        Le Club Informatique de l\'École des Ponts te confirme que ton inscription a bien été prise en compte.<br/><br/>
                                        Vérifie ton inscription en cliquant sur le lien ci-dessous :
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:center; font-family: Arial, sans-serif;">
                                        
                                        <a href="admissibles.enpc.org/activate.php?email='.$email.'&code='.$activation_code.'"
                                        style="display: inline-block;
                                        font-weight: 400;
                                        color: #5fa8d3;
                                        text-align: center;
                                        background-color: transparent;
                                        border: 0.125rem solid #5fa8d3;
                                        padding: 0.375rem 0.75rem;
                                        font-size: 1.1rem;
                                        line-height: 1.5;
                                        border-radius: 0.5rem;
                                        text-decoration: none;">
                                            Vérifier mon compte
                                        </a>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td style="padding: 20px 0 0 0; color: #2c2e50; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                        Cordialement,<br/>
                                        <br/>
                                        Le Club Informatique des Ponts.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#5fa8d3" style="padding: 30px 30px 30px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: rgb(255, 255, 255); font-family: Arial, sans-serif; font-size: 14px;" width="100%">
                                        Cet email a été envoyé automatiquement, merci de ne pas y répondre.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
';
}
if($typemessage==1){
    $subject = 'Réinitialisation de mot de passe';

    $message= '
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Réinitialisation de mot de passe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body style="margin: 0; padding: 0;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
            <tr>
                <td style="padding: 10px 0 30px 0;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                        <tr>
                            <td align="center" bgcolor="#5fa8d3" style="padding: 40px 0 30px 0; color: #ffffff; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                                <b>Admissibles : École des Ponts</b>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="text-align: center; color: #2c2e50; font-family: Arial, sans-serif; font-size: 24px;">
                                            <b>Réinitialisation de ton mot de passe</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: justify; padding: 20px 0 30px 0; color: #2c2e50; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                            Bonjour,<br/>
                                            <br/>
                                            Tu as demandé une réinitialisation de ton mot de passe<br/><br/>
                                            Tu peux réinitialiser ton mot de passe en cliquant sur le lien ci-dessous :
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center; font-family: Arial, sans-serif;">
                                            
                                            <a href="admissibles.enpc.org/changepassword2.php?email='.$email.'&code='.$activation_code.'"
                                            style="display: inline-block;
                                            font-weight: 400;
                                            color: #5fa8d3;
                                            text-align: center;
                                            background-color: transparent;
                                            border: 0.125rem solid #5fa8d3;
                                            padding: 0.375rem 0.75rem;
                                            font-size: 1.1rem;
                                            line-height: 1.5;
                                            border-radius: 0.5rem;
                                            text-decoration: none;">
                                                Réinitialiser mon mot de passe
                                            </a>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td style="padding: 20px 0 0 0; color: #2c2e50; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                            Cordialement,<br/>
                                            <br/>
                                            Le Club Informatique des Ponts.
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#5fa8d3" style="padding: 30px 30px 30px 30px;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="color: rgb(255, 255, 255); font-family: Arial, sans-serif; font-size: 14px;" width="100%">
                                            Cet email a été envoyé automatiquement, merci de ne pas y répondre.
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>
    ';
    }
    if($typemessage==2){
        $subject = 'Demande de logement acceptée';

        $message= '
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Demande de logement acceptée</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        </head>
        <body style="margin: 0; padding: 0;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
                <tr>
                    <td style="padding: 10px 0 30px 0;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                            <tr>
                                <td align="center" bgcolor="#5fa8d3" style="padding: 40px 0 30px 0; color: #ffffff; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                                    <b>Admissibles : École des Ponts</b>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td style="text-align: center; color: #2c2e50; font-family: Arial, sans-serif; font-size: 24px;">
                                                <b>Votre demande de logement a été acceptée</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: justify; padding: 20px 0 30px 0; color: #2c2e50; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                                Bonjour,<br/>
                                                <br/>
                                                Nous te confirmons que ta demande de logement a été acceptée.<br/><br/>
                                                <strong>Nous t\'invitons à consulter ton profil pour plus d\'informations :</strong><br/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center; font-family: Arial, sans-serif;">
                                                <a href="https://admissibles.enpc.org/profil.php" 
                                                style="display: inline-block;
                                                font-weight: 400;
                                                color: #5fa8d3;
                                                text-align: center;
                                                background-color: transparent;
                                                border: 0.125rem solid #5fa8d3;
                                                padding: 0.375rem 0.75rem;
                                                font-size: 1.1rem;
                                                line-height: 1.5;
                                                border-radius: 0.5rem;
                                                text-decoration: none;">
                                                Consulter mon profil
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Cordialement,<br/>
                                                <br/>
                                                Le Club Informatique des Ponts.
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#5fa8d3" style="padding: 30px 30px 30px 30px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td style="color: rgb(255, 255, 255); font-family: Arial, sans-serif; font-size: 14px;" width="100%">
                                                Cet email a été envoyé automatiquement, merci de ne pas y répondre.
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>';
    }
$mail = new PHPMailer(true);
try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                  //Enable SMTP authentication

    //cette méthode d'écriture ne marche pas si num>=10
    if(file_exists('mailer.txt')){
        $file = fopen('mailer.txt', 'r+');
        $num = fgets($file);
    }
    else{
        $file = fopen('mailer.txt', 'a+');
        $num = 0;
    }
    fseek($file, 0);
    if($num==0){$mail->Username='admissibles1.enpc@gmail.com';}
    else if($num==1){$mail->Username='admissibles2.enpc@gmail.com';}
    else if($num==2){$mail->Username='admissibles3.enpc@gmail.com';}
    else if($num==3){$mail->Username='admissibles4.enpc@gmail.com';}
    else if($num==4){$mail->Username='admissibles5.enpc@gmail.com';}
    else if($num==5){$mail->Username='admissibles6.enpc@gmail.com';}
    else if($num==6){$mail->Username='admissibles7.enpc@gmail.com';}
    else if($num==7){$mail->Username='admissibles8.enpc@gmail.com';}
    else if($num==8){$mail->Username='admissibles9.enpc@gmail.com';}
    else if($num==9){$mail->Username='admissibles10.enpc@gmail.com';}
    else{$mail->Username='admissibles1.enpc@gmail.com';}
    //actualisation du mailer actuel:
    if($num>8 || $num<0){
        $num=0;
        fputs($file, $num);
        fclose($file);
    }
    else{
        $num=$num+1;
        fputs($file, $num);
        fclose($file);
    }

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
    header('Location: connexion.php?erreur=mail_error');
    exit();
};
};
?>