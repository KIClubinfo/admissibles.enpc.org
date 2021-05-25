<div class="portfolio-modal modal fade" style="margin-top:15vh;" id="portfolioModal1" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title-->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal1Label">Erreur</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Text-->
                            <?php
                            if($_GET['erreur'] == 1){
                                echo '<h4 class="mb-5" style="color:grey;">Email et/ou mot de passe incorrect.<br/> <br/> Veuillez réessayer.</h4>';
                            }
                            else if($_GET['erreur'] == 2){
                                echo '<h4 class="mb-5" style="color:grey;">Votre compte n\'est pas activé.<br/> <br/>Suivez le lien reçu par mail pour l\'activer.</h4>';
                            }
                            else if($_GET['erreur'] == "bdderror"){
                                echo '<h4 class="mb-5" style="color:grey;">Erreur de connexion à la base de donnée.<br/> <br/>Contactez l\'administration du site.</h4>';
                            }
                            else if($_GET['erreur'] == "form"){
                                echo '<h4 class="mb-5" style="color:grey;">Merci de compléter le formulaire d\'inscription.</h4>';
                            }
                            else if($_GET['erreur'] == "password"){
                                echo '<h4 class="mb-5" style="color:grey;">Les mots de passe ne correspondent pas.</h4>';
                            }
                            else if($_GET['erreur'] == "prenom"){
                                echo '<h4 class="mb-5" style="color:grey;">Prénom incorrect.<br/> <br/>Merci de ne pas utiliser de caractères spéciaux (sauf accents).</h4>';
                            }
                            else if($_GET['erreur'] == "nom"){
                                echo '<h4 class="mb-5" style="color:grey;">Nom incorrect.<br/> <br/>Merci de ne pas utiliser de caractères spéciaux (sauf accents).</h4>';
                            }
                            else if($_GET['erreur'] == "mail"){
                                echo '<h4 class="mb-5" style="color:grey;">Adresse email incorrecte.</h4>';
                            }
                            else if($_GET['erreur'] == "phone"){
                                echo '<h4 class="mb-5" style="color:grey;">Numéro de téléphone incorrect.</h4>';
                            }
                            else if($_GET['erreur'] == "distance"){
                                echo '<h4 class="mb-5" style="color:grey;">Distance incorrecte.</h4>';
                            }
                            else if($_GET['erreur'] == "boursier"){
                                echo '<h4 class="mb-5" style="color:grey;">Une erreur est survenue à la question "Êtes vous boursier?". Veuillez réessayer.</h4>';
                            }
                            else if($_GET['erreur'] == "mailexist"){
                                echo '<h4 class="mb-5" style="color:grey;">Cet email est déjà utilisé.</h4>';
                            }
                            else if($_GET['erreur'] == "choice-form"){
                                echo '<h4 class="mb-5" style="color:grey;">Merci de compléter le formulaire de demande.</h4>';
                            }
                            else if($_GET['erreur'] == "choice-mail"){
                                echo '<h4 class="mb-5" style="color:grey;">L\'adresse mail de la personne avec vous souhaitez être est incorrecte.</h4>';
                            }
                            else if($_GET['erreur'] == "mate"){
                                echo '<h4 class="mb-5" style="color:grey;">Vous ne pouvez pas être deux dans une chambre simple.</h4>';
                            }
                            else if($_GET['erreur'] == "choice-gender"){
                                echo '<h4 class="mb-5" style="color:grey;">Une erreur est survenue à la question "Si vous étiez dans une chambre à deux places, cela vous dérangerait-il d\'être avec :". Veuillez réessayer.</h4>';
                            }
                            else if($_GET['erreur'] == "choice-type"){
                                echo '<h4 class="mb-5" style="color:grey;">Une erreur est survenue à la question "Type de Chambre souhaitée". Veuillez réessayer.</h4>';
                            }
                            else if($_GET['erreur'] == "choice-replace"){
                                echo '<h4 class="mb-5" style="color:grey;">Une erreur est survenue à la question "Si ce type de chambre ne pouvait pas vous être attribuée, souhaiteriez-vous tout de même une chambre d\'un autre type?". Veuillez réessayer.</h4>';
                            }
                            else if($_GET['erreur'] == "arrival-date"){
                                echo '<h4 class="mb-5" style="color:grey;">La date d\'arrivée est incorrecte</h4>';
                            }
                            else if($_GET['erreur'] == "departure-date"){
                                echo '<h4 class="mb-5" style="color:grey;">La date de départ est incorrecte</h4>';
                            }
                            else if($_GET['erreur'] == "arrival-time"){
                                echo '<h4 class="mb-5" style="color:grey;">L\'heure d\'arrivée est incorrecte</h4>';
                            }
                            else if($_GET['erreur'] == "departure-time"){
                                echo '<h4 class="mb-5" style="color:grey;">L\'heure de départ est incorrecte</h4>';
                            }
                            else{
                                echo '<h4 class="mb-5" style="color:grey;">Une erreur inconnue est survenue.</h4>';
                            }
                            ?>
                            <button class="btn btn-primary" data-dismiss="modal">
                                <i class="fas fa-times fa-fw"></i>
                                Fermer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>