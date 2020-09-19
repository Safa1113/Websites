<?php
error_reporting(E_ALL ^ E_NOTICE);  
error_reporting(0);  

#include('loginstu.php');

if(isset($_SESSION['id']) && $_SESSION['type'] == "student")
{ header ("Location: StudentHomePage.php"); }

if(isset($_SESSION['id']) && !$_SESSION['type'] == "student")
{ header ("Location: InstructorHomePage.php"); }

?> 
 <!DOCTYPE HTML>
  <html>
   
	<head>
	  <meta charset='UTF-8'>
	  <title> Student log-in </title>
	  <link rel="stylesheet" type="text/css" href="style.css">
	  <script src="javascript.js"></script>
	  
	</head>
	
	<body>

	  <!------------------------ Header  ---------------------------->
		<header>
			<img src="images/logo.png" alt="logo">
			<div>
			<nav>
			<a href ="index.php" >Home Page</a>
			<a href ="InstructorLog-in.php" >Instructor Log-in</a>
			<a href ="aboutUs.php" >About Us</a>
			</nav>
			</div>
		</header>
     <!------------------------ End Header  ---------------------------->

	 <main>
	  <h2> Student log-in</h2>
	  
	  <form id="form3" action="loninstu.php" method="post" >
	     <fieldset>
		   <legend> Student Information </legend>
		     Email: <input type="email" name="email" required ><br>
		 	 Password: <input type="password" name="password" required ><br>
			 
			 <input type="submit" value="Log-in" >
			 <input type="button" value="Reset" onclick="Reset3()">
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