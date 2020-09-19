 <?php 
include 'dbh.php';
session_start();

if(!isset($_SESSION['id'])){
header('location: index.php');
}

?>

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Course information</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<!------------------------ Header  ---------------------------->
<header>
<img src="images/logo.png" alt="logo">
<a id="out" href="logout.php"> Log Out</a>
<div>
<nav>
<a href ="index.php" >Home Page</a>
<a href ="StudentHomePage.php" >Student Home Page</a>
<a href ="InstructorHomePage.php" >Instructor Home Page</a>
<a href ="aboutUs.php" >About Us</a>
</nav>
</div>

</header>
<!------------------------ End Header  ---------------------------->

<main>

	

<h1> Welcome To .... <h1>

<!--- <a href="#">[ Edit | Drop ]</a> --->


 <?php
	 
if(isset($_GET['cid'])){
$id = $_GET['cid'];

$sql = "select c.book_cover as b, c.name as n, c.field_ as f, c.description as d, c.id as id, i.name as teacher from course as c, instructor as i where c.id='$id' and c.instructor_id=i.id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
#echo "=======";

	?> 
	<?php 


if($_SESSION['type'] == "instructor"){



?>
<form action="deletecourse.php" method="post" >

<input type="hidden" name="id" value=<?php echo $row["id"];?>>
<button type="submit">Drop Course</button>
						
						</form>
						
						<form action="courseInfo.php" method="post">
		<input type="hidden" name="cid" value=<?php echo $row["id"];?>>
		<input type="hidden" name="mode" value="edit">
		<!--- < td><a href="courseInfo.php"> Edit </a></td> ---->
        <td><button type="submit">Edit Course</button></td>
        </form>
<?php 


}

$image = $row['b'];
$image_src = "covers/".$image;

?>						
						
						

<table id="table1">
  <tr>
    <th>Course Name</th>
	 <td><?php echo $row["n"]; ?></td>
  </tr>
  <tr>
  <th>Field</th> 
    <td><?php echo $row["f"]; ?></td>
  </tr>
  <tr>
   <th>Description</th>
    <td><?php echo $row["d"]; ?></td>
  </tr>
  <tr>
	<th>instructor name</th>
	<td><?php echo $row["teacher"]; ?></td>
	</tr>
	
	<tr>
	<th>Book Cover</th>
	<td><img width="200" height="200" src='<?php echo $image_src;  ?>' > </td>
	</tr>
	
</table>


</br>

 <?php 


if($_SESSION['type'] == "instructor" && isset($_SESSION['id'])){



?>
<div id="list" >
	  <br><h1>Student List:</h1>
	   <table>
	   
	    <tr>
		 <th> Student name </th>
		 <th> ID </th>
		</tr>
		
				<?php


$sql = "select s.name as n, s.id as id from enrolment as e, student as s where e.course_id='$id' and e.student_id=s.id";
$result = mysqli_query($con, $sql);



while($row = mysqli_fetch_assoc($result)) {
?>
		   <tr>
		 <td> <?php echo $row["n"]; ?> </td>
		 <td> <?php echo $row["id"]; ?> </td>
		</tr>
		
		
		<?php }   ?>
	   </table>
	  </div>
	   <?php 



}

?>

<?php  } else if (isset($_POST['cid']) && $_POST['mode']=="edit"){ 
?>


<form action="editcourse.php" method="post" enctype="multipart/form-data">
<fieldset>
<legend>Edit Course</legend>
Tile: <input type="text" name="title"> <br>
Field: <input type="text" name="field"> <br>
Descrition: <input type="text" name="description"> </br>
Book Cover: <input type="file" name="bookcover"> <br><br>
<input type="hidden" name="cid" value="<?php echo $_POST['cid'];?>">
  
<input type="submit" value="Save Changes">



</fieldset>
</form>



<?php  } 
?>
	  
</main>

<!------------------------  Footer  ---------------------------->
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
<html>