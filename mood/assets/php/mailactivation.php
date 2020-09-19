
<?php


require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 

class Verification_Functions {
 public function sendEmail($email, $name, $password) {
        
$to      = $email; // Send email to our user
$subject = "Signup | Verification'"; // Give the email a subject 
$message = "
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Username: ".$name."
Password: ".$password."
------------------------
 
Please click this link to activate your account:
".HostPath."assets/php/verify.php?email=".$email; 

// Our message above including the link
                     
$headers = "From:noreply@yourwebsite.com" . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

 
 
    }
	
	}



?>
