<?php
//******Only while there is no mailer******//
if (isset($_GET['email'], $_GET['code'])){
    echo '<a href="localhost:8123/activate.php?email='.$_GET['email'].'&code='.$_GET['code'].'">Clique ici pour activer ton compte</a>';
}
//*****************************************//
?>