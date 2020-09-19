<?php
session_start();

include 'dbh.php';

$p_id = $_POST['id'];

if(isset($_SESSION['id'])){

$u_id = $_SESSION['id'];
$sql = "select * from cart where u_id='$u_id' and p_id='$p_id' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
$sql = "update cart
set quantity = quantity +1
where u_id='$u_id' and p_id='$p_id'";
$result = mysqli_query($conn, $sql);
}
else
{
$sql = "insert into cart (u_id, p_id, quantity)
values ('$u_id', '$p_id', 1)";
$result = mysqli_query($conn, $sql);
}


header ("Location: index.php");

}

?>