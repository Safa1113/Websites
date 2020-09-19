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


 
if (isset($_SESSION['id'])  ) {
  
 
      if (isset($_POST['content']) ){
              
              $txt = $_POST['content'];
              $writer = $_SESSION['id'];
              
               
 
          $user = $db->posta($writer);
            
              if ($user) {
			  rename('../sounds/'.$_SESSION['id'].'/temp/test.wav', '../sounds/'.$_SESSION['id'].'/'.$user['content'].'.wav');
            // non-delta content stored successfully
          //  $response["error"] = FALSE;
           // $response["writer"] = $user["writer"];
           // echo json_encode($response);
			
			$pid  = $user["ID"];
			if (isset($_POST['to_id'])){			
							$br = $db->replya($pid, $_POST['to_id']);
			
			}
			
			
			 ?>


            <script type="text/javascript">
alert("Your post has been submitted");
window.location.href='../../indexa.php';
            </script>
        
<?php
			
			
			
			}
		
		
			
			
         else {
            // non-delta content failed to store
          //  $response["error"] = TRUE;
           // $response["error_msg"] = "Unknown error occurred in posting";
           // echo json_encode($response);
		   
		    ?>


            <script type="text/javascript">
alert("Unknown error has occured");
window.location.href='../../indexa.php';
            </script>
        
<?php
		   
        }
        
              
           
            }else{
     //         $response["error"] = TRUE;
   // $response["error_msg"] = "txt parameter is missing!";
   // echo json_encode($response);
              
			   ?>


            <script type="text/javascript">
alert("Some parameters are missing");
window.location.href='../../index.php';
            </script>
        
<?php
			  
            }
      
      
    
  
} else {
  // session id is not set
  //  $response["error"] = TRUE;
  //  $response["error_msg"] = "writer parameter is missing!";
   // echo json_encode($response);
   
    ?>


            <script type="text/javascript">
alert("Some parameters are missing");
window.location.href='../../index.php';
            </script>
        
<?php
}

?>


</body>
</html>