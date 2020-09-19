<!DOCTYPE html>
<html>

<head>
</head>
<body>
<?php
session_start();

include 'dbh.php';


$username = $_POST['username'];
$psw = $_POST['password'];
$mail = $_POST['email'];


$sql = "insert into users (UserName,Psw,Email) 
values ('$username', '$psw', '$mail')";


$result = mysqli_query($conn, $sql);

if ($result){
?>

<script type="text/javascript">alert("User Account has successfully created");
window.location.href='\index.php';</script>

<?php

}
else
{

?>


            <script type="text/javascript">
alert("Unknown Error");
window.location.href='\index.php';
            </script>
        
<?php
}


?>
</body>

</html>

