<?php 
include 'dbh.php';
session_start();
?>


<!DOCTYPE html>
<html>
<head>
  <title>My first styled page</title>
  <link rel="stylesheet" type= "text/css" href="style1.css" />

<script type="text/javascript">
        
            function deletecart() {
               alert("Item has been deleted")
            }
        
</script>
</head>

<body>

<div id="container">

<div id="buttons">
<a href="index.php">
<button type="button" >home</button>
</a>

<a href="cart.php">
<button type="button">My shopping cart</button>
</a>

<snap class=welcome>
<?php
if(isset($_SESSION['id'])){

$sid = $_SESSION['id'];
$sql = "select Fname from users where id ='$sid'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo "Welcome ". $row["Fname"];
}?>
</snap>

<?php
if(isset($_SESSION['id'])){
?>

<a href="loform.php">
<button type="button" class="p1" >Log out</button>
</a>
<?php } else {?>


<a href="log_in.php">
<button type="button" class="p1" >Log in</button>
</a>
<a href="sign_up.php">
<button type="button" class="p2">Sign up</button>
</a>

<?php } ?>



</div>
<div id="title">
<h1> Shoping Online <h1/>

</div>

<div id="items">

<?php
if(isset($_SESSION['id'])){
$uid = $_SESSION['id'];
$sql = "select * from cart, products where u_id='$uid' and products.id=p_id";
$result = mysqli_query($conn, $sql);



while($row = mysqli_fetch_assoc($result)) {
?>


<div id="item">
<img src="images/<?php echo $row["product"]; ?>.jpg" alt="<?php  echo $row["product"]; ?>"  width="150" height="150" style="float: left">
<p>
<?php  echo $row["color"]. "   ". $row["product"];?> </br>
<?php  echo $row["price"]. "$";?> </br>
<?php  echo "quantity = ". $row["quantity"];?>
</p>
<form action="dfcform.php" method="post" >
<input type="hidden" name="id" value=<?php echo $row["p_id"];?>>
<button type="submit" onclick="deletecart()">Delete one item from the cart</button>
</form>
</div>



<?php } ?>
<p style="float: right; clear: both;">

<?php
$sql = "select * from cart, products where cart.u_id='$uid' and p_id=products.id";
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
{  ?>
</p>

<p>
<?php
echo "there's nothing in the cart";
}
?>
</p>


<?php } else {?>

<p> you're not logged in</p>

<?php } ?>

</div>
</div>
<div id="footer">
<p> copy right saved &copy 2016</p>
</div>



</body>
</html>