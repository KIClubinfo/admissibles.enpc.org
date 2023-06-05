<?php
    include_once("config.php");
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
                    <a class="btn btn-xl btn-primary" style="border-color:red; background-color: red" href="cancel_reservation.php?type=1&id='.$_GET['res_id'].'">
                        Supprimer la réservation
                    </a>
                    <a class="btn btn-xl btn-primary" style="border-color:green; background-color:green" href="admin.php?table=Reservations" style="margin:1rem">
                        Annuler la suppression
                    </a>
                </div>';
    }else if($_GET['type'] == 1){
        //Delete reservation from mysql and show confirmation message 
        //WIP

    }
?>