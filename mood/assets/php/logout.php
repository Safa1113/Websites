<?php session_start(); ?>
<?php

session_destroy();

require_once 'include/DB_Functions.php';




header ("Location: ../../login.php");
?>