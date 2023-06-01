<?php
    include_once("config.php");
    include("mailer.php");

    if (!isset($_SESSION['loggedin'])) {
	    header('Location: connexion.php?erreur=notconnected');
	    exit();
    } 

    if ($stmt = $con->prepare('SELECT  reservation.id_res, eleves.mail,reservation.email_send FROM (eleves JOIN reservation ON reservation.id_eleves = eleves.id) WHERE reservation.date_arrivee IN (SELECT s.arrival_date FROM serie s WHERE s.id_serie = ?);')) {
        $stmt->bind_param('i',$_GET['serie']);
        $stmt->execute();
        $results = $stmt->get_result();
        // $row[1] email_address ; $row[1] (0 in email not send 1 else)
        while ($row = $results->fetch_array()){
            if ($row[2] == 0){ // if email has not sent 
                // email sending
                $uniqid = bin2hex(random_bytes(16));
                send_mail($row[1], $uniqid,2);
                // update the table
                if ($stmt_update = $con->prepare('UPDATE reservation SET email_send = TRUE WHERE id_res = ?;')) {
                    $stmt_update->bind_param('i',$row[0]);
                    $stmt_update->execute();
                }
                else {
                    header('Location: connexion.php?erreur=querry_error');
                    exit();
                } 
                $stmt_update->close();              
            }
        }	
    }
    else {
        header('Location: connexion.php?erreur=querry_error');
        exit();
    } 
    $stmt->close();
    $con->close();

    if(is_admin()){
    	header('Location: admin.php?table=run');
    }
    else{
    	header('Location: profile.php');
    }
?>