<?php
error_reporting(E_ALL ^ E_NOTICE);  
error_reporting(0);  

##include('loginIns.php');
if(isset($_SESSION['id']) && $_SESSION['type'] == "instructor")
{ header ("Location: InstructorHomePage.php"); }

if(isset($_SESSION['id']) && !$_SESSION['type'] == "instructor")
{ header ("Location: StudentHomePage.php"); }

?>
  
  <!DOCTYPE HTML>
  <html>
   
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	  <meta charset='UTF-8'>
	  <title> Instructor log-in </title>
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
			<a href ="StudentLog-in.php" >Student Log-in</a>
			<a href ="aboutUs.php" >About Us</a>
			</nav>
			</div>
		</header>
     <!------------------------ End Header  ---------------------------->
	   
	 <main>
	  <h2> Instructor log-in </h2>
	  
	  <form id="form4" method="post" action="loginIns.php" enctype="multipart/form-data" >
	     <fieldset>
		   <legend> Instructor Information </legend>
		     Email: <input type="email" name="email" required ><br>
		 	 Password: <input type="password" name="password" required ><br>
			 
			 <input type="submit" value="Log-in" >
			 <input type="button" value="Reset" onclick="Reset4()">
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