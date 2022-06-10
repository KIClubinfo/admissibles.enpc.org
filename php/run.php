<?php
    include_once("config.php");
    if (!isset($_SESSION['loggedin'])) {
	    header('Location: connexion.php?erreur=notconnected');
	    exit();
    } 

    exec("ps aux | grep -i 'python3' | grep -v grep", $pids);
    if(empty($pids)) {
        if ($stmt = $con->prepare('SELECT id_res FROM reservation')) {
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
            	if(is_admin()){
            		$command = 'python3 /var/www/html/solver/refusal_heuristic.py';
                	exec('bash -c "exec nohup setsid python3 /var/www/html/solver/refusal_heuristic.py > /dev/null 2>&1 &"');
            		header('Location: admin.php?table=run');
            	}
            	else{
            		$command = 'python3 /var/www/html/solver/refusal_heuristic.py';
                	exec('bash -c "exec nohup setsid python3 /var/www/html/solver/refusal_heuristic.py > /dev/null 2>&1 &"');
            		header('Location: profile.php');    	
            	}
                
            }
            else {
                $command = 'python3 /var/www/html/solver/heuristic.py';
                exec('bash -c "exec nohup setsid python3 /var/www/html/solver/heuristic.py > /dev/null 2>&1 &"');
                if(is_admin()){
                	header('Location: admin.php?table=run');
                }
                else{
    			header('Location: profile.php');
    		}
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
