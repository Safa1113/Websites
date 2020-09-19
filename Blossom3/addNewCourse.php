<?php
session_start();

include 'dbh.php';

if(!isset($_SESSION['id'])){
header('location: index.php');
}
?>

<!DOCTYPE HTML>
<html>

<head>
<meta charset="UTF-8">
<title>Add New Course</title>
<link rel="stylesheet" href="style.css">
<script src="javascript.js"></script>
</head>

<body>

<!------------------------ Header  ---------------------------->
<header>
<img src="images/logo.png" alt="logo">
<div>
<nav>
<a href ="homePage.html" >Home Page</a>
<a href ="InstructorHomePage.html" >Instructor Home Page</a>
<a href ="aboutUs.html" >About Us</a>
</nav>
</div>
<a id="out" href="logout.php"> Log Out</a>
</header>
<!------------------------ End Header  ---------------------------->

<main>
<form id="form2" action="addcourse.php" method="post" enctype="multipart/form-data">
<fieldset>
<legend>Add New Course</legend>
Title: <input type="text" name="title"> <br>
Field: <input type="text" name="field"> <br>
Description: </br> <textarea name="description" rows="5" cols="50">Description of the course</textarea> <br>
Book Cover: <input type="file" name="bookcover"> <br>




<!-- input type="button" value="Add" onclick=" return validate2()" -->
<input type="submit" value="Add" name="upload" onclick=" return validate2()">


<input type="button" value="Reset" onclick="Reset2()">

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