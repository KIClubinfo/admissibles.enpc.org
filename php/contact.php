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
        <!-- Contact Section-->
        <section style="margin-top: 5%;" class="page-section text-secondary mb-0" id="about">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary">Contact</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Content-->
                
                <h5 class="text-center" style="text-decoration:underline; text-align: justify; margin-bottom:2rem; line-height:2rem;">Vous trouverez ci-dessous des contacts pour vous renseigner en cas de problème</h5>
                <div class="row justify-content-center" style="margin-bottom:2rem;">
                    <div class="col-lg-8">
                        <p class="lead" style="text-align: justify;"><strong>Pour des problèmes concernant le logement :</strong> </br>Vous pouvez contacter Gaël Foubert, membre du Bureau Des Élèves en charge du logement à la résidence Meunier.</br></p>

                        <p class="lead" style="text-align: center"><?php if (isset($_SESSION['loggedin'])){echo '<strong>+33 6 47 36 53 65</strong></br>';}?><strong>admissibles@enpc.org</strong></p>
                    </div>
                </div>
                <?php if (isset($_SESSION['loggedin'])){echo '
                <div class="row justify-content-center" style="margin-bottom:2rem;">
                    <div class="col-lg-8">
                        <p class="lead" style="text-align: justify"><strong>Pour des questions ne concernant pas le logement ou si Gaël Foubert est injoignable :</strong></br>Vous pouvez contacter Romane Cavadini, présidente du Bureau Des Élèves.</p>

                        <p class="lead" style="text-align: center"><strong>+33 7 68 45 70 38</strong></p>

                    </div>
                </div>';}?>
                <!--<div class="row justify-content-center">
                    <div class="col-lg-8">
                        <p class="lead" style="text-align: justify"><strong>Pour des problèmes concernant ce site internet :</strong></br>Vous pouvez contacter le Club Informatique de l'École des Ponts.</p>
                        <p class="lead" style="text-align: center"><strong>admissibles@enpc.org</strong></p>
                    </div>
                </div>-->
        </section>
        <!--Footer Information-->
        <?php
            include("footer_info.php");
            include("footer.php");
        ?>
        <script src="js/demo.js"></script>
    </body>
</html>
