   <?php 
include 'dbh.php';
session_start();

if(!isset($_SESSION['id'])){

header('location: StudentLog-in.php');
}
else
{
if($_SESSION['type'] != "student"){

header('location: InstructorHomePage.php');
}
}

?>
  
  <!DOCTYPE HTML>
  <html>
   
	<head>
	  <meta charset='UTF-8'>
	  <title> Student home page </title>
	  <link rel="stylesheet" href="style.css">
	  
	</head>
	
	<body>
	
	 <!------------------------ Header  ---------------------------->
		<header>
			<img src="images/logo.png" alt="logo">
			<div>
			<nav>
			<a href ="index.php" >Home Page</a>
			<a href ="#available" >Available Courses</a>
			<a href ="aboutUs.php" >About Us</a>
			</nav>
			</div>
			
			<a id="out" href="logout.php"> Log Out</a>
		</header>
     <!------------------------ End Header  ---------------------------->
	 
	 <main>
	 
	 	 <?php
	 
	 if(isset($_SESSION['id'])){
$uid = $_SESSION['id'];
$sql = "select * from student where id='$uid'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
}
	?> 
	 
	  <form method="get">
	   <fieldset>
	   <legend> Student Information</legend>
	   <p class="info">Name: <?php echo $row["name"]; ?></p>
	   <p class="info">Email Adrdress: <?php echo $row["email"]; ?></p>
	   </fieldset>
	  </form>
	  
	   
	 

	  <table id="available">
	   <caption> Available Courses </caption>
	   <tr>
	    <th> Course </th>
		<th> Status </th>
	   </tr>
	   <?php
	   	 if(isset($_SESSION['id'])){
$uid = $_SESSION['id'];
$sql = "select * from course";

$result = mysqli_query($con, $sql);



while($row = mysqli_fetch_assoc($result)) {
$cid = $row["id"];
	?> 
	  
	  

	   
	   <tr>
	    <td> <a href ="courseInfo.php?cid=<?php echo $row["id"]; ?>&mode=view" ><?php echo $row["name"]; ?></a> </td>
		
		  <?php
	   

$sql2 = "select * from enrolment where student_id='$uid' and course_id='$cid' ";

$result2 = mysqli_query($con, $sql2);


if ($row2 = mysqli_fetch_assoc($result2)) {

	?> 	
		
		<td>Enrolled</td>
		
		
				  <?php
	   
}else {

	?>
	<form action="" method="post">
		<input type="hidden" name="cid" value=<?php echo $row["id"];?>>
		
        <td><button type="submit">Enroll</button></td>
        </form>
					  <?php
	   
}

	?>
		
			  <?php
	   

$sql2 = "select * from enrolment where student_id='$uid' and course_id='$cid' ";

$result2 = mysqli_query($con, $sql2);


if ($row2 = mysqli_fetch_assoc($result2)) {

	?> 	
		<form action="" method="post">
		<input type="hidden" name="cid" value=<?php echo $row["id"];?>>
		
		<!--- < td><a href="courseInfo.php"> Edit </a></td> ---->
        <td><button type="submit">Drop</button></td>
        </form>
					  <?php
	   
}else {

	?>
	
	<td></td>
	
	 <?php
	   
}

	?>
		
		
	   </tr>
	   
	<?php    } }  ?>
	   
	  </table>
	 
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