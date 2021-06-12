<?php
    include("config.php");
    if (isset($_SESSION['loggedin'])) {
	    header('Location: profil.php');
	    exit();
    }
    
    if (isset($_GET['email'], $_GET['code'])) {
        $safemail=sanitize_string($_GET['email']);
        $safecode=sanitize_string($_GET['code']);
        if($_GET['code']=='no'){
            header('Location: connexion.php?erreur=');
            exit();
        }
        if ($stmt = $con->prepare('SELECT * FROM eleves WHERE mail = ? AND change_password = ?')) {
            $stmt->bind_param('ss', $safemail, $safecode);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $_SESSION['email']=$_GET['email'];
                $_SESSION['code']=$_GET['code'];
            }
            else{
                header('Location: connexion.php');
	            exit();
            }
        }
        else{
            header('Location: connexion.php');
            exit();
        }
    }
    else{
        header('Location: connexion.php');
        exit();
    }
    $con->close();
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        include("head.php");
        include("navbar.php");
    ?>
    <?php
        include("navbar.php");
        if (isset($_GET['erreur'])){
            include("popupErreur.php");
        }
        if(isset($_GET['info'])){
            include("popupinfo.php");
        }
    ?>
    <body id="page-top">
        <!-- Navigation-->
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
                <h1 class="masthead-heading text-uppercase mb-0">Changer le mot de passe</h1>
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
                            <form id="inscriptionForm" name="changepassword" action="changepassword3.php" method="post" autocomplete="off">
                                <div class="control-group">
                                    <div class="form-group">
                                        <label>Nouveau mot de passe</label>
                                        <input class="form-control" id="password" name="password" type="password" placeholder="Mot de passe" required="required" data-validation-required-message="Veuillez entrer un mot de passe." />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label>Confirmer le nouveau mot de passe</label>
                                        <input class="form-control" id="confpassword" name="confpassword" type="password" placeholder="Confirmer le mot de passe" required="required" data-validation-required-message="Veuillez confirmer votre mot de passe." />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <br />
                                <div id="success"></div>
                                <div class="form-group text-center"><button class="btn btn-outline-light btn-xl" id="sendInscriptionButton" type="submit">Valider</button></div>
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
