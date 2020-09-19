<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Mood</title>
  
  <script type="text/javascript">
        
    function alert(message) {
               alert message;
            }
  
</script>

</head>

<body>

<?php
require_once 'include/DB_Functions.php';
require_once 'mailactivation.php';
$db = new DB_Functions();

if (isset($_GET['email']))
{

 $email = $_GET['email'];
 $user = $db->verify($email);

 if($user){
 
 // email verified successfully
 ?>

<script type="text/javascript">alert("Email verified successfully");
window.location.href='../../login.php';
</script>

<?php
 
 }
 else
 {
  // something went wrong
 ?>

<script type="text/javascript">alert("Unknown Error Occurred");
window.location.href='../../login.php';
</script>

<?php
 
 }


}
else 
{

?>

<script type="text/javascript">alert("Wrong link");
window.location.href='../../login.php';</script>

<?php

}


?>

</body>
</html>
