<?php
declare(strict_types=1);
require_once 'config.php';
use SendGrid\Mail\Mail;
require __DIR__ . '/vendor/autoload.php';

function send_mail($email_address, $activation_code, $typemessage) {
    // email for account validation
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
                                                Le Club Informatique de l\'École des Ponts confirme que ton inscription a bien été prise en compte.<br/><br/>
                                                Finalise là en cliquant sur le lien ci-dessous :
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center; font-family: Arial, sans-serif;">
                                                
                                                <a href="'.URL_WEBSITE.'/activate.php?email='.$email_address.'&code='.$activation_code.'"
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
    ';}
    // password reset
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
                                                Tu peux le réinitialiser en cliquant sur le lien ci-dessous :
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center; font-family: Arial, sans-serif;">
                                                
                                                <a href="'.URL_WEBSITE.'/changepassword2.php?email='.$email_address.'&code='.$activation_code.'"
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
    ';}
    // Request accepted
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
                                                <b>Ta demande de logement a été acceptée</b>
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
                                                <a href="'.URL_WEBSITE.'/profil.php" 
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
                                            <td style="text-align: justify; padding: 20px 0 30px 0; color: #2c2e50; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                                <br/>Tu pourras y trouver des informations telles que ton numéro de chambre, son type (simple ou double) ainsi que le prix à régler.<br/><br/>
                                                <strong>Le paiment se fera via un mail que tu vas recevoir de la part du gestionnaire de la résidence, Arpej.</strong><br/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: justify; padding: 20px 0 30px 0; color: #2c2e50; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
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
    ';}
    // Request saved
    if($typemessage==3){
        $subject = 'Demande de logement prise en compte';
        $message= '
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Demande de logement prise en compte</title>
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
                                                    <b>Ta demande de logement a été prise en compte</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: justify; padding: 20px 0 30px 0; color: #2c2e50; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                                    Bonjour,<br/>
                                                    <br/>
                                                    Ta demande de logement a été prise en compte. <strong>Tu recevras un mail de confirmation si ta réservation est validée et cela sera mentionné sur ta page profil.</strong> Si tu ne reçois rien et que ta demande reste en attente sur le site, c\'est que nous n\'avons malheuresement pas réussi à te trouver une place. Tu dépends alors du désistement des autres candidats et nous te contacterons si jamais une place se libère.<br/><br/>
                                                    Nous t\'invitons à suivre ce lien pour plus d\'information sur les dates d\'attributions de logements par série :<br/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:center; font-family: Arial, sans-serif;">
                                                    <a href="'.URL_WEBSITE.'/" 
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
                                                    Consulter les dates
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: justify; padding: 20px 0 30px 0; color: #2c2e50; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
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
    ';}
    if($typemessage==4){ //Mail d'annulation de la résa
        $subject = 'Admissibles ENPC: Annuation de la résevation de logement';
        $message= '
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Admissibles ENPC: Annuation de la résevation de logement</title>
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
                                                <b>Ta réservation de logement est annulée</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: justify; padding: 20px 0 30px 0; color: #2c2e50; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                                Bonjour,<br/>
                                                <br/>
                                                Nous t\'informons que ta réservation de logement a été annulée, pour cause de réglement non effectué sous le delai de 48h.<br/><br/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: justify; padding: 20px 0 30px 0; color: #2c2e50; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
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
    ';}
    // email setup
    $email = new Mail();
    $email->setFrom(EMAIL_SENDER, NAME_SENDER);
    $email->setSubject($subject);
    $email->addTo($email_address);
    $email->setReplyTo(EMAIL_REPLY);
    $email->addContent(
        'text/html',
        $message
    );

    $sendgrid = new \SendGrid(SENDGRID_API_KEY);
    try {
        $sendgrid->send($email);
        }
    catch (Exception $e) {
        header('Location: connexion.php?erreur=mail_error');
        exit();
    }
};
?>
