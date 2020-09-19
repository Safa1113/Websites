<?php
session_start();

include 'dbh.php';


if (isset($_POST['title']) && isset($_POST['field']) && isset($_POST['description']) && isset($_FILES['bookcover']['name'])){

$name = $_POST['title'];
$field = $_POST['field'];
$description = $_POST['description'];
#$bookcover = $_POST['bookcover'];
$bookcover = $_FILES['bookcover']['name'];

#echo $_POST['bookcover'];

#echo $_FILES['bookcover'];



#$bookcover = addslashes(file_get_contents($bookcover));

		
		

##$target_dir = "covors/";
##$target_file = $target_dir . basename($_FILES['bookcover']['name']);

// Select file type
##$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Valid file extensions
##$extensions_arr = array("jpg","jpeg","png","gif");

// Check extension



if(isset($_SESSION['id']) && $_SESSION['type'] == "instructor"){






$instructorID = $_SESSION['id'];

$sql = "insert into course (instructor_id, name, field_, description, book_cover) values ('$instructorID', '$name', '$field', '$description', '$bookcover')";

mysqli_query($con, $sql);

#if( in_array($imageFileType,$extensions_arr) ){
 

  
 // Upload file
 #move_uploaded_file($_FILES['bookcover']['tmp_name'],$target_dir.$bookcover);




#}

$sql = "select * from course where instructor_id='$instructorID' and name='$name' and field_= '$field' and description='$description' and book_cover='$bookcover'";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$cid = $row['id'];



header ("Location: courseInfo.php?cid=$cid&mode=view");

}
else 
{
echo "it looks like you are not an instructor, log in as an instructor please";
header ("Location: InstructorLog-in.php");
}

}
else {
echo "fill all fields please";
header ("Location: InstructorHomePage.php");
}


?>