<?php 
session_start();
?>


<!DOCTYPE html >
<html>
<head>
  <title>Sign Up</title>
  <link rel="stylesheet" href="style1.css">
</head>

<body>

<div id=container>
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

<div id=title>
<h1> Shoping Online </h1>

<br/>

</div>

<div id=form>

<form action="lform.php" method="post">
Username:  <input class="tx" type="text" name="uname" placeholder="username">
<br><br>
Password: <input class="tx" type="password" name="pass" placeholder="password">
<br><br>
<button class="tx" type="submit">Log in</button> 
</form>
</div>





</div>
<div id=footer>
<p> copy rgiht saved 2016<p/>
</div>


</body>
</html>