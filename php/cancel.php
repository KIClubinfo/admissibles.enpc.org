<?php
    include("config.php");
    if (!isset($_SESSION['loggedin'])) {
	    header('Location: connexion.php');
	    exit();
    }
    if(!$_SESSION['a_reserve']){
        header('Location: profil.php');
	    exit();
    }

if(isset($_SESSION['cancel'])){
    if($_SESSION['cancel']!=0 && $_SESSION['cancel']!=1){
        header('Location: profil.php');
	    exit();
    }
    if($_SESSION['cancel']){
        if ($stmt = $con->prepare('SELECT * FROM eleves WHERE id = ?')){
            $stmt->bind_param('i', $_SESSION['id']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                if ($stmt = $con->prepare('UPDATE eleves SET a_reserve=0 WHERE id=?')) {
                    $stmt->bind_param('i', $_SESSION['id']);
                    $stmt->execute();
                }
                else {
                    header('Location: connexion.php?erreur=querry_error');
                    exit();
                } 
            }
            else {
                header('Location: connexion.php?erreur=unknown_error');
                exit();
            } 
        }
        else {
            header('Location: connexion.php?erreur=querry_error');
            exit();
        } 
        $_SESSION['a_reserve']=0;
        $stmt->close();
        if ($stmt = $con->prepare('SELECT * FROM demande WHERE id_eleve = ?')){
            $stmt->bind_param('i', $_SESSION['id']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                if ($stmt = $con->prepare('DELETE FROM demande WHERE id_eleve=?')) {
                    $stmt->bind_param('i', $_SESSION['id']);
                    $stmt->execute();
                }
                else {
                    header('Location: connexion.php?erreur=querry_error');
                    exit();
                } 
            }
            else {
                header('Location: connexion.php?erreur=unknown_error');
                exit();
            } 
        }
        else {
            header('Location: connexion.php?erreur=querry_error');
            exit();
        } 
        $stmt->close();
        $con->close();
        $_SESSION['cancel']=0;
        header('Location: profil.php');
	    exit();
    }
}
$_SESSION['cancel']=1;
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
                <h1 class="masthead-heading text-uppercase mb-0">Annulation de ma demande</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0"></p>
            </div>
        </header>
        <!-- Profil Section-->
        <section class="page-section text-secondary mb-0" id="about">
            <div class="container">
                <div class="">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h3 style="text-align: center">Voulez-vous vraiment annuler votre demande ? </br> Cette action sera irréversible.</h3>
                            <h4 style="text-align: center">En particulier, si vous refaites une demande, vous perdrez votre place dans la file d'attente.</h4>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-danger" href="cancel.php?cancel=1">
                        Annuler ma demande
                    </a>
                </div>   
            </div>
        </section>
        <!--Footer Information-->
        <?php
            include("footer_info.php");
            include("footer.php");
        ?>
        <script src="js/demo.js"></script>
    </body>
</html>
