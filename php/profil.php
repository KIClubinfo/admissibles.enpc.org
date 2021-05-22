<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
	    header('Location: connexion.php');
	    exit();
    }
    $db_password = $_ENV["mysql_password"];
    $con = new mysqli('db', 'admissibles_user', $db_password, 'admissibles');
    if ($con->connect_error) {
        die('Erreur lors de la connexion à la base de donnée: ' . $con->connect_error);
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
        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <!-- Masthead Avatar Image-->
                <img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt="..." />
                <!-- Masthead Heading-->
                <h1 class="masthead-heading text-uppercase mb-0">Page de Profil</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0">Graphic Artist - Web Designer - Illustrator</p>
            </div>
        </header>
        <!-- Profil Section-->
        <section class="page-section text-secondary mb-0" id="about">
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
                            <ul style="margin-top:1em">
                                <li><h5>Nom : <?php echo $_SESSION['nom'] ?></h5></li>
                                <li><h5>Prénom : <?php echo $_SESSION['prenom'] ?></h5></li>
                                <li><h5>Mail : <?php echo $_SESSION['email'] ?></h5></li>
                                <li><h5>Numéro : <?php echo $_SESSION['tel'] ?></h5></li>
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

                    echo '<div class="row justify-content-center" style="margin-top:3em">
                        <div class="col-lg-8">
                            <h4 class="text-secondary text-center" style="text-decoration:underline;">Demande de logement :</h4>
                            <ul style="margin-top:1em">
                                <li><h5>Type de chambre : '; echo $type_chambre; echo '</h5></li>
                                <li><h5>Si pas de chambre '; echo $type_chambre; if($remplace){
                                                                                    echo ' : Accepte un autre type de chambre';
                                                                                }
                                                                                else{
                                                                                    echo ' : Ne prends pas de chambre d\'un autre type';
                                                                                }
                                                                                echo ' </h5></li>
                                <li><h5>Date d\'arrivée : '; echo $day1; echo '/'; echo $month1; echo '/'; echo $year1; echo '</h5></li>
                                <li><h5>Heure d\'arrivée : '; echo $arrival_time; echo '</h5></li>
                                <li><h5>Date de départ : '; echo $day2; echo '/'; echo $month2; echo '/'; echo $year2; echo '</h5></li>
                                <li><h5>Heure de départ : '; echo $departure_time; echo '</h5></li>
                                <li><h5>A demandé à être avec une autre personne : '; if($mate){
                                                                                        echo "Oui";                                                      
                                                                                        }
                                                                                        else{
                                                                                            echo "Non";
                                                                                        }
                                                                                         echo '</h5></li>';
                                if($mate){
                                    echo '<li><h5>Adresse mail de la personne souhaitée : '; echo $mate_email; echo '</h5></li>';                                                 
                                }
                                if($gender_choice==1){
                                    echo '<li><h5>Ne souhaite pas être avec : Une femme</h5></li>';
                                }
                                else if($gender_choice==2){
                                    echo '<li><h5>Ne souhaite pas être avec : Un homme</h5></li>';
                                }
                                else{
                                    echo '<li><h5>Ne souhaite pas être avec : Indifférent</h5></li>';
                                }

                                if($validee){
                                    echo '<li><h5>État de la demande : Demande acceptée</h5></li>';                                                 
                                }
                                else{
                                    echo '<li><h5>État de la demande : Demande en attente</h5></li>';    
                                }                                                 
                            echo '</ul>
                        </div>
                    </div>';
                    }
                    else{echo'
                    <div class="row justify-content-center" style="margin-top:3em">
                        <div class="col-lg-8">
                            <h4 class="text-secondary text-center" style="text-decoration:underline;">Demande de logement :</h4>
                            <h5 style="text-align: center"></br>Aucune demande effectuée</h5>
                        </div>
                    </div>';
                    }
                    ?>
                </div>
                <!-- Profil Section Button-->
                <?php
                if($_SESSION['a_reserve']){echo'
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-primary" href="">
                        Modifier ma demande
                    </a>
                    <a class="btn btn-xl btn-danger" href="">
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
