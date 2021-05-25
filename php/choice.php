<?php
    include("config.php");
    if (!isset($_SESSION['loggedin'])) {
	    header('Location: connexion.php');
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
                <h1 class="masthead-heading text-uppercase mb-0">Choix de la chambre</h1>
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
                            <form id="choiceForm" name="choice" action="validate_choice.php" method="post" autocomplete="off">
                                <div class="control-group">
                                    <div class="form-group">
                                        <label for='Type-choice'>Type de Chambre souhaitée</label>
                                        <select class="form-control" id="Type-choice" name="Type-choice" required="required" data-validation-required-message="Veuillez choisir un type de Chambre.">
                                            <option value="" disabled>Choisir un type de chambre</option>
                                            <option value= "1">Simple</option>
                                            <option value= "2">Binômée</option>
                                            <option value= "3">Double</option>
                                        </select>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label for='replace-choice'>Si ce type de chambre ne pouvait pas vous être attribuée, souhaiteriez-vous tout de même une chambre d'un autre type?</label>
                                        <select class="form-control" id="replace-choice" name="replace-choice"required="required" data-validation-required-message="Veuillez choisir une option.">
                                            <option value="" disabled>Choisir une option</option>
                                            <option value="1">Oui</option>
                                            <option value="0">Non</option>
                                        </select>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label for='replace-choice'>Si vous étiez dans une chambre à deux places, cela vous dérangerait-il d'être avec:</label>
                                        <select class="form-control" id="gender-choice" name="gender-choice" required="required" data-validation-required-message="Veuillez choisir une option.">
                                            <option value="" disabled>Choisir une option</option>
                                            <option value="3">indifférent</option>
                                            <option value="1">une femme</option>
                                            <option value="2">un homme</option>
                                        </select>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label for="arrival-date">Date d'arrivée</label>
                                        <input class="form-control" id="arrival-date" name="arrival-date" type="date" placeholder="Date d'arrivée" required="required" data-validation-required-message="Veuillez entrer une date d'arrivée." />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label for="arrival-date">Heure d'arrivée</label>
                                        <input class="form-control" id="arrival-time" name="arrival-time" type="time" placeholder="Heure d'arrivée" required="required" data-validation-required-message="Veuillez entrer une date d'arrivée." step="60"/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label>Date de départ</label>
                                        <input class="form-control" id="departure-date" name="departure-date" type="date" placeholder="Date de départ" required="required" data-validation-required-message="Veuillez entrer une date de départ." />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label>Heure de départ</label>
                                        <input class="form-control" id="departure-time" name="departure-time" type="time" placeholder="Heure de départ" required="required" data-validation-required-message="Veuillez entrer une date de départ." step="60"/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group"  style="Display : None" id="mate-choice-block">
                                    <div class="form-group">
                                        <label>Souhaitez-vous être avec une personne en particulier?</label>
                                        <select class="form-control" id="mate-choice" name="mate-choice" data-validation-required-message="Veuillez choisir une option.">
                                            <option value="" disabled>Choisir une option</option>
                                            <option value="0">Non</option>
                                            <option value="1">Oui</option>
                                        </select>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group" style="Display : None" id="mate-email-block">
                                    <div class="form-group">
                                        <label>Adresse mail de la personne souhaitée (ATTENTION: celle utilisée pour l'inscription)</label>
                                        <input class="form-control" id="mate-email" name="mate-email" type="mail" placeholder="email" data-validation-required-message="Veuillez entrer l'email de la personne avec qui vous souhaitez être." />
                                        <p class="help-block text-danger"></p>
                                    </div>  
                                </div>
                                <br />
                                <div id="success"></div>
                                <div class="form-group text-center"><button class="btn btn-outline-light btn-xl" id="sendInscriptionButton" type="submit">
                                <?php if($_SESSION['a_reserve']){
                                    echo 'Modifier ma demande';}
                                    else{
                                        echo 'Effectuer ma demande';}?>
                                </button></div>
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

        <script>

            document.getElementById("Type-choice").addEventListener("change", (event) => {
                if (event.target.value === "2" || event.target.value === "3") {
                    document.getElementById("mate-choice-block").style.display = "block";
                    document.getElementById("mate-choice-block").setAttribute(required, "required");
                }
                else {
                    document.getElementById("mate-choice-block").style.display = "none";
                    document.getElementById("mate-choice-block").removeAttribute(required);
                }
            });
            
            document.getElementById("mate-choice").addEventListener("change", (event) => {
                if (event.target.value === "1") {
                    document.getElementById("mate-email-block").style.display = "block";
                    document.getElementById("mate-email-block").setAttribute(required, "required");
                }
                else {
                    document.getElementById("mate-email-block").style.display = "none";
                    document.getElementById("mate-email-block").removeAttribute(required);
                }
            });
        </script>
    </body>
</html>
