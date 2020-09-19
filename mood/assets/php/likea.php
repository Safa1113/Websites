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

if (isset($_POST['PID']) && isset($_POST['user'])){
  $pid=$_POST['PID'];
$uid=$_POST['user'];

 $user = $db->likea($pid, $uid);
 

              if ($user) {
            // content stored successfully
           // $response["error"] = FALSE;
            
          //  $response["msg"] = "+1";
         //   echo json_encode($response);
		 
		 ?>


            <script type="text/javascript">
alert("Post is liked");
window.history.back()
            </script>
        
<?php

        } else {
            //  content failed to store
         //   $response["error"] = TRUE;
           // $response["error_msg"] = "Unknown error occurred in signaling";
          //  echo json_encode($response);
		  
		  
		  ?>


            <script type="text/javascript">
alert("You've liked this post before");
window.history.back()
            </script>
        
<?php
		  
        }




}else{
  // there's no id
 //   $response["error"] = TRUE;
  //  $response["error_msg"] = "id parameter is missing!";
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