<?php
session_start();

include 'dbh.php';

$first = $_POST['first'];
$last = $_POST['last'];
$username = $_POST['uname'];
$psw = $_POST['pass'];
$mail = $_POST['email'];


$sql = "insert into users (Fname,Lname,uname,psw,Email) 
values ('$first', '$last', '$username', '$psw', '$mail')";


$result = mysqli_query($conn, $sql);


header ("Location: index.php");
?>