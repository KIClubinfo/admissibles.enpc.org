<?php
$command = 'python3 /var/www/html/solver/heuristic.py';

$result = shell_exec($command);

echo $result;

?>
