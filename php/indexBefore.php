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
        <!--Footer Information-->
        <?php
            include("footer_info.php");
            include("footer.php");
        ?>
    </body>
</html>
