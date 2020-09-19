<?php
session_start();

$HOST = 'localhost';
$USER = 'root';
$PASS = '';
$DB_NAME = 'blossom';
$con = new mysqli("$HOST", "$USER", "$PASS", "$DB_NAME")or die(mysqli_errno());


?>
