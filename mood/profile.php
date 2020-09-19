<?php session_start(); ?>
<?php
require_once 'assets/php/include/DB_Functions.php';
$db = new DB_Functions();
if(!isset($_GET['username'])){
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
    <link rel="stylesheet" href="assets/css/Header-Darkt.css">
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
    <div>
        <div class="header-dark">
            <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search">
            <div class="container"><a class="navbar-brand" href="index.php">Mood</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse"
                    id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="notifications.php">Notifications</a></li>
                    </ul><a class="btn btn-light btn-block ml-auto action-button" role="button" href="postt.php" style="margin:4px;margin-left:0px;">Post</a>
					
					<?php
if(isset($_SESSION['id'])){
?>
	<?php if(($_GET['username'] == $_SESSION['username'])){
				?>
<a class="btn btn-light ml-auto action-button" role="button" href="editprofile.php" style="margin:2px;margin-left:0px;background-color:rgb(75,91,91);">Edit Profile</a>

<?php  }  else {?>
<a class="btn btn-light ml-auto action-button" role="button" href="profile.php?username=<?php echo $_SESSION['username'];?>" style="margin:2px;margin-left:0px;background-color:rgb(75,91,91);">Profile</a>
<?php  }  ?>

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
    </div>
    <div class="projects-horizontal">
        <div class="container">
		
		
		
		<?php
		
		
		if(isset($_SESSION['username'])){
		if(isset($_GET['username'])){
		

		  $user = $db->returnusert($_GET['username']);
		  if ($user) {
		
		$user5 = $db->getUserIDByName($_GET['username']);
		 $user2 = $db->isUserfollowingt($_SESSION['id'], $user5);
		  
		
		?>
		
		
		
		
		
            <div class="intro">
                <h2 class="text-center"><?php echo $user["name"];   ?></h2>
                <p class="text-center" style="font-size:20px;">Date of Signup : <?php echo $user["dateOfSignup"];   ?></p>
				<p class="text-center" style="font-size:20px;">About : <?php echo $user["about"];   ?></p>
				<?php  if ($user2) { ?>
                <a class="btn btn-light btn-block ml-auto action-button" role="button" href="" style="margin:4px;margin-left:0px;background-color:rgb(153,176,174);">You're following</a>
                
				
				<?php  } else if($_GET['username'] == $_SESSION['username']){
				}
				 else {?>
				<form action="assets/php/followt.php" method="post">
				  <input name="follows" type="hidden" value="<?php echo $_GET['username'];   ?>">
				  <input name="inMood" type="hidden" value="<?php echo "text"   ?>">
				    <input name="IAM" type="hidden" value="<?php echo $_SESSION['id'];   ?>">
					
				<button type="submit" class="btn btn-light btn-block ml-auto action-button" role="button"  style="margin:4px;margin-left:0px;background-color:rgb(153,176,174);">
				Follow
				</button>
				</form>
				<?php } ?>
				
				 <!-- start of message 
				<form action="message.php" method="post">
				  <input name="to" type="hidden" value="<?php echo $_GET['username'];   ?>">
				    <input name="IAM" type="hidden" value="<?php echo $_SESSION['id'];   ?>">
					
				<button type="submit" class="btn btn-light btn-block ml-auto action-button" role="button"  style="margin:4px;margin-left:0px;background-color:rgb(153,176,174);">
				Send Message
				</button>
				</form>
				-->
				
				</div>
	   <?php
	   
	     }else ;
		  }else ;
		  }else ;
	   
	   ?>
	   
	    </div>
    </div>
        <div class="container">
	
		<?php
		
		if(isset($_SESSION['username'])){
		if(isset($_GET['username'])){
		
		$user6 = $db->getUserIDByName($_GET['username']);
		
		if($_GET['username'] == $_SESSION['username'])
		   $user4 = $db->returnut($user6);
		   else
		   $user4 = $db->returnt($user6);
		
		if ($user4) {
   
            $count = 0;
            
           while ($count < $user4["count"]){
		 
           $wname = $db->getUserNameByID($user4[$count]["writer"]);
 
 
		
		
		?>
		
		
		<!-- start of row
					 --> 
	
        <div class="row">
		
		
            <div class="col">
			
                <a href="profile.php?username=<?php echo $wname;?>"><h1 style="font-size:30px;"><?php echo $wname;   ?></h1></a>
				
                <p><?php echo $user4[$count]["content"];?></p>
				
			
					<small style="margin-left:30px;font-size:15px;">Date: <?php echo $user4[$count]["date_"];   ?></small>
				<a href="reply.php?PID=<?php echo $user4[$count]["ID"];?>"><small style="margin-left:30px;font-size:15px;">Replies : <?php echo $user4[$count]["replies"];   ?></small></a>
				<small style="margin-left:30px;font-size:15px;">Likes: <?php echo $user4[$count]["likes"];   ?></small>
				</br>
				<small style="margin-left:30px;font-size:15px;">Blocked User: <?php echo $db->getUserNameByID($user4[$count]["b1"]);   ?></small>
              <!--  <small style="margin-left:30px;font-size:15px;"><?php echo $user4[$count]["b2"];   ?></small>
				<small style="margin-left:30px;font-size:15px;"><?php echo $user4[$count]["b3"];   ?></small>  -->
			</br>
			</br>
			
			
			<form s action="postt.php" method="post">
			<input name="PID" type="hidden" value="<?php echo $user4[$count]["ID"];   ?>">
				<button style="float: left;" type="submit" class="btn btn-primary" type="button">Reply</button>
		     </form>
				
				<form action="assets/php/liket.php" method="post">
			<input name="PID" type="hidden" value="<?php echo $user4[$count]["ID"];   ?>">
			<input name="user" type="hidden" value="<?php echo $_SESSION['id'];   ?>">
				<button type="submit" class="btn btn-primary" type="button" style="margin-left:12px;">Like</button>
				 </form>
				
		

					
					
					 <!-- 
					 -->
					
					</div>
      
       
	    </div>
		
		<br/><br/>
		 <!-- end of row
					 -->
	
     
		
		
			<?php
			 $count = $count + 1 ;
		      }
		  
		  
		
		   }
		   else { 
		   
		   
		   ?>
		  <!-- start of else action -->
		<div class="intro">
		</br></br>
		 <h5 class="text-center">User has no Posts</h5>
		 </br></br>
		</div>
		<!-- end of else action -->
		  
		<?php
		   
		   
		   }
		   
		   }else echo "no user is selected";
		   }else {
		   
		  ?>
		  <!-- start of else action -->
		<div class="intro">
		</br></br>
		 <h5 class="text-center">Please Login to View Users' Profiles</h5>
		 </br></br>
		</div>
		<!-- end of else action -->
		  
		<?php
		}
		?>
		
		
		
		
		
    </div>
	
	
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>