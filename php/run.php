<?php
    include_once("config.php");
    if (!isset($_SESSION['loggedin'])) {
	    header('Location: connexion.php?erreur=notconnected');
	    exit();
    } 

    exec("ps aux | grep -i 'python3' | grep -v grep", $pids);
    if(empty($pids)) {
        $serie = $_GET['serie'];
        if ($stmt = $con->prepare('SELECT id_res FROM reservation WHERE reservation.date_arrivee IN (SELECT s.arrival_date FROM serie s WHERE s.id_serie = ? )')) {
            $stmt->bind_param('s',$serie);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
            	if(is_admin()){
            		$command = 'python3 /var/www/html/solver/refusal_heuristic.py';
                	exec('bash -c "exec nohup setsid python3 /var/www/html/solver/refusal_heuristic.py '.$serie.' > /dev/null 2>&1 &"');
            		header('Location: admin.php?table=run');
            	}
            	else{
            		$command = 'python3 /var/www/html/solver/refusal_heuristic.py';
                	exec('bash -c "exec nohup setsid python3 /var/www/html/solver/refusal_heuristic.py '.$serie.' > /dev/null 2>&1 &"');
            		header('Location: profile.php');	
            	}
            }
            else {
                $command = 'python3 /var/www/html/solver/heuristic.py';
                exec('bash -c "exec nohup setsid python3 /var/www/html/solver/heuristic.py '.$serie.' > /dev/null 2>&1 &"');
                if(is_admin()){
                	header('Location: admin.php?table=run');
                }
                else{
    			header('Location: profile.php');
    		}
        $stmt->close();
        $con->close();
    }
        }
    }
    if(is_admin()){
    	header('Location: admin.php?table=run');
    }
    else{
    	header('Location: profile.php');
    }
?>
