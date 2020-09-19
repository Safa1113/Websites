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


if (isset($_POST['IAM']) && isset($_POST['follows']) && isset($_POST['followpassword']))
{

$username = $_POST['IAM'];
$follows = $_POST['follows'];
$inMood = "audio";
$s_a = $_POST['followpassword'];

$answer =  $db->checks_a ($follows, $s_a);
                      if ($answer){
					  
					  $user3 = $db->getUserIDByName($follows);

                        $user = $db->followUser($username, $user3, $inMood);
       if ($user) {
            // userfollowing stored successfully
          //  $response["error"] = FALSE;
        //    $response["uid"] = $user["username"];
          //  $response["user"]["name"] = $user["follow"];
         //   $response["user"]["email"] = $user["mood"];

        //    echo json_encode($response);
		
		 ?>


            <script type="text/javascript">
alert("User is followed");
window.history.go(-2);
            </script>
        
<?php
        } else {
              // user failed to store
         //   $response["error"] = TRUE;
          //  $response["error_msg"] = "Unknown error occurred in following!";
           // echo json_encode($response);
		   
		   
		  ?>


            <script type="text/javascript">
alert("Unknown error has occured");
window.history.go(-1);
            </script>
        
<?php 
        }
                                          
               
			  } else {
   // $response["error"] = TRUE;
  //  $response["error_msg"] = "Wrong answer";
  //  echo json_encode($response);
  
   ?>


            <script type="text/javascript">
alert("Wrong Answer");
window.history.go(-1);
            </script>
        
<?php
}

			   
}else {
  //   $response["error"] = TRUE;
  //  $response["error_msg"] = "Required parameters is missing!";
  //  echo json_encode($response);
  
  
   ?>


            <script type="text/javascript">
alert("Some Parameters are missing");
window.history.go(-1);
            </script>
        
<?php
  
}

?>


</body>
</html>