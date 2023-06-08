<?php
    include("config.php");
    if (!isset($_SESSION['loggedin'])) {
	    header('Location: connexion.php');
	    exit();
    }
    if(protect($debut_demande)){
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
                                        <label for='Type-choice'>Type de chambre souhaité</label>
                                        <select class="form-control" id="Type-choice" name="Type-choice" required="required" data-validation-required-message="Veuillez choisir un type de Chambre.">
                                            <option value="" disabled selected="selected">Choisir un type de chambre</option>
                                            <option value= "1">Simple</option>
                                            <!--<option value= "2">Binômée</option>-->
                                            <option value= "3">Double</option>
                                        </select>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label for='replace-choice'>Si ce type de chambre ne pouvait pas vous être attribué, souhaiteriez-vous tout de même une chambre d'un autre type ?</label>
                                        <select class="form-control" id="replace-choice" name="replace-choice"required="required" data-validation-required-message="Veuillez choisir une option.">
                                            <option value="" disabled selected="selected">Choisir une option</option>
                                            <option value="1">Oui</option>
                                            <option value="0">Non</option>
                                        </select>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label for='gender-choice'>Si tu te retrouvait dans une chambre à deux places, cela te dérangerait d'être avec :</label>
                                        <select class="form-control" id="gender-choice" name="gender-choice" required="required" data-validation-required-message="Veuillez choisir une option.">
                                            <option value="" disabled selected="selected">Choisir une option</option>
                                            <option value="3">indifférent</option>
                                            <option value="1">une femme</option>
                                            <option value="2">un homme</option>
                                        </select>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label for='gender-choice'>Ta série d'épreuves orales :</label>
                                        <select class="form-control" id="serie-choice" name="serie-choice" onchange="dateSelector(this.selectedIndex);" required="required" data-validation-required-message="Veuillez choisir une option.">
                                            <option value="" disabled selected="selected">Choisir une série</option>
                                            <option value="1">série n°1</option>
                                            <option value="2">série n°2</option>
                                            <option value="3">série n°3</option>
                                            <option value="4">série n°4</option>
                                        </select>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>

                                <script>
                                    // constant to modify for arrival and departure dates with format [output_format, display_format]
                                    let arrival_dates = ['2023-06-18,Dimanche 18 juin 2023', 
                                                         '2023-06-25,Dimanche 25 juin 2023', 
                                                         '2023-07-02,Dimanche 2 juillet 2023', 
                                                         '2023-07-09,Dimanche 09 juillet 2023'];

                                    let departure_dates = ['2023-06-24,Samedi 24 juin 2023', 
                                                           '2023-07-01,Samedi 1 juillet 2023', 
                                                           '2023-07-08,Samedi 8 juillet 2023', 
                                                           '2023-07-15,Samedi 15 juillet 2023'];


                                    function dateSelector(option_idx) {
                                        if (option_idx-1 >= 0 && option_idx-1 < arrival_dates.length) {
                                            arrival_data = arrival_dates[option_idx-1].split(",");
                                            departure_data = departure_dates[option_idx-1].split(",");

                                            document.getElementById("arrival-date-display").textContent= arrival_data[1];
                                            document.getElementById("arrival-date").value=arrival_data[0];

                                            document.getElementById("departure-date-display").textContent= departure_data[1];
                                            document.getElementById("departure-date").value=departure_data[0];
                                        }
                                    }
                                </script>

                                <div class="control-group">
                                    <div class="form-group">
                                        <label for="arrival-date">Date de début de réservation :</label>
                                        <input id="arrival-date" name="arrival-date" hidden/>
                                        <br>
                                        <span class="form-control" id="arrival-date-display">  </span>
                                        <br>                                  
                                        <div class="text"><p><strong>À noter : </strong> Il est possible d'arriver dans le logement après cette date.</p></div>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <label for="arrival-date">Heure d'arrivée approximative (entre 11h00 et 18h30) :</label>
                                        <input class="form-control" id="arrival-time" name="arrival-time" min="11:00" max="18:30" type="time" placeholder="Heure d'arrivée" required="required" data-validation-required-message="Veuillez entrer une heure d'arrivée correcte." step="60"/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group" >
                                    <div class="form-group">
                                        <label for="departure-date">Date de fin de réservation :</label>
                                        <input id="departure-date" name="departure-date" hidden/>
                                        <br>
                                        <span class="form-control" id="departure-date-display">  </span>
                                        <br>
                                        <div class="text"><p><strong>À noter : </strong> Il est possible de quitter le logement avant cette date.</p></div>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group" style="Display : None">
                                    <div class="form-group">
                                        <label for="departure-time">Heure de départ :</label>
                                        <input class="form-control" id="departure-time" name="departure-time" type="time" placeholder="Heure de départ" required="required" data-validation-required-message="Veuillez entrer une date de départ." step="60" value="18:00"/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group"  style="Display : None" id="mate-choice-block">
                                    <div class="form-group">
                                        <label for="mate-choice">Souhaites-tu être avec une personne en particulier ?</label>
                                        <select class="form-control" id="mate-choice" name="mate-choice" data-validation-required-message="Veuillez choisir une option.">
                                            <option value="" selected="selected" disabled>Choisir une option</option>
                                            <option value="0">Non</option>
                                            <option value="1">Oui</option>
                                        </select>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group hidden" style="Display : None" id="mate-email-block">
                                    <div class="form-group">
                                        <label for="mate-email">Adresse mail de la personne souhaitée (ATTENTION : celle utilisée pour l'inscription)</label>
                                        <input class="form-control" id="mate-email" name="mate-email" type="email" placeholder="email" data-validation-required-message="Veuillez entrer l'email de la personne avec qui vous souhaitez être." />
                                        <p class="help-block text-danger"></p>
                                    </div>  
                                </div>
                                <div class="control-group">
                                    <div class="form-group">
                                        <div>
                                            <input type="checkbox" id="engagement" name="engagement" required="required"> &nbsp J'atteste sur l'honeur que ma réservation est en accord avec la série qui m'a été attribuée par le CCMP. </input>
                                        </div>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <br />
                                <div id="success"></div>
                                <div class="form-group text-center">
                                <?php if($_SESSION['a_reserve']){echo '
                                        <div class="text-center" style="font-size: 1.2em"><p><strong style="color: red">Avertissement : </strong> en modifiant votre demande, vous perdrez votre position dans la file d\'attente !</p></div>
                                        <button class="btn btn-outline-light btn-xl" id="sendInscriptionButton" type="submit">Modifier ma demande</button>'
                                    ;}
                                    else{echo'
                                        <div class="text-center" style="font-size: 1.2em"><p><strong style="color: red">Avertissement : </strong> après validation, toute modification ultérieure de la demande entraînera une perte de la position dans la file d\'attente.</p></div>
                                        <button class="btn btn-outline-light btn-xl" id="sendInscriptionButton" type="submit">Effectuer ma demande</button>'
                                    ;}?>
                                </div>
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
                    // Binomée or double
                    document.getElementById("mate-choice-block").style.display = "block";
                    document.getElementById("mate-choice-block").setAttribute(required, "required");
                }
                else {
                    // Simple
                    document.getElementById("mate-choice").selectedIndex = 1;
                    document.getElementById("mate-email-block").style.display = "none";
                    document.getElementById("mate-choice-block").style.display = "none";
                    document.getElementById("mate-choice-block").removeAttribute(required);
                    document.getElementById("mate-email-block").removeAttribute(required);

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
        <script src="js/demo.js"></script>
    </body>
</html>
