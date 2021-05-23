<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
	    header('Location: connexion.php');
	    exit();
    }
    if(!$_SESSION['a_reserve']){
        header('Location: profil.php');
	    exit();
    }

if(isset($_GET['cancel'])){
    if($_GET['cancel']){
        $db_password = $_ENV["mysql_password"];
        $con = new mysqli('db', 'admissibles_user', $db_password, 'admissibles');
        if ($con->connect_error) {
            die('Erreur lors de la connexion à la base de donnée: ' . $con->connect_error);
        }
        if ($stmt = $con->prepare('SELECT * FROM eleves WHERE id = ?')){
            $stmt->bind_param('i', $_SESSION['id']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                if ($stmt = $con->prepare('UPDATE eleves SET a_reserve=0 WHERE id=?')) {
                    $stmt->bind_param('i', $_SESSION['id']);
                    $stmt->execute();
                }
            }
        }
        $_SESSION['a_reserve']=0;
        $stmt->close();
        if ($stmt = $con->prepare('SELECT * FROM demande WHERE id_eleve = ?')){
            $stmt->bind_param('i', $_SESSION['id']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                if ($stmt = $con->prepare('DELETE FROM demande WHERE id_eleve=?')) {
                    $stmt->bind_param('i', $_SESSION['id']);
                    $stmt->execute();
                }
            }
        }
        $stmt->close();
        $con->close();
        header('Location: profil.php');
	    exit();
    }
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
                <h1 class="masthead-heading text-uppercase mb-0">Annulation de ma demande</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0"></p>
            </div>
        </header>
        <!-- Profil Section-->
        <section class="page-section text-secondary mb-0" id="about">
            <div class="container">
                <div class="">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h3 style="text-align: center">Voulez-vous vraiment annuler votre demande ? </br> Cette action sera irréversible.</h3>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-danger" href="cancel.php?cancel=1">
                        Annuler ma demande
                    </a>
                </div>   
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
