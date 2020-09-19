<?php
session_start();

include 'dbh.php';


if (isset($_POST['cid']) && isset($_POST['title']) && isset($_POST['field']) && isset($_POST['description']) && isset($_FILES['bookcover']['name'])){


$cid = $_POST['cid'];
$name = $_POST['title'];
$field = $_POST['field'];
$description = $_POST['description'];
$bookcover = $_FILES['bookcover']['name'];



if(isset($_SESSION['id']) && $_SESSION['type'] == "instructor"){

$instructorID = $_SESSION['id'];

$sql = "update course set instructor_id='$instructorID', name='$name', field_='$field', description='$description', book_cover= '$bookcover' where id='$cid'";

mysqli_query($con, $sql);

$sql = "select * from course where id='$cid'";

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