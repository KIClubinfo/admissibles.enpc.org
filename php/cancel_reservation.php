<?php
    ob_start();
    include_once("config.php");
    include("mailer_cancelation.php");
    if (!isset($_SESSION['loggedin'])) {
	    header('Location: connexion.php?erreur=notconnected');
	    exit();
    } 
    if (!is_admin()){
        header('Location: profil.php?erreur=interdit');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php
        include("head.php");
    ?>
    <body id="page-top">
        <!-- Navigation-->
        <?php
            include("navbar.php");
        ?>
        <section style="margin-top: 5%;" class="page-section text-secondary mb-0" id="about">
            <div class="container">
                <!-- Admin Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary">ADMIN</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>

<?php
    //Wait for a confirmation to delete the reservation
    if($_GET['type'] == 0){
        echo '<div class="text-center mt-4" style="margin-bottom:2rem">
                    <a class="btn btn-xl btn-danger" href="cancel_reservation.php?type=1&id='.$_GET['res_id'].'">
                        Supprimer la réservation
                    </a>
                    <a class="btn btn-xl btn-success" href="cancel_reservation.php?type=2&id='.$_GET['res_id'].'" style="margin:1rem">
                        A payé la réservation
                    </a>
                </div>';
    }else if($_GET['type'] == 1){
        if ($stmt = $con->prepare('SELECT * FROM reservation WHERE id_res = ?')){
            $stmt->bind_param('i', $_GET['id']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                if ($stmt = $con->prepare('SELECT id_res, id_eleves, date_arrivee, date_depart, mail, paid, email_send FROM reservation JOIN eleves ON reservation.id_eleves = eleves.id WHERE id_res = ?')) {
                    $stmt->bind_param('i', $_GET['id']);
                    $stmt->bind_result($id_res, $id_eleves, $date_arrivee, $date_depart, $mail, $paid, $email_sent);
                    $stmt->execute();
                    $stmt->fetch();
                    if ($email_sent == 1 && $paid == 0) { 
                        // Only send mail if a mail had been sent to confirm reservation && reservation is not paid
                        send_mail_cancel($mail, $unique_id, $date_arrivee, $date_depart);
                    }
                    $stmt->close();
                }
                if ($stmt = $con->prepare('DELETE FROM reservation WHERE id_res=?')) {
                    $stmt->bind_param('i', $_GET['id']);
                    $stmt->execute();
                    $stmt->close();
                }

                if ($stmt = $con->prepare('DELETE FROM demande WHERE id_eleve=?')) {
                    $stmt->bind_param('i', $id_eleves);
                    $stmt->execute();
                    $stmt->close();
                }
            }
            
        }
        $con->close();
        header('Location: admin.php?table=Reservations');
        exit();

    }else if($_GET['type'] == 2){
        if ($stmt = $con->prepare('SELECT * FROM reservation WHERE id_res = ?')){
            $stmt->bind_param('i', $_GET['id']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                if ($stmt = $con->prepare('UPDATE reservation SET paid = 1 WHERE id_res=?')) {
                    $stmt->bind_param('i', $_GET['id']);
                    $stmt->execute();
                }
            }
        }
        $con->close();
        header('Location: admin.php?table=Reservations ');
	    exit();
    }
?>