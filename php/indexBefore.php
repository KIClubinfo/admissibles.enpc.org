<?php
    include("config.php");
    if (isset($_SESSION['loggedin'])) {
	    header('Location: index.php');
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
        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <!-- Masthead Avatar Image-->
                <img class="masthead-avatar mb-5" title="Icônes conçues par Smashicons from www.flaticon.com" src="assets/img/maison2.svg" alt="..." />
                <!-- Masthead Heading-->
                <h1 class="masthead-heading text-uppercase text-white mb-0">Bienvenue !</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0">Répartition des logements pour les admissibles au concours Mines-Ponts</p>
            </div>
        </header>
         <!-- About Section-->
         <section class="page-section text-secondary mb-0" id="about">
            <div class="container">
                <!-- About Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary">à quoi sert ce site ?</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- About Section Content-->
                <div class="row justify-content-center">
                    <div class="col-lg-8"><p class="lead" style="text-align: justify">Si tu es sur ce site, c'est que tu es admissible au <strong>concours Mines-Ponts</strong> et que tu vas passer les oraux à <strong>l'École des Ponts</strong>. <br/>Grâce à ce site, tu vas pouvoir demander un logement pour ton séjour à <strong>Champs-sur-Marne</strong>.</p></div>
                    <div class="text-center mt-4">
                        <a class="btn btn-xl btn-primary" href="inscription.php">
                        Inscris-toi dès maintenant pour demander un logement.
                        </a>
                    </div>
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
        <!-- Footer-->
        <?php
            include("footer.php");
        ?>
    </body>
</html>
