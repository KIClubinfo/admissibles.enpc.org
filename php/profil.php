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
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h4 class="text-secondary text-center" style="text-decoration:underline;">Informations personnelles :</h4>
                            <ul style="margin-top:1em;">
                                <li><h6>Nom : <strong><?php echo $_SESSION['nom'] ?></strong></h6></li>
                                <li><h6>Prénom : <strong><?php echo $_SESSION['prenom'] ?></strong></h6></li>
                                <?php
                                if($_SESSION['gender']==1){
                                    echo '<li><h6>Je suis : <strong>Une femme</strong></h6></li>';
                                }
                                else if($_SESSION['gender']==2){
                                    echo '<li><h6>Je suis : <strong>Un homme</strong></h6></li>';
                                }
                                else{
                                    echo '<li><h6>Je suis : <strong>Autre ou ne souhaite pas préciser</strong></h6></li>';
                                }
                                ?>
                                <li><h6>Mail : <strong><?php echo $_SESSION['email'] ?></strong></h6></li>
                                <li><h6>Numéro de téléphone : <strong><?php echo $_SESSION['tel'] ?></strong></h6></li>
                            </ul>
                        </div>
                    </div>
                    <?php
                    if($_SESSION['a_reserve']){
                        if ($stmt = $con->prepare('SELECT * FROM demande WHERE id_eleve = ?')) {
                            $stmt->bind_param('i', $_SESSION['id']);
                            $stmt->execute();
                            $stmt->store_result();
                        }
                        if ($stmt->num_rows > 0) {
                            $stmt->bind_result($id_demande, $id_eleve, $type_chambre, $remplace, $gender_choice, $arrival_date, $arrival_time, $departure_date, $departure_time, $mate, $mate_email, $validee);
                            $stmt->fetch();
                            $stmt->close();
                        }

                        if($type_chambre==1){
                            $type_chambre="Simple";
                        }
                        else if($type_chambre==2){
                            $type_chambre="Binômée";
                        }
                        else if($type_chambre==3){
                            $type_chambre="Double";
                        }

                        list($year1, $month1, $day1) = explode('-', $arrival_date);
                        list($year2, $month2, $day2) = explode('-', $departure_date);  

                    echo '
                    <div class="row justify-content-center" style="margin-top:3em">
                        <div class="col-lg-8">
                            <h4 class="text-secondary text-center" style="text-decoration:underline;">Demande de logement :</h4>
                            <ul style="margin-top:1em">
                                <li><h6>Type de chambre : <strong>'; echo $type_chambre; echo '</strong></h6></li>
                                <li><h6>Si pas de chambre '; echo $type_chambre; if($remplace){
                                                                                    echo ' : <strong>Accepte un autre type de chambre</strong>';
                                                                                }
                                                                                else{
                                                                                    echo ' : <strong>Ne prends pas de chambre d\'un autre type</strong>';
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
                                    echo '<li><h6>Adresse mail de la personne souhaitée : <strong>'; echo $mate_email; echo '</strong></h6></li>';                                                 
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

                                if($validee){
                                    echo '<li><h6>État de la demande : <strong>Demande acceptée</strong></h6></li>';                                                 
                                }
                                else{
                                    echo '<li><h6>État de la demande : <strong>Demande en attente</strong></h6></li>';    
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
                else{echo'
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-primary" href="choice.php">
                        Faire ma demande
                    </a>
                </div>';   
                }
                ?>
                
                
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Localisation</h4>
                        <p class="lead mb-0">
                            6-8 Avenue Blaise Pascal,
                            <br />
                            77420 Champs-sur-Marne, France
                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Retrouvez nous sur les réseaux</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="http://www.facebook.com/pages/École-des-Ponts-ParisTech/367362959990830"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="https://www.instagram.com/ecoledesponts/"><i class="fab fa-fw fa-instagram"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="https://twitter.com/EcoledesPonts"><i class="fab fa-fw fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="http://www.youtube.com/user/EcoledesPonts"><i class="fab fa-fw fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="https://www.linkedin.com/company/ecole-des-ponts-paris-tech/"><i class="fab fa-fw fa-linkedin-in"></i></a>
                    </div>
                    <!-- Footer About Text-->
                    <div class="col-lg-4">
                        <h4 class="text-uppercase mb-4">À propos de l'École des Ponts Paristech</h4>
                        <p class="lead mb-0">
                            <a class="bg-success" href="https://www.ecoledesponts.fr">L'École des Ponts Paristech<a></br>
                            <a class="bg-success" href="http://bde.enpc.org">Le Bureau des Élèves<a></br>
                            <a class="bg-success" href="http://clubinfo.enpc.org">Le Club Informatique<a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer-->
        <?php
            include("footer.php");
        ?>
    </body>
</html>
