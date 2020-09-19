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
  
 
      if (isset($_POST['content']) && isset($_POST['b1'])){
              
              $txt = $_POST['content'];
              $mentioned = $_POST['b1'];
              $writer = $_SESSION['id'];
              $writer2 = $db->getUserNameByID($writer);
               
              
    // check if txt is already existed 
    if ($db->isContentExisted($writer, $txt)) {
        // txt already existed
        //$response["error"] = TRUE;
        //$response["error_msg"] = "you've once written this" . $txt;
        //echo json_encode($response);
		
		
		 ?>


            <script type="text/javascript">
alert("You've once written this");
//window.location.href='../../postt.php';
            </script>
        
<?php
		
		
		
		
    } else {
          // txt doesn't exixt
          
        if ( ($db->isUserExisted($mentioned)) && ($mentioned != $writer2)){
          $user = $db->postt($writer, $txt);
            //$user = $db->block($mentioned, $pid);
              if ($user) {
            // non-delta content stored successfully
			
           // $response["error"] = FALSE;
           // $response["writer"] = $user["writer"];
           // echo json_encode($response);
			
			
			$pid  = $user["ID"];
			echo $pid;
			echo $mentioned;
			$b1id = $db->getUserIDByName($mentioned);
			$user = $db->block($b1id, $pid);
			
			
			
			if (isset($_POST['b2']))
                              {
                                     $b2 = $_POST['b2'];
									   if ( $db->isUserExisted($b2)){
									   $b2id = $db->getUserIDByName($b2);
									   $blk = $db->block($b2id, $pid);
									   
									   }
                              }
                              
              if (isset($_POST['b3'])){
                                     $b3 = $_POST['b3'];
									  if ( $db->isUserExisted($b3)){
									  $b2id = $db->getUserIDByName($b3);
									  $blk = $db->block($b2id, $pid);
									  
									  }
                            }
							
		    if (isset($_POST['to_id'])){			
							$br = $db->replyt($pid, $_POST['to_id']);
			
			}
			
			
					 ?>


            <script type="text/javascript">
alert("Your post has been submitted");
window.location.href='../../index.php';
            </script>
        
<?php
			
			
			
			}
			
         else {
            // non-delta content failed to store
          //  $response["error"] = TRUE;
           // $response["error_msg"] = "Unknown error occurred in signaling";
          //  echo json_encode($response);
		  		 ?>


            <script type="text/javascript">
alert("Unknown error has occured");
window.location.href='../../index.php';
            </script>
        
<?php
		  
        }
        }
        else {
          //   $response["error"] = TRUE;
          //  $response["error_msg"] = "Mentioned user doesn't exist";
          //  echo json_encode($response);
		  		 ?>


            <script type="text/javascript">
alert("Blocked user doesn't exist");
window.location.href='../../postt.php';
            </script>
        
<?php
		  
        }
              
              
        }     
            }else{
        //      $response["error"] = TRUE;
  //  $response["error_msg"] = "txt or mentioned parameter is missing!";
  //  echo json_encode($response);
  
  		 ?>


            <script type="text/javascript">
alert("Some parameters are missing");
window.location.href='../../postt.php';
            </script>
        
<?php
              
            }
      
      
    
  
} else {
  // session id is not set
   // $response["error"] = TRUE;
   // $response["error_msg"] = "writer parameter is missing!";
   // echo json_encode($response);
   
   		 ?>


            <script type="text/javascript">
alert("Writer parameter is missing");
window.location.href='../../index.php';
            </script>
        
<?php
}

?>

</body>
</html>