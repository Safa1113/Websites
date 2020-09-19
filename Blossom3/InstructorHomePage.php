 <?php 
include 'dbh.php';
session_start();

if(!isset($_SESSION['id'])){

header('location: InstructorLog-in.php');


}else
{
if($_SESSION['type'] != "instructor"){

header('location: StudentHomePage.php');
}

}



?>
 
 
  <!DOCTYPE HTML>
  <html>
   
	<head>
	  <meta charset='UTF-8'>
	  <title> Instructor home page </title>
	  <script src="javascript.js"></script>
	  <link rel="stylesheet" href="style.css">
	</head>
	
	<body>
	 
	 <!------------------------ Header  ---------------------------->
		<header>
			<img src="images/logo.png" alt="logo">
			<div>
			<nav>
			<a href ="index.php" >Home Page</a>
			<a href ="addNewCourse.php" >Add Course</a>
			<a href ="aboutUs.php" >About Us</a>
			</nav>
			</div>
			<a id="out" href="logout.php"> Log Out</a>
		</header>
     <!------------------------ End Header  ---------------------------->
	 <?php
	 
	 if(isset($_SESSION['id'])){
$uid = $_SESSION['id'];
$sql = "select * from instructor where id='$uid'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
}
	?> 
	 <main>
	 <form>
	 <fieldset>
	   <legend> Instructor Information</legend>
	   <p class="info">Name: <?php echo $row["name"]; ?></p> 
	   <p class="info">Email Adrdress: <?php echo $row["email"]; ?></p>
	   <p class="info">Speciality: <?php echo $row["speciality"]; ?></p>
	   </fieldset>
	  </form>
	  <br><a href="addNewCourse.php">+add course</a>
	  <table>
	  
	   <caption> Available Courses </caption>
	   <tr>
	    <th> Course </th>
	   </tr>
	   
	   
				<?php
if(isset($_SESSION['id'])){
$id = $_SESSION['id'];
$sql = "select * from course where instructor_id='$id'";
$result = mysqli_query($con, $sql);



while($row = mysqli_fetch_assoc($result)) {
?>
	   
	   <tr>
	   <td><a href="courseInfo.php?cid=<?php echo $row["id"]; ?>&mode=view"> <?php echo $row["name"]; ?></a></td>
	   <td><a href="courseInfo.php?cid=<?php echo $row["id"]; ?>&mode=view#list"> Display Students list </a></td>
		
		
		<form action="courseInfo.php" method="post">
		<input type="hidden" name="cid" value=<?php echo $row["id"];?>>
		<input type="hidden" name="mode" value="edit">
		<!--- < td><a href="courseInfo.php"> Edit </a></td> ---->
        <td><button type="submit">Edit</button></td>
        </form>
	   </tr>

	   <?php }   }?>
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