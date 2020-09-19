<?php

session_start();
include 'dbh.php';


$username = $_POST['uname'];
$psw = $_POST['pass'];


$sql = "select * from users where uname ='$username' and psw='$psw'";

$result = mysqli_query($conn, $sql);

if (!$row = mysqli_fetch_assoc($result)) {
echo "your username or password is incorrect";

}
else {
$_SESSION ['id'] = $row['id'];

}


header ("Location: index.php");
?>