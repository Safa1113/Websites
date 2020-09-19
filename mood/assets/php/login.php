<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Mood</title>
  
  <script type="text/javascript">
        
            function ufail() {
               alert("Wrong username or password")
            }
			function usucc() {
               alert("Successful Login")
            }

        
</script>

</head>

<body>
<?php

require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['username']) && isset($_POST['password'])) {
 
    // receiving the post params
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    // get the user by username and password
    $user = $db->getUserByUsernameAndPassword($username, $password);
 
    if ($user != false) {
        // user is found

		
		$_SESSION ['id'] = $user["ID"];
		$_SESSION ['username'] = $user["name"];
		
    	 ?>


            <script type="text/javascript">
usucc();
window.location.href='../../index.php';
            </script>
        
<?php
   
    } else {
        // user is not found with the credentials
		
	 ?>


            <script type="text/javascript">
ufail();
window.location.href='../../login.php';
            </script>
        
<?php

    }
} else {
    // required post params is missing


	 ?>


            <script type="text/javascript">
ufail();
window.location.href='../../login.php';
            </script>
        
<?php
}
//header ("Location: ../../index.php");
?>

</body>
</html>