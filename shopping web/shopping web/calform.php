<?php
session_start();

include 'dbh.php';


if(isset($_SESSION['id'])){

$u_id = $_SESSION['id'];
$sql = "select * from cart, products where cart.u_id='$u_id' and p_id=products.id";
$result = mysqli_query($conn, $sql);

$sum = 0;
if (mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result)) {
        $sum = $sum + $row["quantity"] * $row["price"];
    }
echo $sum;
}
else
{

header ("Location: index.php");
}



}

?>