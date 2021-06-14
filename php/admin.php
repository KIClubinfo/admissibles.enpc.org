<?php
    include("config.php");
    if (!isset($_SESSION['loggedin'])) {
	    header('Location: connexion.php?erreur=notconnected');
	    exit();
    } 
    if (!is_admin()){
        header('Location: profil.php?erreur=interdit');
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
        <!-- Admin Section-->
        <section style="margin-top: 5%;" class="page-section text-secondary mb-0" id="about">
            <div class="container">
                <!-- Admin Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary">ADMIN</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Admin Section Content-->
                <div class="text-center mt-4" style="margin-bottom:2rem">
                    <a class="btn btn-xl btn-primary" href="">
                        Table des élèves
                    </a>
                    <a class="btn btn-xl btn-primary" href="" style="margin:1rem">
                        Table des réservations
                    </a>
                    <a class="btn btn-xl btn-primary" href="" >
                        Table des demandes
                    </a>
                    <a class="btn btn-xl btn-primary" href="" style="margin:1rem">
                        Table des chambres
                    </a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Mail</th>
                            <th scope="col">Tel</th>
                            <th scope="col">Reservation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                    </tbody>
                </table>
        </section>
        <!--Footer Information-->
        <?php
            include("footer_info.php");
            include("footer.php");
        ?>
        <script src="js/demo.js"></script>
    </body>
</html>
