<?php
session_start();

include 'dbh.php';

#$fullname="";
#$username="";
#$password ="";
#$email="";
#$Speciality ="";

$errors = array();



$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$Speciality = $_POST['Speciality'];

#$fullname = mysqli_real_escape_string($con , $_POST['fullname']);
#$username = mysqli_real_escape_string($con , $_POST['username']);
#$password = mysqli_real_escape_string($con , $_POST['password']);
#$email = mysqli_real_escape_string($con , $_POST['email']);
#$Speciality = mysqli_real_escape_string($con , $_POST['Speciality']);



#echo $username . $password . $fullname . $email . $Speciality;

if (empty($username)){array_push($errors, "username is required"); }
if (empty($password)){array_push($errors, "password is required"); }
if (empty($email)){array_push($errors, "email is required"); }
if (empty($Speciality)){array_push($errors, "Speciality is required"); }

if ($Speciality == "instructor"){
$user_check_query = "SELECT * FROM instructor WHERE username ='$username' or email = '$email' LIMIT 1";



$results= mysqli_query($con, $user_check_query);

$user= mysqli_fetch_assoc($results);




if ($user){
                   
				   if ($user['username']== $username){array_push($errors, "username alraedy exists");}
				   if ($user['email']== $email){array_push($errors, "email alraedy exists");}
				   

}
}
else {



$user_check_query = "SELECT * FROM student WHERE username ='$username' or email = '$email' LIMIT 1";



$results= mysqli_query($con, $user_check_query);

$user= mysqli_fetch_assoc($results);




if ($user){
                   
				   if ($user['username']== $username){array_push($errors, "username alraedy exists");}
				   if ($user['email']== $email){array_push($errors, "email alraedy exists");}
				   

}



}


echo count($errors) . " ";

foreach($errors as $error) {
    echo $error. " " ; }

if (count($errors) == 0 ){                
if ($Speciality == "instructor"){
#$password = md5($password_1);
$password = md5($password);
$query = "INSERT INTO instructor (username, pssword, name, email, speciality) VALUES ('$username', '$password', '$fullname', '$email', '$Speciality')";


#mysqli_query($con , $query);
$result2 = mysqli_query($con, $query);

$_SESSION['id'] = $result2['id'];
#$_SESSION['$username'] = $username;
$_SESSION['username'] = $username;
$_SESSION['type'] = $Speciality;
$_SESSION['success'] = "You are now signed in" ;
header('location: InstructorHomePage.php');
}

else if ($Speciality == "student"){

#echo $username . $password . $fullname . $email . $Speciality;

#$password = md5($password_1);
$password = md5($password);
$query = "INSERT INTO student ( username, pssword, name, email) VALUES ('$username', '$password', '$fullname', '$email')";

$result2 = mysqli_query($con , $query);

$_SESSION['id'] = $result2['id'];
$_SESSION['username'] = $username;
$_SESSION['type'] = $Speciality;
$_SESSION['success'] = "You are now Signed in" ;
header('location: StudentHomePage.php');
}


}


?>
