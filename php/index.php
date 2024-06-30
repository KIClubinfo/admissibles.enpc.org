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
        <header class="masthead text-white text-center" style="background-image:url('./assets/img/enpc.jpg'); background-size:cover;">
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
                <p class="masthead-subheading font-weight-light mb-0">Pour plus d'information sur l'accueil des admissibles :</p>
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-primary" style="margin:1rem; background-color: rgba(00, 00, 25, 0.3); color: white" href="assets/img/planning_S2.jpg" target="_blank" rel="noopener noreferrer" > Télécharge le planning de la semaine</a>
                </div>
                        
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-primary" style="margin:1rem; background-color: rgba(00, 00, 25, 0.3); color: white" href="https://www.facebook.com/share/M4FPwHQ7ugkjWTcq/" target="_blank" rel="noopener noreferrer"> Rejoins notre groupe Facebook <i class="fab fa-fw fa-facebook", style="font-size: 1.4em; vertical-align: middle;"></i> </a>
                </div>

                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-primary" style="margin:1rem; background-color: rgba(00, 00, 25, 0.3); color: white" href="https://instagram.com/admissibles.ponts" target="_blank" rel="noopener noreferrer"> Rejoins notre page Instagram <i class="fab fa-fw fa-instagram", style="font-size: 1.4em; vertical-align: middle;"></i> </a>
                </div>
            </div>
        </header>
         <!-- About Section-->
         <section class="page-section text-secondary mb-0" id="about">
            <div class="container">
                <!-- About Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary">À quoi sert ce site ?</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <?php echo '
                <!-- About Section Content-->
                <div class="row">
                    <div class="col-lg-4 ml-auto"><p class="lead" style="text-align: justify">Si tu es sur ce site, c\'est que tu es admissible au <strong>concours Mines-Ponts</strong> et que tu vas passer les oraux à <strong>l\'École des Ponts</strong>. <br/>Grâce à ce site, tu vas pouvoir demander un logement pour ton séjour à <strong>Champs-sur-Marne</strong>.</p></div>
                    <div class="col-lg-4 mr-auto"><p class="lead" style="text-align: justify">Tu peux découvrir dans la section suivante les différentes possibilités de logement qui te sont proposées. <br/> Ces logements se trouvent dans la <strong> Résidence Meunier </strong> située au <strong> 9 bis Boulevard Copernic, 77420 Champs-sur-Marne</strong>. </p></div>
                </div>';
                if(!isset($_SESSION['loggedin'])){
                        echo '<div class="text-center mt-4">
                            <a class="btn btn-xl btn-primary" style="margin:1rem" href="inscription.php">
                            Inscris-toi dès maintenant pour demander un logement.
                            </a>
                        </div>
                    </div>';}?>
            </div>
        </section>

        <?php echo '
        <!-- Portfolio Section-->
        <section class="page-section bg-secondary text-white portfolio" id="portfolio">
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
                    <!--
                    <div class="col-md-6 col-lg-4 mb-5">
                        <h2 class="text-center text-uppercase text-white mb-0" style="padding-bottom:2rem">Chambre Binômé</h2>
                        <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal2">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/binome.png" alt="..." />
                        </div>
                    </div>
                    -->
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
		    <p class="lead" style="text-align: justify">Pour toutes les chambres: les equipements de couchage et des ustensiles de cuisine sont fournis, il faudra cependant ramener vos propres affaires de toillette.<br><br>
		Il est possible de partager une chambre double avec une personne de votre choix. Il faudra, lors de la demande, renseigner le mail que votre colocataire a utilisé pour l\'inscription sur ce site.</p>
                </div>
            </div>
        </section>
        <!-- Localisation Section-->
        <section class="page-section text-secondary mb-0" id="localisation">
            <div class="container">
                <!-- Informations Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Localisation et accès</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            </div>
            <div class="row justify-content-center">
            <div class="col-sm-4">
                        <p class="lead" style="text-align: justify">La résidence est idéalement située à <strong> 100m </strong>de l\'entrée de l\'école. <br/>Elle est située à <strong>7min</strong> du <strong>RER A</strong> (arrêt <strong>Noisy-Champs</strong>).
            <br/> Elle est accessible par l\'Autoroute A4, sortie 10 - Cité Descartes.
            <br/> Elle est aussi accessible par le bus:     
                    <ul> 
                        <li>Bus RATP 213 : ligne Gare SNCF Chelles-Gournay / Lognes-le-village</li>
                        <li>Bus RATP 212 : ligne Pointe-de-Champs / Gare SNCF Emerainville </li>
                        <li>Bus CIF/VAS 100 : ligne Créteil l\'Echat métro / Torcy RER - arrêt CROUS </li>
                    </ul>
                    </p>
            </div>
            	<div class="col-sm-4">               
            	    <div class="iframe-rwd">
        		<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5251.69477694093!2d2.584025678325062!3d48.84204961041292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e60e2de58a43d9%3A0x863c17111ec90ee1!2sResidence%20ARPEJ%20Univercity%20%22Meunier%22!5e0!3m2!1sen!2sfr!4v1655057743213!5m2!1sen!2sfr"></iframe>
        	    </div>
            	</div>
            </div>
        </div>
        </div>
        </section>
        <!-- Informations Section-->
        <section class="page-section bg-primary text-white portfolio" id="about">
            <div class="container">
                <!-- Informations Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white">Comment sont traitées les demandes ?</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
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
                        <h4 style="text-decoration:underline;">Attention à trois points !</h4>
                        <ul class="lead">
                            <li>L\'attribution se fait grâce à un algorithme qui crée une <strong>liste d\'attente</strong>. Si tu n\'as pas eu de chambre au premier tour, tu peux toujours en obtenir une en cas de <strong>désistement</strong> d\'un autre candidat.</li>
                            <li> Une fois qu\'une chambre t\'a été attibuée, tu as <strong> 48h </strong> pour payer. Pour cela, tu recevras un mail de la part du gestionnaire de la résidence. </li>
                            <li>Pour les <strong>dates d\'arrivée</strong>, c\'est à partir du dimanche. <strong>L\'arrivée est possible tous les jours de la semaine.</strong> Pareil pour les <strong>dates de sortie</strong>, c\'est possible tous les jours de la semaine mais <strong>le logement doit être rendu avant le samedi à 17h</strong>.
                                </br>Plus précisément, les <strong>horaires d\'arrivée</strong> sont les suivants :
                                <ul class="lead">
                                    <li>En <strong>semaine</strong>, 9h-13h puis 14h-18h;</li>
                                    <li>Le <strong>samedi</strong>, 9h30-13h puis 14h-17h;</li>
                                    <li>Le <strong>dimanche</strong>, 11h-13h puis 14h-18h30.</li>
                                </ul></li>
                                Le tarif est <strong>unique quelque soit le nombre de jours</strong> passés dans la résidence !
                        </ul>';
                        
                        if(isset($_SESSION['loggedin'])){echo '<p class="lead" style="text-align: center"><strong>Tu peux faire ta demande dans l\'onglet profil</strong></p>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-primary" href="profil.php">
                        Voir mon profil
                    </a>
                </div>
                ';}
            else{
                echo '
                <p class="lead" style="text-align: center"><strong>Connecte toi pour faire ta demande!</p>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-secondary" href="connexion.php">
                        Connexion
                    </a>
                </div>
                ';
            }
            echo'
            </div>
        </section>';

        echo '
        <!-- Message Section-->
        <section class="page-section text-secondary mb-0" id="message">
            <div class="container">
                <!-- Informations Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Résultat des attributions</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <p class="lead" style="text-align: justify">L\'attribution des <strong>logements</strong> s\'effectue selon le calendrier suivant :</p>
                        <ul class = "lead">
                            <li> Les inscriptions pour toutes les séries ouvrent le <strong>vendredi 14 juin à 18h</strong>. </li>
                            <li> La demande de logement pour la première série peut se faire à partir du <strong>lundi 17 juin à 18h</strong>. </li>
                            <li> Le premier tour des attributions pour la <strong> série 1 </strong> sera effectué le <strong>mardi 18 juin à 21h</strong>. </li>
                            <li> L\' algorithme d\'attribution est relancé tous les jours à <strong>12h</strong>.
                            <li> Pour les <strong> séries suivantes </strong>, le premier tour sera effectué le <strong> samedi 22 juin </strong> à <strong> 12h </strong> </li>
                        </ul>
                        
                        <p class="lead" style="text-align: justify">Si tu as des questions, des remarques, des demandes, n’hésite pas à nous contacter par mail ou téléphone !
                        <!-------
                        <br/> Télécharge le <strong>planning de la semaine </strong> et rejoins-nous aussi sur le <strong>groupe Facebook</strong> et la <strong> page Instagram </strong> dédiés aux admissibles passant leurs oraux aux Ponts!</p>

                        <div class="text-center mt-4">
                            <a class="btn btn-xl btn-primary" style="margin:1rem" href="assets/img/planning_S2.jpg" target="_blank" rel="noopener noreferrer"> Télécharges le planning de la semaine </a>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a class="btn btn-xl btn-primary" style="margin:1rem" href="https://www.facebook.com/groups/195943456308867/?ref=share" target="_blank" rel="noopener noreferrer"> Rejoins notre groupe Facebook <i class="fab fa-fw fa-facebook", style="font-size: 1.4em; vertical-align: middle;"></i> </a>
                        </div>

                        <div class="text-center mt-4">
                            <a class="btn btn-xl btn-primary" style="margin:1rem" href="https://instagram.com/admissibles.ponts" target="_blank" rel="noopener noreferrer"> Rejoins notre page Instagram <i class="fab fa-fw fa-instagram", style="font-size: 1.4em; vertical-align: middle;"></i> </a>
                        </div>
                        ----------->

                        

                    </div>
                </div>
            </div>
        </section>';?>


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
