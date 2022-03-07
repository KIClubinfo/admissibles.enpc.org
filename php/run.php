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

    exec("ps aux | grep -i 'python3' | grep -v grep", $pids);
    if(empty($pids)) {
        if ($stmt = $con->prepare('SELECT id_res FROM reservation')) {
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                header('Location: admin.php?table=run');
            }
            else {
                $command = 'python3 /var/www/html/solver/heuristic.py';
                exec('bash -c "exec nohup setsid python3 /var/www/html/solver/heuristic.py > /dev/null 2>&1 &"');
                header('Location: admin.php?table=run');
            }
        }
    }
    header('Location: admin.php?table=run');
?>
