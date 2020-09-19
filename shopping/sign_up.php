



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


<div id=form>
<form action="sform.php" method="post">
  First name: <input class="tx" type="text" name="first" placeholder="Enter your First Name">
<br><br>
  Last name: <input class="tx" type="text" name="last" placeholder="Enter your Last Name">
<br><br>
 Username: <input class="tx" type="text" name="uname" placeholder="Enter your Username">
<br><br>
   Email: <input  class="tx" type="text" name="email" placeholder="Enter Your Email">
<br><br>
  Password: <input class="tx" type="password" name="pass" placeholder="Enter Your Password">
<br><br>
  <button class="tx" type="submit">Sign up </button>
</form>
</div>

<div id="footer">
<p>  &copy; All rights reserved</p>
</div>



</body>
</html>