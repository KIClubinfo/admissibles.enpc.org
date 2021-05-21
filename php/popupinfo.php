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
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal1Label">Info</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Text-->
                            <?php
                            if($_GET['info'] == "activation"){
                                echo '<h4 class="mb-5" style="color:grey;">Votre compte a bien été activé.<br/> <br/> Vous pouvez à présent vous connecter.</h4>';
                            }
                            else if($_GET['info'] == "alreadyactive"){
                                echo '<h4 class="mb-5" style="color:grey;">Votre compte a déjà été activé.<br/> <br/> Vous pouvez vous connecter.</h4>';
                            }
                            else{
                                echo '<h4 class="mb-5" style="color:grey;">Une erreur est survenue.</h4>';
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