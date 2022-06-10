<?php
require_once 'config.php';
require 'vendor/autoload.php';

// TO MODIFY
$receiver_email = "tomodify@tomodify.com";
$receiver_name = "tomodify";

$email = new \SendGrid\Mail\Mail(); 

$email->setFrom(EMAIL_SENDER, NAME_SENDER);
$email->setSubject("Ceci est un test depuis php");
$email->addTo($receiver_email, $receiver_name);
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);

$sendgrid = new \SendGrid( SENDGRID_API_KEY );
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
    // print SENDGRID_API_KEY;
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}