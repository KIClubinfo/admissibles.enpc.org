<?php
    include_once("config.php");
    if (!isset($_SESSION['loggedin'])) {
	    header('Location: connexion.php?erreur=notconnected');
	    exit();
    } 
    if (!is_admin()){
        header('Location: profil.php?erreur=interdit');
        exit();
    }
    // DIRECT OUTPUT
    function fancy_gender($g) {
        if ($g == 1) {
            return "F";
        }
        elseif ($g == 2) {
            return "H";
        }
        else {
            return "Autre/Ne souhaite pas préciser";
        }
    }
    
    function fancy_typo($t) {
        if ($t == 1) {
            return "Simple";
        }
        elseif ($t == 2) {
            return "Double";
        }
        else {
            return "Double";
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
                    <a class="btn btn-xl btn-primary" href="admin.php?table=Eleves">
                        Table des élèves
                    </a>
                    <a class="btn btn-xl btn-primary" href="admin.php?table=Reservations" style="margin:1rem">
                        Table des réservations
                    </a>
                    <a class="btn btn-xl btn-primary" href="admin.php?table=Demandes" >
                        Table des demandes
                    </a>
                    <a class="btn btn-xl btn-primary" href="admin.php?table=Chambres" style="margin:1rem">
                        Table des chambres
                    </a>
                    <a class="btn btn-xl btn-primary" href="admin.php?table=run" style="margin:1rem">
                        Répartition
                    </a>
                    <a class="btn btn-xl btn-primary" href="admin.php?table=export" style="margin:1rem">
                        Export CSV
                    </a>
                </div>
                <?php if ($_GET['table']=="run"){
                        exec("ps aux | grep -i 'python3' | grep -v grep", $pids);
                        if(empty($pids)) {
                            $series_finies = [];
                            echo '<hr>
                            <div style="text-align: center">';
                            for($i = 1; $i <= 4;$i++){
                                if ($stmt = $con->prepare("SELECT id_res FROM reservation WHERE reservation.date_arrivee IN (SELECT s.arrival_date FROM serie s WHERE s.id_serie = $i)")) {
                                    $stmt->execute();
                                    $stmt->store_result();
                                    if ($stmt->num_rows == 0) {
                                        echo "
                                        <a class=\"btn btn-xl btn-primary\" href=\"run.php?serie=$i\" style=\"margin:1rem\">
                                        Lancer Série $i
                                        </a>
                                        ";
                                    }
                                    else {
                                        $series_finies[] = (string) $i;
                                        echo "<div style='text-align:center; font-size:2rem;'>La répartition de la serie $i est terminée :</div>";
                                    	echo "<hr><div style='text-align: center'>
                                    	<a class=\"btn btn-xl btn-primary\" href=\"run.php?serie=$i\" style=\"margin:1rem\">
                                        Completer la série $i
                                    	</a>
                                        <a class=\"btn btn-xl btn-primary\" href=\"mail_confirmation.php?serie=$i\" style=\"margin:1rem\">
                                        Envoyer mails série $i
                                    	</a>
                                        </div><hr>";
                                    }
                                }
                            }
                            echo '</div>
                            <div style="text-align:center; font-size:2rem;"> Le calcul des séries '. implode(", ",$series_finies) .' a déjà été effectué.</div>
                            ';
                        } else {
                            echo '<div style="text-align:center; font-size:2rem;">La répartition est en cours de calcul...</div>';
                        }
                    }
                    else if ($_GET['table']=="export"){
                        echo '
                        <hr>
                        <div style="text-align: center"><a class="btn btn-xl btn-primary" href="export_csv.php?serie=1" style="margin:1rem">
                            Exporter Série 1
                        </a>
                        <a class="btn btn-xl btn-primary" href="export_csv.php?serie=2" style="margin:1rem">
                            Exporter Série 2
                        </a>
                        <a class="btn btn-xl btn-primary" href="export_csv.php?serie=3" style="margin:1rem">
                            Exporter Série 3
                        </a>
                        <a class="btn btn-xl btn-primary" href="export_csv.php?serie=4" style="margin:1rem">
                            Exporter Série 4
                        </a></div>
                        ';
                       }
                else {
                    echo '<table class="table">';
                    echo '<h1 class="text-center text-secondary" style="margin-bottom:2rem">';echo $_GET['table'];echo ' :</h1>';
                    if ($_GET['table']=="Eleves"){
                        echo '<thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Mail</th>
                                <th scope="col">Tel</th>
                                <th scope="col">Reservation</th>
                            </tr>
                        </thead>';

                        if ($stmt = $con->prepare('SELECT id, prenom, nom, mail, tel, a_reserve FROM eleves')) {
                            $stmt->execute();
                        }
                        else {
                            header('Location: connexion.php?erreur=querry_error');
                            exit();
                        } 
                        $stmt->bind_result($id, $prenom, $nom, $mail, $tel, $a_reserve);
                        while ($donnees = $stmt->fetch()) {
                            echo '
                            <tbody>
                                <tr>
                                    <th scope="row">';echo htmlspecialchars($id); echo '</th>
                                    <td>';echo htmlspecialchars($prenom); echo '</td>
                                    <td>';echo htmlspecialchars($nom); echo '</td>
                                    <td>';echo htmlspecialchars($mail); echo '</td>
                                    <td>';echo htmlspecialchars($tel); echo '</td>
                                    <td>';echo htmlspecialchars($a_reserve); echo '</td>
                                </tr>
                            </tbody>';
                        }
                    }
                    else if ($_GET['table']=="Reservations"){
                        echo '<thead>
                            <tr>
                                <th scope="col">id_res</th>
                                <th scope="col">id_eleves</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Mail</th>
                                <th scope="col">Numéro chambre</th>
                                <th scope="col">Date arrivée</th>
                                <th scope="col">Date départ</th>
                                <th scope="col">Modifier le statut</th>
                            </tr>
                        </thead>';

                        if ($stmt = $con->prepare('SELECT id_res, id_eleves, numero_chambre, date_arrivee, date_depart, prenom, nom, mail, paid FROM reservation JOIN eleves ON reservation.id_eleves = eleves.id')) {
                            $stmt->execute();
                        }
                        else {
                            header('Location: connexion.php?erreur=querry_error');
                            exit();
                        } 
                        $stmt->bind_result($id_res, $id_eleves, $numero_chambre, $date_arrivee, $date_depart, $prenom, $nom, $mail, $paid);
                        while ($donnees = $stmt->fetch()) {
                            if($paid==0){
                                $color = '#edc2c2';
                            }else{
                                $color = '#c9e6c9';
                            }
                            echo '
                            <tbody>
                                <tr style="background-color:'.$color.'">
                                    <th scope="row">';echo htmlspecialchars($id_res); echo '</th>
                                    <td>';echo htmlspecialchars($id_eleves); echo '</td>
                                    <td>';echo htmlspecialchars($prenom); echo '</td>
                                    <td>';echo htmlspecialchars($nom); echo '</td>
                                    <td>';echo htmlspecialchars($mail); echo '</td>
                                    <td>';echo htmlspecialchars($numero_chambre); echo '</td>
                                    <td>';echo htmlspecialchars($date_arrivee); echo '</td>
                                    <td>';echo htmlspecialchars($date_depart); echo '</td>
                                    <td>';echo '<a class="link-primary" style="color:black" href="cancel_reservation.php?type=0&res_id=' . htmlspecialchars($id_res) . '">Modifier</a>'; echo '</td>
                                </tr>
                            </tbody>';
                        }
                    }
                    else if ($_GET['table']=="Demandes"){
                        echo '<thead>
                            <tr>
                                <th scope="col">id_demande</th>
                                <th scope="col">id_eleve</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Remplace</th>
                                <th scope="col">Mate_Mail</th>
                                <th scope="col">Type chambre</th>
                                <th scope="col">Date arrivée</th>
                                <th scope="col">Heure arrivée</th>
                                <th scope="col">Date départ</th>
                                <th scope="col">Heure départ</th>
                                <th scope="col">Date demande</th>
                            </tr>
                        </thead>';

                        if ($stmt = $con->prepare('SELECT id_demande, id_eleve, prenom, nom, remplace, type_chambre, arrival_date, arrival_time, departure_date, departure_time, mate_email, demand_time FROM demande JOIN eleves ON demande.id_eleve = eleves.id')) {
                            $stmt->execute();
                        }
                        else {
                            header('Location: connexion.php?erreur=querry_error');
                            exit();
                        } 
                        $stmt->bind_result($id_demande, $id_eleve, $prenom, $nom, $remplace, $type_chambre, $arrival_date, $arrival_time, $departure_date, $departure_time, $mate_email, $demand_time);
                        while ($donnees = $stmt->fetch()) {
                            echo '
                            <tbody>
                                <tr>
                                    <th scope="row">';echo htmlspecialchars($id_demande); echo '</th>
                                    <td>';echo htmlspecialchars($id_eleve); echo '</td>
                                    <td>';echo htmlspecialchars($prenom); echo '</td>
                                    <td>';echo htmlspecialchars($nom); echo '</td>
                                    <td>';echo htmlspecialchars($remplace); echo '</td>
                                    <td>';echo htmlspecialchars($mate_email); echo '</td>
                                    <td>';echo htmlspecialchars($type_chambre); echo '</td>
                                    <td>';echo htmlspecialchars($arrival_date); echo '</td>
                                    <td>';echo htmlspecialchars($arrival_time); echo '</td>
                                    <td>';echo htmlspecialchars($departure_date); echo '</td>
                                    <td>';echo htmlspecialchars($departure_time); echo '</td>
                                    <td>';echo htmlspecialchars($demand_time); echo '</td>
                                </tr>
                            </tbody>';
                        }
                    }
                    else if ($_GET['table']=="Chambres"){
                        echo '<thead>
                            <tr>
                                <th scope="col">Numéro de la chambre</th>
                                <th scope="col">Type</th>
                            </tr>
                        </thead>';

                        if ($stmt = $con->prepare('SELECT numero,type FROM chambre')) {
                            $stmt->execute();
                        }
                        else {
                            header('Location: connexion.php?erreur=querry_error');
                            exit();
                        } 
                        $stmt->bind_result($numero,$type);
                        while ($donnees = $stmt->fetch()) {
                            echo '
                            <tbody>
                                <tr>
                                    <th scope="row">';echo htmlspecialchars($numero); echo '</th>
                                    <td>';echo htmlspecialchars(fancy_typo($type)); echo '</td>
                                </tr>
                            </tbody>';
                        }
                    }
                echo '</table>';
                }
                ?>  
        </section>
        <!--Footer Information-->
        <?php
            include("footer_info.php");
            include("footer.php");
        ?>
        <script src="js/demo.js"></script>
    </body>
</html>
