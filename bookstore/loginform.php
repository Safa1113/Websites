<?php

session_start();
include 'dbh.php';


$username = $_POST['username'];
$psw = $_POST['password'];


$sql = "select * from users where UserName ='$username' and Psw='$psw'";

$result = mysqli_query($conn, $sql);

if (!$row = mysqli_fetch_assoc($result)) {
echo "your username or password is incorrect";

}
else {
$_SESSION ['id'] = $row['Id'];

}


header ("Location: index.php");
?>