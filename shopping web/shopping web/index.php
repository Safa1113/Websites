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
        
            function addcart() {
               alert("Item has been added")
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
$sql = "select * from products";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
?>

<div id="item">

<img src="images/<?php echo $row["product"]; ?>.jpg" alt="<?php  echo $row["product"]; ?>"  width="150" height="150" style="float: left">
<p style="float: right">
<?php  echo $row["color"]. "   ". $row["product"];?> </br>
<?php  echo $row["price"]. "$";?> </br>
</p>

<?php if(isset($_SESSION['id'])){?>

<form action="atcform.php" method="post" >
<input type="hidden" name="id" value=<?php echo $row["id"];?>>
<button type="submit"   onclick="addcart()" >Add to the cart</button>
</form>


<?php }else { ?>
<p>
Sign up to add to the cart
</p>
<?php }?>

</div>
<?php } ?>



</div>
</div>
<div id="footer">
<p> copy right saved &copy 2016</p>
</div>



</body>
</html>