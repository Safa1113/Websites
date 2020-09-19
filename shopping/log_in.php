

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

</ul>

<snap class=welcome>
<?php
if(isset($_SESSION['id'])){

$sid = $_SESSION['id'];
$sql = "select Fname from users where Id ='$sid'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo "Welcome ". $row["FirstName"];
}?>
</snap>
</div>
 </div>



<div id=form>

<form action="lform.php" method="post">
Username:  <input class="tx" type="text" name="uname" placeholder="Enter your Username">
<br><br>
Password: <input class="tx" type="password" name="pass" placeholder="Enter your Password">
<br><br>
<button class="tx" type="submit">Log in</button> 
</form>
</div>


<div id="footer">
<p>  &copy; All rights reserved</p>
</div>



</body>
</html>