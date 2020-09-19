<?php 
include 'dbh.php';
session_start();
?>


<!DOCTYPE html>
<html>
<head>
  <title>Shopping Online</title>
  <link rel="stylesheet" type= "text/css" href="style.css" />

<script type="text/javascript">
        
            function addcart() {
               alert("Item has been added")
            }
        
</script>

</head>

<body>






    <div class="frontbox">
<div id="title">
<h1> Shoping Online <h1/>

</div>
<div id="Nav">
<ul>
<li>
<a href="index.php">
home
</a>
</li>
<li>
<a href="cart.php">
My shopping cart
</a>
</li>



<?php
if(isset($_SESSION['id'])){
?>
<li>
<a href="loform.php">
Log out
</a></li>
<?php } else {?>

<li>
<a href="log_in.php">
Log in
</a></li>
<li>
<a href="sign_up.php">
Sign up
</a>
</li>
<?php } ?>


<li><a><snap>
<?php
if(isset($_SESSION['id'])){

$sid = $_SESSION['id'];
$sql = "select FirstName from users where Id = " .$sid;

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo "Welcome ". $row["FirstName"];
}?>
</snap></a></li>

</ul>


</div>
 </div>





<div id="items">


<?php
$sql = "select * from products";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
?>

<div id="item">

  <p id = "image">

<img src="images/<?php echo $row["Image"]; ?>.jpg" alt="<?php  echo $row["Image"]; ?>"  width="150" height="150">

  </p>
<p id="txt">
<?php  echo $row["ProductName"];?> </br>


<?php  echo "Color : " . $row["Color"];?> </br>
<?php  echo $row["Price"]. "$";?> </br>


<?php if(isset($_SESSION['id'])){?>

<form class = "addToCart" action="atcform.php" method="post" >
<input type="hidden" name="id" value=<?php echo $row["Id"];?>>
<button type="submit"   onclick="addcart()" >Add to the cart</button>
</form>


<?php }else { ?>

Sign up to add to the cart
</p>
<?php }?>


</div>
<?php } ?>



</div>

<div id="footer">
<p>  &copy; All rights reserved</p>
</div>



</body>
</html>