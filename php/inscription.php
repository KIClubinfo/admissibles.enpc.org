<?php
    include("config.php");
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
            if(isset($_GET['info'])){
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
                <h1 class="masthead-heading text-uppercase mb-0">Inscription</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <?php
                if(protect($debut_inscription)){
                    echo '<div class="container text-left">
                    <div class="row justify-content-center" style="margin-top:3em">
                    <div class="col-lg-8">
                        <h6 style="text-align: center"></br><strong>Vous pourrez vous inscrire à partir du ';echo $debut_inscription->format('d-m-Y H:i:s');echo'</strong></h6>
                    </div>
                    </div>
                    </div>';
                }
                else{
                        echo'
                <div class="container text-left">
                    <!-- Inscription Section Form-->
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <form id="inscriptionForm" name="inscription" action="validate.php" method="post" autocomplete="off">
                                <div class="control-group">
                                    <div class="form-group">
                                        <label>Prénom</label>
                                        <input class="form-control" id="prenom" name="prenom" type="text" placeholder="Prénom" required="required" data-validation-required-message="Veuillez entrer votre prénom." />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input class="form-control" id="nom" name="nom" type="text" placeholder="Nom" required="required" data-validation-required-message="Veuillez entrer votre nom." />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label>Je suis</label>
                                        <select class="form-control" id="gender" name="gender" required="required" data-validation-required-message="Veuillez choisir une option.">
                                            <option value="" disabled>Choisir une option</option>
                                            <option value="1">Une femme</option>
                                            <option value="2">Un homme</option>
                                            <option value="3">Autre ou ne souhaite pas préciser</option>
                                        </select>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" id="email" name="email" type="email" placeholder="Email" required="required" data-validation-required-message="Veuillez entrer votre mail." />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label>Numéro de téléphone</label>
                                        <input class="form-control" id="tel" name="tel" type="tel" placeholder="Numéro de téléphone" required="required" data-validation-required-message="Veuillez entrer votre numéro de téléphone." />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label>Distance avec Champs-sur-Marne (il pourra vous être demandé de le justifier)</label>
                                        <input class="form-control" id="distance" name="distance" type="number" min="0" placeholder="Distance (en km)" required="required" data-validation-required-message="Veuillez entrer la distance entre votre domicile et Champs-sur-Marne." />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Êtes-vous boursier? (il pourra vous être demandé de le justifier)</label>
                                    <select class="form-control" id="boursier" name="boursier" data-validation-required-message="Veuillez indiquer si vous êtes boursier.">
                                        <option value="" disabled>Choisir une option</option>
                                        <option value="0">Non</option>
                                        <option value="1">Oui</option>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label>Mot de passe</label>
                                        <input class="form-control" id="password" name="password" type="password" placeholder="Mot de passe" required="required" data-validation-required-message="Veuillez entrer un mot de passe." />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label>Confirmer le mot de passe</label>
                                        <input class="form-control" id="confpassword" name="confpassword" type="password" placeholder="Confirmer le mot de passe" required="required" data-validation-required-message="Veuillez confirmer votre mot de passe." />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <br />
                                <div id="success"></div>
                                <div class="form-group text-center"><button class="btn btn-outline-light btn-xl" id="sendInscriptionButton" type="submit">S\'inscrire</button></div>
                            </form>
                        </div>
                    </div>
                </div>';}?>
            </div>
        </header>
        <?php
            include("footer.php");
        ?>
        <script src="js/demo.js"></script>
    </body>
</html>
