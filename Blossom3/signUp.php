<?php
error_reporting(E_ALL ^ E_NOTICE);  
error_reporting(0); 
 
#include('config.php');
#include('signups.php');

include 'dbh.php';
session_start();
if(isset($_SESSION['id']))
{ header ("Location: index.php"); }

?>
<!DOCTYPE HTML>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset='UTF-8'>
<title>Sign Up Page</title>
<link rel="stylesheet" href="style.css">
<script src="javascript.js"></script>
</head>

<body>

<!------------------------ Header  ---------------------------->
<header>
<img src="images/logo.png" alt="logo">
<div>
<nav>
<a href ="index.php" >Home Page</a>
<a href ="" >Instructor Log-in</a><!--HERE-->
<a href ="" >Student Log-in</a><!--HERE-->
<a href ="aboutUs.html" >About Us</a>
</nav>
</div>
</header>
<!------------------------ End Header  ---------------------------->
<main>
<form id="form1" action="signups.php" method="post" enctype="multipart/form-data">
<fieldset>
<legend>Creat a new account</legend>
full name: <input type="text" name="fullname"> <br>
Username: <input type="text" name="username"> <br>
Password: <input type="password" name="password" maxlength="15"  > </br>
Email address: <input type="email" name="email"  > <br><br>
Speciality:  </br>
   <input type="radio" id="instructor" name="Speciality" <?php if (isset($Speciality) && $Speciality==="instructor") echo "checked";?> value="instructor">
  <label for="instructor">instructor</label>
  <input type="radio" id="student" name="Speciality" <?php if (isset($Speciality) && $Speciality==="student") echo "checked";?> value="student">
  <label for="student">student</label><br>
  
<input type="submit" value="sign up" onclick=" return validate1()">
<input type="button" value="Reset" onclick="Reset1()">


</fieldset>
</form>
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