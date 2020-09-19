<?php
session_start();

include 'dbh.php';

if(isset($_POST['id'])){

$id = $_POST['id'];


$sql = "
delete from course
where id='$id'";

$result = mysqli_query($con, $sql);


header ("Location: InstructorHomePage.php");

}

?>