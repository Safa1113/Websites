<?php 
include 'dbh.php';
session_start();


if(isset($_SESSION['id'])){

if($_SESSION['type'] == "instructor"){

header('location: InstructorHomePage.php');
} else if($_SESSION['type'] == "student"){
header('location: StudentHomePage.php');
}



}
?>


<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title> Home Page </title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<!------------------------ Header  ---------------------------->
<header>
<img src="images/logo.png" alt="logo">
<div>
<nav>
<a href ="#dd" >Log-in</a>
<a href ="aboutUs.html" >About Us</a>
</nav>
</div>
</header>
<!------------------------ End Header  ---------------------------->

<main id="dd">
<input id="button" type="button" class="button" name="Log-in" value="Instructor Log-in" onclick="window.location.href='InstructorLog-in.php'">
<input id="button" type="button" class="button" name="Log-in" value="Student Log-in" onclick="window.location.href='StudentLog-in.php'">
<p id="P"> New Student ? <a href="signUp.php">sign up</a></p>
</main>

<!------------------------ Footer  ---------------------------->
<footer>
<div class="footerLinks">
<pre>
<a href="mailto:Blossom@gmail.com"><img  src="images/email.png" alt="email"></a>
</pre>
</div>

<div class ="footerR">
<p> &copy;Blossom 2020</p>
</div>
</footer>
<!------------------------ End Footer  ---------------------------->

</body>
</html>
