<?php
session_start();

include 'dbh.php';

$p_id = $_POST['id'];

if(isset($_SESSION['id'])){

$u_id = $_SESSION['id'];

$sql = "insert into cart (u_id, p_id)
values ('$u_id', '$p_id')";
$result = mysqli_query($conn, $sql);



header ("Location: index.php");

}

?>