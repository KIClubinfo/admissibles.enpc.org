<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
	    header('Location: connexion.php');
	    exit();
    }
    if(!$_SESSION['a_reserve']){
        header('Location: profil.php');
	    exit();
    }

if(isset($_GET['cancel'])){
    if($_GET['cancel']){
        $db_password = $_ENV["mysql_password"];
        $con = new mysqli('db', 'admissibles_user', $db_password, 'admissibles');
        if ($con->connect_error) {
            die('Erreur lors de la connexion à la base de donnée: ' . $con->connect_error);
        }
        if ($stmt = $con->prepare('SELECT * FROM eleves WHERE id = ?')){
            $stmt->bind_param('i', $_SESSION['id']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                if ($stmt = $con->prepare('UPDATE eleves SET a_reserve=0 WHERE id=?')) {
                    $stmt->bind_param('i', $_SESSION['id']);
                    $stmt->execute();
                }
            }
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
            }
        }
        $stmt->close();
        $con->close();
        header('Location: profil.php');
	    exit();
    }
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
    </body>
</html>
