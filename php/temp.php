<?php
    //This page is to be used only while there is no mailer//
    session_start();
    if (isset($_SESSION['loggedin'])) {
	    header('Location: profil.php');
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
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Masthead Heading-->
                <h1 class="masthead-heading text-uppercase mb-0">Activation du compte</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            </div>
        </header>
        <section class="page-section text-secondary mb-0" id="about">
            <div class="container">
                <div class="">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h4 class="text-secondary text-center" style="text-decoration:underline;">
                            <?php
                            if (isset($_GET['email'], $_GET['code'])){
                                echo "Copiez ce lien dans votre navigateur pour activer votre compte:</br></br>";
                                echo "localhost:8123/activate.php?email="; echo $_GET['email']; echo '&code='; echo $_GET['code'];
                            }
                            else{
                                echo 'Erreur d\'activation.';
                            }
                            ?>
                            </h4>
                        </div>
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
