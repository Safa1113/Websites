<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Mood</title>
  
  <script type="text/javascript">
  
              function show(message) {
               alert(message);
            }
        
            function usucc() {
               alert("User Account has successfully created, you need to check your email to verify it")
            }
            function ufail() {
               alert("Something went wrong")
            }
			function uexist() {
               alert("User or Email already exist ")
            }
        
</script>

</head>

<body>
<?php


require_once 'include/DB_Functions.php';
require_once 'mailactivation.php';
$db = new DB_Functions();
$vr = new Verification_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['squestion']) && isset($_POST['sanswer']) && isset($_POST['about']) ) {
 
    // receiving the post params
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
	
    $birthdate = "2018/12/12";
    $about = $_POST['about'];
    $sequrity_q = $_POST['squestion'];
    $sequrity_a = $_POST['sanswer'];



 
    // check if user is already existed with the same username
    if ($db->isUserExisted($username) || $db->isEmailExisted($email)) {
        // user already existed or email exists
        ?>

<script type="text/javascript">show("Username is already exist");
window.location.href='../../signup.php';</script>

<?php

    } else {
        // create a new user
 

        $user = $db->storeUser($birthdate, $email, $password, $username, $sequrity_q, $sequrity_a, $about);
        if ($user) {
            // user stored successfully
			
			// send verification email to user
			$vr->sendEmail($email, $username, $password);
			
			
			
			
			
			//create folder to save your audios
			$structure = '../sounds/'.$user["ID"];
if (!mkdir($structure, 0777, true)) {
    die('Failed to create folders...');
	
}else{
			$structure2 = '../sounds/'.$user["ID"].'/temp';
if (!mkdir($structure2, 0777, true)) {
    die('Failed to create folders...');
}

}



           ?>

<script type="text/javascript">show("User Account has successfully created, you need to check your email to verify it");
window.location.href='../../login.php';</script>

<?php
        } else {
            // user failed to store
            ?>


            <script type="text/javascript">
show("Failed to store user");
window.location.href='../../signup.php';
            </script>
        
<?php
        }
    }
} else {
    ?>


            <script type="text/javascript">show("Some parameters are missing");
window.location.href='../../signup.php';
            </script>
        
<?php
}
?>


</body>
</html>