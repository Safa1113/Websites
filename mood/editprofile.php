<?php session_start(); ?>
<?php
require_once 'assets/php/include/DB_Functions.php';
$db = new DB_Functions();
if(!isset($_SESSION['id'])){
header("Location: index.php");
}
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
            <div class="container"><a class="navbar-brand" href="index.php">Mood</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse"
                    id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="notificationsa.php">Notifications</a></li>
                    </ul><a class="btn btn-light btn-block ml-auto action-button" role="button" href="posta.php" style="margin:4px;margin-left:0px;">Post</a>
					
					<?php
if(isset($_SESSION['id'])){
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
	
	
	<?php
		
		
		if(isset($_SESSION['username'])){
		

		  $user = $db->returnupdateinfo($_SESSION['username']);
		  if ($user) {
		
		  
		
		?>
		
	
	
	
	
	
    <div class="register-photo">
        <div class="form-container">
		
		<!--  username -->
            <form method="post"  action="assets/php/editprofile.php">
                <h2 class="text-center"><strong>Update</strong> your Username.</h2>
				
				<div class="form-group"><input disabled required id="usernamefield" class="form-control" type="text" name="username" placeholder="Username: <?php echo $user["name"];   ?>"></div>
				
               
				
				
				<div class="form-group">
				<button id="UpdateUsername" class="btn btn-primary btn-block" onclick="updateUsername();" type="button">Edit Username</button>
				</div>
				
                <div  class="form-group"><button hidden id="submitUsername" class="btn btn-primary btn-block" type="submit">Update</button></div>
				
				<input type="hidden" name="email" value = "<?php echo $user["email"];?>">
				<input type="hidden" name="squestion" value = "<?php echo $user["secretQuestion"];?>">
				<input type="hidden" name="sanswer" value = "<?php echo $user["secretAnswer"];?>">
				<input type="hidden" name="about" value = "<?php echo $user["about"];?>">
				<input type="hidden" name="encrypted_password" value = "<?php echo $user["encrypted_password"];?>">
				<input type="hidden" name="salt" value = "<?php echo $user["salt"];?>">
				<input type="hidden" name="flag" value = "0">
				
				<input type="hidden" name="id" value = "<?php echo $_SESSION['id'];?>">
				

				</form>
				</div>
				
				<!--  email -->
				
				<div class="form-container">
				
				<form method="post"  action="assets/php/editprofile.php">
                <h2 class="text-center"><strong>Update</strong> your Email.</h2>
				
				<div class="form-group"><input id="emailfield" disabled required class="form-control" type="email" name="email" placeholder="Email: <?php echo $user["email"];   ?>"></div>
               
				
				
				<div class="form-group">
				<button id="UpdateEmail" class="btn btn-primary btn-block" onclick="updateEmail();" type="button">Edit Email</button>
				</div>
				
                <div  class="form-group"><button hidden id="submitEmail" class="btn btn-primary btn-block" type="submit">Update</button></div>
				
				<input type="hidden" name="username" value = "<?php echo $_SESSION['username'] ?>">
				<input type="hidden" name="squestion" value = "<?php echo $user["secretQuestion"];?>">
				<input type="hidden" name="sanswer" value = "<?php echo $user["secretAnswer"]?>">
				<input type="hidden" name="about" value = "<?php echo $user["about"]?>">
				<input type="hidden" name="encrypted_password" value = "<?php echo $user["encrypted_password"]?>">
				<input type="hidden" name="salt" value = "<?php echo $user["salt"]?>">
				<input type="hidden" name="flag" value = "0">
				
				<input type="hidden" name="id" value = "<?php echo $_SESSION['id'];?>">
			
				</form>
				
				<!--  password  -->
				<form method="post"  action="assets/php/editprofile.php">
                <h2 class="text-center"><strong>Update</strong> your Password.</h2>
				
               
				<div class="form-group"><input disabled required id="password" onchange="check_pass();" class="form-control" type="password" name="password" placeholder="Password"></div>
                <div class="form-group"><input disabled required id="confirm_password" onchange="check_pass();" class="form-control" type="password" name="password-repeat" placeholder="Password (repeat)"></div>
                
				
				
				<div class="form-group">
				<button id="UpdatePassword" class="btn btn-primary btn-block" onclick="updatePassword();" type="button">Edit Password</button>
				</div>
				
                <div  class="form-group"><button hidden id="submitPassword" class="btn btn-primary btn-block" type="submit">Update</button></div>
				
				<input type="hidden" name="username" value = "<?php echo $_SESSION['username'] ?>">
				<input type="hidden" name="email" value = "<?php echo $user["email"];?>">
				<input type="hidden" name="squestion" value = "<?php echo $user["secretQuestion"];?>">
				<input type="hidden" name="sanswer" value = "<?php echo $user["secretAnswer"]?>">
				<input type="hidden" name="about" value = "<?php echo $user["about"]?>">

				<input type="hidden" name="flag" value = "1">
				
				<input type="hidden" name="id" value = "<?php echo $_SESSION['id'];?>">
			
				</form>
				
								</div>
								

								<div class="form-container">
								
											<!--  Secret Question and Answer -->
			
				
				<form method="post"  action="assets/php/editprofile.php">
                <h2 class="text-center"><strong>Update</strong> your Q&A.</h2>
				

               
			   	<div class="form-group"><input disabled required id="sqfield" class="form-control" type="text" name="squestion" placeholder="Secret Question: <?php echo $user["secretQuestion"];   ?>"></div>
                <div class="form-group"><input disabled required id="safield" class="form-control" type="password" name="sanswer" placeholder="Secret Answer: <?php echo $user["secretAnswer"];   ?>"></div>
               
				
				
				<div class="form-group">
				<button id="UpdateSecret" class="btn btn-primary btn-block" onclick="updateSecret();" type="button">Edit Question and Answer</button>
				</div>
				
                <div  class="form-group"><button hidden id="submitSecret" class="btn btn-primary btn-block" type="submit">Update</button></div>
				
				<input type="hidden" name="username" value = "<?php echo $_SESSION['username'] ?>">
				<input type="hidden" name="email" value = "<?php echo $user["email"];?>">
				<input type="hidden" name="about" value = "<?php echo $user["about"]?>">
				<input type="hidden" name="encrypted_password" value = "<?php echo $user["encrypted_password"]?>">
				<input type="hidden" name="salt" value = "<?php echo $user["salt"]?>">
				<input type="hidden" name="flag" value = "3">
				
				<input type="hidden" name="id" value = "<?php echo $_SESSION['id'];?>">
			
				</form>
								
                       </div>
								

								<div class="form-container">
								
								
								<!--  about -->
							<form method="post"  action="assets/php/editprofile.php">
                <h2 class="text-center"><strong>Update</strong> your Bio.</h2>
				

               <div class="form-group"><textarea id="aboutfield" disabled required class="form-control" wrap="hard" name="about" placeholder="About: <?php echo $user["about"];   ?>" style="height:108px;"></textarea></div>

				
				
				<div class="form-group">
				<button id="UpdateAbout" class="btn btn-primary btn-block" onclick="updateAbout();" type="button">Edit Bio</button>
				</div>
				
                <div  class="form-group"><button hidden id="submitAbout" class="btn btn-primary btn-block" type="submit">Update</button></div>
				
				<input type="hidden" name="username" value = "<?php echo $_SESSION['username'] ?>">
				<input type="hidden" name="email" value = "<?php echo $user["email"];?>">
				<input type="hidden" name="squestion" value = "<?php echo $user["secretQuestion"];?>">
				<input type="hidden" name="sanswer" value = "<?php echo $user["secretAnswer"]?>">
				<input type="hidden" name="encrypted_password" value = "<?php echo $user["encrypted_password"]?>">
				<input type="hidden" name="salt" value = "<?php echo $user["salt"]?>">
				<input type="hidden" name="flag" value = "0">
				
				<input type="hidden" name="id" value = "<?php echo $_SESSION['id'];?>">
			
				</form>	
								
								
							
        </div>
    </div>
	
		<?php
		
		
	}}
		  
		
		?>
	
    <div class="projects-horizontal"></div>
	
<!--  
	 
	
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
	 -->
					<script>
	function updateUsername() {
  
        document.getElementById('usernamefield').disabled = false;
		document.getElementById('UpdateUsername').hidden = true;
		document.getElementById('submitUsername').hidden = false;

}

	function updateAbout() {
  
        document.getElementById('aboutfield').disabled = false;
		document.getElementById('UpdateAbout').hidden = true;
		document.getElementById('submitAbout').hidden = false;

}

	function updateEmail() {
  
        document.getElementById('emailfield').disabled = false;
		document.getElementById('UpdateEmail').hidden = true;
		document.getElementById('submitEmail').hidden = false;

}

	function updatePassword() {
  
        document.getElementById('password').disabled = false;
		document.getElementById('confirm_password').disabled = false;
		document.getElementById('UpdatePassword').hidden = true;
		document.getElementById('submitPassword').hidden = false;

}	
	function updateSecret() {
  
        document.getElementById('sqfield').disabled = false;
		document.getElementById('safield').disabled = false;
		document.getElementById('UpdateSecret').hidden = true;
		document.getElementById('submitSecret').hidden = false;

}

	
	</script>
	<script>
	function check_pass() {
    if (document.getElementById('password').value ==
            document.getElementById('confirm_password').value) {
        document.getElementById('submitPassword').disabled = false;
		document.getElementById('message').hidden = true;
    } else {
        document.getElementById('submitPassword').disabled = true;
		document.getElementById('message').hidden = false;
    }
}
	

	
	</script>
</body>

</html>