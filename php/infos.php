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
                        <p class="lead" style="text-align: justify">La résidence est idéalement située à <strong> 100m </strong>de l'entrée de l'école. <br/>Elle est située à <strong>7min</strong> du <strong>RER A</strong> (arrêt <strong>Noisy-Champs</strong>).
            <br/> Elle est accessible par l\'Autoroute A4, sortie 10 - Cité Descartes.
            <br/> Elle est aussi accessible par le bus:     
                    <ul> 
                        <li>Bus RATP 213 : ligne Gare SNCF Chelles-Gournay / Lognes-le-village</li>
                        <li>Bus RATP 212 : ligne Pointe-de-Champs / Gare SNCF Emerainville </li>
                        <li>Bus CIF/VAS 100 : ligne Créteil l'Echat métro / Torcy RER - arrêt CROUS </li>
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
        <!-- Map Section-->
        <section class="page-section text-secondary mb-0">
            <div class="container">
                <!-- Informations Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Plan du campus</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="row justify-content-center">
                        <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="./assets/img/plan_ponts.jpeg"></iframe>
                        <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="./assets/img/plan_carnot.jpeg"></iframe>
                        
                </div>

            </div>
        </section>
        <!--Footer Information-->
        <?php
            include("footer_info.php");
        ?>
        <!-- Footer-->
        <?php
            include("footer.php");
        ?>
    </body>
</html>
