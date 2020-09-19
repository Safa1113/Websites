<!DOCTYPE html>
<html>
<head>
  <title>Shopping Online</title>
  <link rel="stylesheet" type= "text/css" href="style.css" />

<script type="text/javascript">
        
            function usucc() {
               alert("User Account has successfully created")
            }
            function ufail() {
               alert("Something went wrong")
            }
        
</script>


</head>

<body>


<?php
session_start();

include 'dbh.php';

$first = $_POST['first'];
$last = $_POST['last'];
$username = $_POST['uname'];
$psw = $_POST['pass'];
$mail = $_POST['email'];


$sql = "insert into users (FirstName,LastName,UserName,Psw,Email) 
values ('$first', '$last', '$username', '$psw', '$mail')";


$result = mysqli_query($conn, $sql);

if ($result){
?>

<script type="text/javascript">usucc();
window.location.href='\index.php';</script>

<?php

}
else
{

?>


            <script type="text/javascript">
ufail();
window.location.href='\index.php';
            </script>
        
<?php
}


?>


</body>
</html>