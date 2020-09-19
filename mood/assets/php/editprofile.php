
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
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);

if ( isset($_POST['id']) && isset($_POST['username']) &&  isset($_POST['flag']) && (   (isset($_POST['encrypted_password']) && isset($_POST['salt'])) ||   isset($_POST['password'])     )  && isset($_POST['email']) && isset($_POST['squestion']) && isset($_POST['sanswer']) && isset($_POST['about']) ) {
  // receiving the post params
    $id = $_POST['id'];
	
	$username = $_POST['username'];
    $email = $_POST['email'];
    
    $birthdate = "2018/12/12";
    $about = $_POST['about'];
    $sequrity_q = $_POST['squestion'];
    $sequrity_a = $_POST['sanswer'];
	

	$flag = $_POST['flag'];
	
		if (isset($_POST['password']) )
	$password = $_POST['password'];
	else
		$password = "";

		if (isset($_POST['encrypted_password']) )
	$encrypted_password = $_POST['encrypted_password'];
		else
		$encrypted_password = "";
	
			if (isset($_POST['salt']) )
	$salt = $_POST['salt'];
		else
		$salt = "";

        $user = $db->changeinfo($id, $birthdate, $email, $password, $username, $sequrity_q, $sequrity_a, $about, $flag, $salt, $encrypted_password); 

//echo json_encode($response);
           if ($user) {
		   $_SESSION['username'] = $user['name'];

		  // echo json_encode($response);
            //  stored successfully
        // $response["error"] = FALSE;
         ///   $response["message"] = "your information has been updated succefully, since sequrity has changed, no one is following you in delta mood";        
          //  echo json_encode($response);
         
		 		   		if ($flag == 3)
		{
      $db->changedsequrity ($username);
	  
		  ?>


            <script type="text/javascript">
alert("Your profile is updated succefully, since secret answer is updated, no one is following you now in audio mood");
window.location.href='../../index.php';
            </script>
        
<?php
		 }else {
		 
		 ?>
	            <script type="text/javascript">
alert("Your profile is updated succefully");
window.location.href='../../index.php';
            </script>
   
        
<?php	 
		 
		 
	  }
	 
        
        } else {
            // failed to store
         //   $response["error"] = TRUE;
         //   $response["error_msg"] = "Unknown error occurred";
		 
		  ?>


            <script type="text/javascript">
alert("Unknown error has occured");
window.history.back()
            </script>
        
<?php 
        }

}else{

// $response["error"] = TRUE;
   // $response["error_msg"] = "Required parameters is missing!";
  //  echo json_encode($response);
  
   ?>


            <script type="text/javascript">
alert("Some Parameters are missing");
window.history.back()
            </script>
        
<?php


}
?>

</body>
</html>
