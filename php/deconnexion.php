<?php
include("config.php");
session_destroy();
header('Location: connexion.php');
?>