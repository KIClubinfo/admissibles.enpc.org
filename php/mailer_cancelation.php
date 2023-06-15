<?php
declare(strict_types=1);
require_once "config.php";
require __DIR__ . "/vendor/autoload.php";
use SendGrid\Mail\Mail;

function send_mail_cancel($email_address, $activation_code, $date_arr, $date_dep) {
    $subject = "Admissibles ENPC: Annuation de la résevation de logement";
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
                                            Nous t\'informons que ta réservation pour un logement du $date_arr au $date_dep. a été annulée, pour cause de réglement non effectué sous le delai de 48h.<br/><br/>
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
    ';
    // email setup
    $email = new Mail();
    $email->setFrom(EMAIL_SENDER, NAME_SENDER);
    $email->setSubject($subject);
    $email->addTo($email_address);
    $email->setReplyTo(EMAIL_REPLY);
    $email->addContent(
        "text/html",
        $message
    );

    $sendgrid = new \SendGrid(SENDGRID_API_KEY);
    try {
        $sendgrid->send($email);
        }
    catch (Exception $e) {
        header("Location: connexion.php?erreur=mail_error");
        exit();
    };
};
?>
