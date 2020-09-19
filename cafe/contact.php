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



$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$msg = $firstname.$lastname.$email.$subject;
mail("shiekha5436@gmail.com","Cafe Site",$msg);


  ?>

            <script type="text/javascript">
alert("Your Message has been Sent");
window.history.back();
            </script>
        


</body>
</html>