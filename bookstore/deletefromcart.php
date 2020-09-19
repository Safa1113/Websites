<?php
session_start();

include 'dbh.php';

$p_id = $_POST['id'];

if(isset($_SESSION['id'])){

$u_id = $_SESSION['id'];

$sql = "
delete from cart
where u_id='$u_id' and p_id='$p_id'";

$result = mysqli_query($conn, $sql);



header ("Location: cart.php");

}

?>