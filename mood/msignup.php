<?php session_start(); ?>
<?php

require_once 'assets/php/include/DB_Functions.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mood</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/HeaderDark.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Projects-Horizontal.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
		<script type="text/javascript">
<!--
if (screen.width <= 699) {
document.location = "mobile.html";
}
//-->
</script>
</head>

<body>
    <div class="header-dark">
        <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search">
            <div class="container"><a class="navbar-brand" href="indexa.php">Mood</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse"
                    id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="notifications.php">Notifications</a></li>
                    </ul><a class="btn btn-light btn-block ml-auto action-button" role="button" href="postt.php" style="margin:4px;margin-left:0px;">Post</a>
					
					<?php
if(isset($_SESSION['id'])){
header("Location: index.php");
?>
<a class="btn btn-light ml-auto action-button" role="button" href="profile.php?username=<?php echo $_SESSION['username'];?>" style="margin:2px;margin-left:0px;background-color:rgb(75,91,91);">Profile</a>
<a class="btn btn-light ml-auto action-button" role="button" href="assets/php/logout.php" style="margin:2px;margin-left:0px;background-color:rgb(75,91,91);">Log Out</a>
<?php } else {?>
					
					<a class="btn btn-light ml-auto action-button" role="button" href="login.php" style="margin:2px;margin-left:0px;background-color:rgb(75,91,91);">Log In</a>
                    <a
                        class="btn btn-light ml-auto action-button" role="button" href="signup.php" style="margin:2px;margin-left:0px;background-color:rgb(75,91,91);">Sign Up</a>
						
						<?php } ?>
                </div>
            </div>
        </nav>
        <div class="container hero">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h1 class="text-center"></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="register-photo">
        <div class="form-container">
            <form method="post"  action="assets/php/register.php">
                <h2 class="text-center"><strong>Create</strong> an account.</h2>
                <div class="form-group"><input class="form-control" type="text" name="username" required placeholder="Username"></div>
                <div class="form-group"><input class="form-control" type="email" name="email" required placeholder="Email"></div>
               
			    <div class="form-group"><input onchange="check_pass();" class="form-control" type="password" required name="password" id="password" placeholder="Password"></div>
                <label id="message" hidden="" style="color:red; font-size:small;">  Not matching password</label>
			    <div class="form-group"><input onchange="check_pass();" class="form-control" type="password" name="password-repeat" id="confirm_password" placeholder="Password (repeat)"></div>
                <!--  
				<div class="form-group"><input class="form-control" type="date" required name="birthdate"></div>
               -->
			    <label id="message" hidden="" style="color:black; font-size:small;">This is hte question users should to follow you in audio mood</label>
			    <div class="form-group"><input required   class="form-control" type="text" name="squestion" placeholder="Write Your Question Here"></div>
                
				<div class="form-group"><input required  class="form-control" type="password" name="sanswer" placeholder="Write Your Secret Answer Here"></div>
                
				<div class="form-group"><textarea class="form-control" wrap="hard" name="about" placeholder="Talk about yourself here a little bit" style="height:108px;"></textarea></div>
                <div class="form-group">
                  <!--   <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox">I agree to the license terms.</label></div> -->
                </div>
                <div class="form-group"><button id="submit" class="btn btn-primary btn-block" type="submit">Sign Up</button></div>
				<a href="login.php" class="already">You already have an account? Login here.</a></form>
        </div>
    </div>
    <div class="projects-horizontal"></div>
	<!--  
	 
	
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
	 -->
	
	<script>
	function check_pass() {
    if (document.getElementById('password').value ==
            document.getElementById('confirm_password').value) {
        document.getElementById('submit').disabled = false;
		document.getElementById('message').hidden = true;
    } else {
        document.getElementById('submit').disabled = true;
		document.getElementById('message').hidden = false;
    }
}
	

	
	</script>
	
	
</body>

</html>