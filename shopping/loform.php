<?php

session_start();
session_destroy();

include 'dbh.php';




header ("Location: index.php");
?>