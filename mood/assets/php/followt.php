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


if (isset($_POST['IAM']) && isset($_POST['follows']) && isset($_POST['inMood']))
{

$username = $_POST['IAM'];
$follows = $_POST['follows'];
$inMood = $_POST['inMood'];

$user3 = $db->getUserIDByName($follows);


                        $user = $db->followUser($username, $user3, $inMood);
       if ($user) {
            // userfollowing stored successfully
          //  $response["error"] = FALSE;
          //  $response["uid"] = $user["username"];
          //  $response["user"]["name"] = $user["follow"];
         //   $response["user"]["email"] = $user["mood"];
		 
		 ?>


            <script type="text/javascript">
alert("User is followed");
window.history.back()
            </script>
        
<?php
		 
		 

           // echo json_encode($response);
        } else {
            // user failed to store
         //   $response["error"] = TRUE;
          //  $response["error_msg"] = "Unknown error occurred in following!";
           // echo json_encode($response);
		   
		   
		  ?>


            <script type="text/javascript">
alert("Unknown error has occured");
window.history.back()
            </script>
        
<?php 
		   
		   
        }
                                          
               }

else {
 //   $response["error"] = TRUE;
  //  $response["error_msg"] = "Required parameters is missing!";
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