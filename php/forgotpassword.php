<?php
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
        
            if (isset($_GET['erreur'])){
                include("popupErreur.php");
            }
            else if(isset($_GET['info'])){
                include("popupinfo.php");
            }
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
                <h1 class="masthead-heading text-uppercase mb-0">Mot de passe oublié</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="container text-left">
                    <!-- Inscription Section Form-->
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <form id="inscriptionForm" name="changepass" action="changepassword1.php" method="post">
                                <div class="control-group">
                                    <div class="form-group">
                                        <label for="username">
					                        <i class="fas fa-user"></i>
				                        </label>
                                        <input class="form-control" id="email" name="email" type="email" placeholder="Email" required="required" data-validation-required-message="Veuillez entrer votre mail." />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <br />
                                <div id="success"></div>
                                <div class="form-group text-center"><button class="btn btn-outline-light btn-xl" id="sendInscriptionButton" type="submit">Demander un nouveau mot de passe</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--Footer Information-->
        <?php
            include("footer_info.php");
            include("footer.php");
        ?>
        <script src="js/demo.js"></script>
    </body>
</html>
