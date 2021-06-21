<?php
    include("config.php");
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
        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <!-- Masthead Avatar Image-->
                <img class="masthead-avatar mb-5" src="assets/img/maison2.svg" alt="..." />
                <!-- Masthead Heading-->
                <h1 class="masthead-heading text-uppercase text-white mb-0">Accueil</h1>
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
                <?php if(isset($_SESSION['loggedin'])){echo '
                <!-- About Section Content-->
                <div class="row">
                    <div class="col-lg-4 ml-auto"><p class="lead" style="text-align: justify">Si tu es sur ce site, c\'est que tu es admissible au <strong>concours Mines-Ponts</strong> et que tu vas passer les oraux à <strong>l\'École des Ponts</strong>. <br/>Grâce à ce site, tu vas pouvoir demander un logement pour ton séjour à <strong>Champs-sur-Marne</strong>.</p></div>
                    <div class="col-lg-4 mr-auto"><p class="lead" style="text-align: justify">Tu peux découvrir dans la section suivante les différentes possibilités de logement qui te sont proposées.</p></div>
                </div>';}
                else{
                    echo '<!-- About Section Content-->
                    <div class="row justify-content-center">
                        <div class="col-lg-8"><p class="lead" style="text-align: justify">Si tu es sur ce site, c\'est que tu es admissible au <strong>concours Mines-Ponts</strong> et que tu vas passer les oraux à <strong>l\'École des Ponts</strong>. <br/>Grâce à ce site, tu vas pouvoir demander un logement pour ton séjour à <strong>Champs-sur-Marne</strong>.</p></div>
                        <div class="text-center mt-4">
                            <a class="btn btn-xl btn-primary" style="margin:1rem" href="inscription.php">
                            Inscris-toi dès maintenant pour demander un logement.
                            </a>
                        </div>
                    </div>';}?>
            </div>
        </section>

        
        <?php if(!isset($_SESSION['loggedin'])){echo '
        <!-- Message Section-->
        <section class="page-section bg-primary text-white portfolio" id="message">
            <div class="container">
                <!-- Informations Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white mb-0">Résultat des attributions</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <p class="lead" style="text-align: justify">L\'attribution des <strong>logements</strong> pour les <strong>séries 2, 3 et 4</strong> est disponible. <br/> Veuillez vous connecter pour y avoir accès.</p>
                        <h4 style="text-decoration:underline;">Attention à deux points !</h4>
                        <ul class="lead">
                            <li>Il reste des demandes à traiter, donc il est nécessaire de consulter ces listes régulièrement, des noms vont s’ajouter dans la journée, et demain.</li>
                            <li>Pour les <strong>dates d\'arrivée</strong>, c\'est à partir du dimanche. Pour les <strong>dates de sortie</strong>, c\'est le samedi dans l\'idéal, et le dimanche si vous ne pouvez pas faire autrement.</li>
                        </ul>
                        <p class="lead" style="text-align: justify">Si vous avez des questions, des remarques, des demandes, n’hésitez pas à nous contacter par mail ou téléphone !</p>
                    </div>
                </div>
            </div>
        </section>';}?>

        <?php if(isset($_SESSION['loggedin'])){echo '
        <!-- Portfolio Section-->
        <section class="page-section bg-primary text-white portfolio" id="portfolio">
            <div class="container">
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white mb-0">Les chambres de la résidence</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                <div class="row justify-content-center">
                    <!-- Portfolio Item 1-->
                    <div class="col-md-6 col-lg-4 mb-5">
                        <h2 class="text-center text-uppercase text-white mb-0" style="padding-bottom:2rem">Chambre Simple</h2>
                        <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal1">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/simple.jpg" alt="..." />
                        </div>
                    </div>
                    <!-- Portfolio Item 2-->
                    <div class="col-md-6 col-lg-4 mb-5">
                        <h2 class="text-center text-uppercase text-white mb-0" style="padding-bottom:2rem">Chambre Binômé</h2>
                        <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal2">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/binome.png" alt="..." />
                        </div>
                    </div>
                    <!-- Portfolio Item 3-->
                    <div class="col-md-6 col-lg-4 mb-5">
                        <h2 class="text-center text-uppercase text-white mb-0" style="padding-bottom:2rem">Chambre Double</h2>
                        <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal3">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/double.jpg" alt="..." />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Informations Section-->
        <section class="page-section text-secondary mb-0" id="about">
            <div class="container">
                <!-- Informations Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary">Comment sont traitées les demandes ?</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Informations Section Content-->
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <p class="lead" style="text-align: justify">Afin d\'être le plus équitable possible dans l\'attribution des logements, les paramètres pris en compte seront :</p>
                        <ul style="">
                            <li><h5>Le statut de boursier<h5></li>
                            <li><h5>La distance entre le domicile et l\'École des Ponts</h5></li>
                        </ul>
                        <p class="lead" style="text-align: justify">Si ces paramètres ne permettent pas de déterminer l\'attribution des chambres, la rapidité de réponse au questionnaire sera prise en compte.</p>
                        <p class="lead" style="text-align: center"><strong>Vous pouvez faire votre demande dans l\'onglet profil</strong></p>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-primary" href="profil.php">
                        Voir mon profil
                    </a>
                </div>
            </div>
        </section>';}?>


        <!--Footer Information-->
        <?php
            include("footer_info.php");
        ?>
        <!-- Chambres Modaux-->
        <?php
            include("chambreModaux.php");
        ?>
        <!-- Footer-->
        <?php
            include("footer.php");
        ?>
    </body>
</html>
