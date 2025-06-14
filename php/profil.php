<?php
    include("config.php");
    if (!isset($_SESSION['loggedin'])) {
	    header('Location: connexion.php');
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
            if (isset($_GET['erreur'])){
                include("popupErreur.php");
            }
            if(isset($_GET['info'])){
                include("popupinfo.php");
            }
        ?>
        <!-- Profil Section-->
        <section style="margin-top: 5%;" class="page-section text-secondary mb-0" id="about">
            <div class="container">
                <!-- Profil Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary">Mon Profil</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Profil Section Content-->
                <div class="">
                    <?php
                    if ($stmt = $con->prepare('SELECT nom, prenom, gender, tel, distance, boursier FROM eleves WHERE id = ?')) {
                        $stmt->bind_param('i', $_SESSION['id']);
                        $stmt->execute();
                        $stmt->store_result();
                    }
                    else {
                        header('Location: connexion.php?erreur=querry_error');
                        exit();
                    }    
                    if ($stmt->num_rows > 0) {
                        $stmt->bind_result($nom, $prenom, $gender, $tel, $distance, $boursier);
                        $stmt->fetch();
                    }
                    else {
                        header('Location: connexion.php?erreur=unknown_error');
                        exit();
                    } 
                    echo '
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!--<h4 class="text-secondary text-center" style="text-decoration:underline;">Les candidats sont invités à prendre connaissance des consignes suivantes :</h4>
                            <a href="assets/Consignes_Oraux_ENPC.pdf"
    download="Consignes_Oraux_ENPC.pdf" class="text-secondary text-center" style="margin-top:1em;"><h6><strong>Télécharger les consignes</strong></h6></a>-->
                            <h4 class="text-secondary text-center" style="text-decoration:underline; margin-top:3em;">Informations personnelles :</h4>
                            <ul style="margin-top:1em;">
                                <li><h6>Nom : <strong>';echo htmlspecialchars($nom); echo '</strong></h6></li>
                                <li><h6>Prénom : <strong>'; echo htmlspecialchars($prenom); echo'</strong></h6></li>';
                                if($gender == 1){
                                    echo '<li><h6>Je suis : <strong>Une femme</strong></h6></li>';
                                }
                                else if($gender == 2){
                                    echo '<li><h6>Je suis : <strong>Un homme</strong></h6></li>';
                                }
                                else{
                                    echo '<li><h6>Je suis : <strong>Autre ou ne souhaite pas préciser</strong></h6></li>';
                                }
                                echo '
                                <li><h6>Mail : <strong>'; echo htmlspecialchars($_SESSION['email']); echo'</strong></h6></li>
                                <li><h6>Numéro de téléphone : <strong>'; echo htmlspecialchars($tel); echo'</strong></h6></li>
                                <li><h6>Distance de Champs-sur-Marne : <strong>'; echo htmlspecialchars($distance); echo '</strong></h6></li>';
                                if($boursier == 0) {
                                    echo '<li><h6>Boursier : <strong>Non</strong></h6></li>';
                                }
                                else {
                                    echo '<li><h6>Boursier : <strong>Oui</strong></h6></li>';
                                }
                                echo '
                            </ul>
                        </div>
                    </div>'
                    ?>
                    <?php
                    if($_SESSION['a_reserve']){
                        if ($stmt = $con->prepare('SELECT * FROM demande WHERE id_eleve = ?')) {
                            $stmt->bind_param('i', $_SESSION['id']);
                            $stmt->execute();
                            $stmt->store_result();
                        }
                        else {
                            header('Location: connexion.php?erreur=querry_error');
                            exit();
                        } 
                        if ($stmt->num_rows > 0) {
                            $stmt->bind_result($id_demande, $id_eleve, $type_chambre, $remplace, $gender_choice, $arrival_date, $arrival_time, $departure_date, $departure_time, $mate, $mate_email, $validee, $demand_time);
                            $stmt->fetch();
                            $stmt->close();
                        }
                        else {
                            header('Location: connexion.php?erreur=unkown_error');
                            exit();
                        }
                        if($type_chambre==1){
                            $type_chambre="Simple";
                            $prix_chambre = "220€ TTC"; // à mettre en variable globale 
                        }
                        else if($type_chambre==2){
                            $type_chambre="Binômée";
                        }
                        else if($type_chambre==3){
                            $type_chambre="Double";
                            $prix_chambre = "180€ TTC"; // à mettre en variable globale 
                        }
                        else {
                            header('Location: connexion.php?erreur=unknown_error');
                            exit();
                        } 

                        list($year1, $month1, $day1) = explode('-', $arrival_date);
                        list($year2, $month2, $day2) = explode('-', $departure_date);  

                    echo '
                    <div class="row justify-content-center" style="margin-top:3em">
                        <div class="col-lg-8">
                            <h4 class="text-secondary text-center" style="text-decoration:underline;">Demande de logement :</h4>
                            <ul style="margin-top:1em">
                                <li><h6>Type de chambre : <strong>'; echo $type_chambre; echo '</strong></h6></li>
                                <li><h6>Prix de la chambre : <strong>'; echo $prix_chambre; echo '</strong></h6></li>
                                <li><h6>Si pas de chambre '; echo $type_chambre; if($remplace){
                                                                                    echo ' : <strong>Accepte un autre type de chambre</strong>';
                                                                                }
                                                                                else{
                                                                                    echo ' : <strong>Ne prend pas de chambre d\'un autre type</strong>';
                                                                                }
                                                                                echo ' </h6></li>
                                <li><h6>Date d\'arrivée : <strong>'; echo $day1; echo '/'; echo $month1; echo '/'; echo $year1; echo '</strong></h6></li>
                                <li><h6>Heure d\'arrivée : <strong>'; echo $arrival_time; echo '</strong></h6></li>
                                <li><h6>Date de départ : <strong>'; echo $day2; echo '/'; echo $month2; echo '/'; echo $year2; echo '</strong></h6></li>
                                <li><h6>Heure de départ : <strong>'; echo $departure_time; echo '</strong></h6></li>
                                <li><h6>A demandé à être avec une autre personne : <strong>'; if($mate){
                                                                                        echo "Oui";                                                      
                                                                                        }
                                                                                        else{
                                                                                            echo "Non";
                                                                                        }
                                                                                         echo '</strong></h6></li>';
                                if($mate){
                                    echo '<li><h6>Adresse mail de la personne souhaitée : <strong>'; echo htmlspecialchars($mate_email); echo '</strong></h6></li>';                                                 
                                }
                                if($gender_choice==1){
                                    echo '<li><h6>Ne souhaite pas être avec : <strong>Une femme</strong></h6></li>';
                                }
                                else if($gender_choice==2){
                                    echo '<li><h6>Ne souhaite pas être avec : <strong>Un homme</strong></h6></li>';
                                }
                                else{
                                    echo '<li><h6>Ne souhaite pas être avec : <strong>Indifférent</strong></h6></li>';
                                }
                                               
                            echo '</ul>
                        </div>
                    </div>';
                    }
                    else{echo'
                    <div class="row justify-content-center" style="margin-top:3em">
                        <div class="col-lg-8">
                            <h4 class="text-secondary text-center" style="text-decoration:underline;">Demande de logement :</h4>
                            <h6 style="text-align: center"></br><strong>Aucune demande effectuée</strong></h6>
                        </div>
                    </div>';
                    }
                    ?>
                </div>
                <!-- Profil Section Button-->
                <?php

                if ($stmt = $con->prepare('SELECT id_res, id_eleves, numero_chambre, date_arrivee, date_depart FROM reservation WHERE id_eleves = ?')) {
                    $stmt->bind_param('i', $_SESSION['id']);
                    $stmt->execute();
                    $stmt->store_result();
                }
                else {
                    header('Location: profil.php?erreur=querry_error');
                    exit();
                }
                if ($stmt->num_rows == 0) {
                    if($_SESSION['a_reserve']){echo'
                    <div class="text-center mt-4">
                        <a class="btn btn-xl btn-primary" href="choice.php">
                            Modifier ma demande
                        </a>
                        <a class="btn btn-xl btn-danger" href="cancel.php" style="margin:1rem">
                            Annuler ma demande
                        </a>
                    </div>';
                    }
                    else{
                        if(protect($debut_demande)){
                            echo '<div class="row justify-content-center" style="margin-top:3em">
                            <div class="col-lg-8">
                                <h6 style="text-align: center"></br><strong>Vous pourrez effectuer une demande à partir du ';echo $debut_demande->format('d-m-Y H:i:s');echo'</strong></h6>
                            </div>
                            </div>';
                        }
                        else{
                            echo'
                            <div class="text-center mt-4">
                            <a class="btn btn-xl btn-primary" href="choice.php">
                            Faire ma demande
                            </a>
                            </div>';   
                        }
                    }
                }

                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($id_res, $id_eleves, $numero_chambre, $date_arrivee, $date_depart);
                    $stmt->fetch();
                    $stmt->close();

                    if ($stmt = $con->prepare('SELECT * FROM chambre WHERE numero = ?')) {
                        $stmt->bind_param('i', $numero_chambre);
                        $stmt->execute();
                        $stmt->store_result();
                    }
                    else {
                        header('Location: profil.php?erreur=querry_error');
                        exit();
                    } 
                    if ($stmt->num_rows > 0) {
                        $stmt->bind_result($numero_chambre, $type);
                        $stmt->fetch();
                        $stmt->close();

                        if($type==1){
                            $type_chambre="Simple";
                            $prix_chambre = "220€ TTC";
                        }
                        else if($type==2){
                            $type_chambre="Binômée";
                        }
                        else if($type==3){
                            $type_chambre="Double";
                            $prix_chambre = "180€ TTC";
                        }
                        else {
                            header('Location: connexion.php?erreur=unknown_error');
                            exit();
                        } 

                        echo '
                        <div class="row justify-content-center" style="margin-top:3em">
                            <div class="col-lg-8">
                                <h4 class="text-secondary text-center" style="text-decoration:underline;">Chambre attribuée :</h4>
                                <ul style="margin-top:1em">
                                    <li><h6>Type de chambre : <strong>'; echo $type_chambre; echo '</strong></h6></li>
                                    <li><h6>Prix à régler : <strong>';echo $prix_chambre; echo "</strong></h6></li>. Vous allez recevoir un <strong>mail d'Arpej</strong> vous expliquant la procédure à suivre. Le paiement doit se faire impérativement <strong>dans les 48h</strong>.
                                    <li><h6>Numéro de chambre : <strong>"; echo $numero_chambre; echo '</strong></h6></li>
                                </ul>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <a class="btn btn-xl btn-danger" href="refused.php" style="margin:1rem">
                                Désistement
                            </a>
                        </div>';
                    }
                }
                ?>
                
                
            </div>
        </section>
        <!--Footer Information-->
        <?php
            include("footer_info.php");
            include("footer.php");
        ?>
        <script src="js/demo.js"></script>
    </body>
</html>
