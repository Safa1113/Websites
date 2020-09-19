<?php session_start(); ?>
<?php
require_once 'assets/php/include/DB_Functions.php';
$db = new DB_Functions();
if(!isset($_SESSION['id'])){
header("Location: indexa.php");
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
    <link rel="stylesheet" href="assets/css/Header-Darka.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Projects-Horizontal.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
	
	
	
	
<!-- Website Design By: www.happyworm.com -->
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="assets/jPlayer-2.9.2/dist/skin/blue.monday/css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="assets/jPlayer-2.9.2/lib/jquery.min.js"></script>
<script type="text/javascript" src="assets/jPlayer-2.9.2/dist/jplayer/jquery.jplayer.min.js"></script>








<!-- javascript player start -->

<script type="text/javascript">
//<![CDATA[

$(document).ready(function(){


<?php
	if(isset($_SESSION['id'])){
		
		// $user6 = $db->getUserIDByName($_GET['username']);
		
		
		   $user4 = $db->notifya($_SESSION['id']);
		
	
		
		if ($user4) {
   
            $count = 0;
            
           while ($count < $user4 ["count"]){
		 
     ?>     
		  
		  
 
 


var x<?php echo $user4[$count]["ID"];   ?> = document.getElementById("content<?php echo $user4[$count]["ID"];   ?>").value;

	$("#jquery_jplayer_<?php echo $user4[$count]["ID"];   ?>").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", {
				title:"<?php echo $user4[$count]["ID"];   ?>",
		//mp3:"http://www.jplayer.org/audio/mp3/Miaow-07-Bubble.mp3",
		//oga:"http://www.jplayer.org/audio/ogg/Miaow-07-Bubble.ogg"
		
		wav: x<?php echo $user4[$count]["ID"];   ?>
			});
		},
		play: function() { // To avoid multiple jPlayers playing together.
			$(this).jPlayer("pauseOthers");
			
			<?php $user5 = $db->isUserfollowinga($_SESSION['id'], $user4[$count]["writer"]); ?>
			<?php  if (!($user5 || ($_SESSION['id'] == $user4[$count]["writer"]))) { ?>
			$(this).jPlayer("option","playbackRate", 2.0);
			<?php }  ?>
			
		},
		
		//swfPath: "../../js",
		cssSelectorAncestor: "#jp_container_<?php echo $user4[$count]["ID"];   ?>",
		
		globalVolume: true,

		
		//swfPath: "../../dist/jplayer",
		swfPath: "assets/jPlayer-2.9.2/dist/jplayer",
		
		//supplied: "mp3,oga",
		supplied: "wav",
		wmode: "window",
		useStateClassSkin: true,
		autoBlur: false,
		smoothPlayBar: true,
		keyEnabled: true,
		remainingDuration: true,
		toggleDuration: true
	});
	
	
	
					<?php
			 $count = $count + 1 ;
		      }
		  
		  
		
		   }
		   
		   
		 
		   }
		
		?>
	
	
	
});
//]]>
</script>
 
 
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
            <div class="container"><a class="navbar-brand" href="indexa.php">Mood</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse"
                    id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="notifications.php">Notifications</a></li>
                    </ul><a class="btn btn-light btn-block ml-auto action-button" role="button" href="posta.php" style="margin:4px;margin-left:0px;">Post</a>
					
					<?php
if(isset($_SESSION['id'])){
?>
<a class="btn btn-light ml-auto action-button" role="button" href="profilea.php?username=<?php echo $_SESSION['username'];?>" style="margin:2px;margin-left:0px;background-color:rgb(75,91,91);">Profile</a>
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
            <div class="intro">
                <h2 class="text-center">Notifications</h2>
                <p class="text-center">Here You Find All Your Notifications</p>
            </div>
        </div>
    </div>
	
	
	
	
	
    <div class="container">
	
			<?php
		
			if(isset($_SESSION['id'])){
		
		$user4 = $db->notifya($_SESSION['id']);
		
		if ($user4) {
   
            $count = 0;
            
           while ($count < $user4 ["count"]){
		 
             $wname = $db->getUserNameByID($user4[$count]["writer"]);
 
 
		
		
		?>
	
	
	
        
		
		
<!-- row start
 -->
	
	
        <div class="row">
            <div class="col">
			
                <a href="profilea.php?username=<?php echo $wname;?>"><h1 style="font-size:30px;"><?php echo $wname;   ?></h1></a>
				
				
				


<!-- player start
 -->




<div id="jquery_jplayer_<?php echo $user4[$count]["ID"];   ?>" class="jp-jplayer"></div>
<div id="jp_container_<?php echo $user4[$count]["ID"];   ?>" class="jp-audio" role="application" aria-label="media player">
	<div class="jp-type-single">
		<div class="jp-gui jp-interface">
			<div class="jp-controls">
				<button class="jp-play" role="button" tabindex="0">play</button>
				<button class="jp-stop" role="button" tabindex="0">stop</button>
			</div>
			<div class="jp-progress">
				<div class="jp-seek-bar">
					<div class="jp-play-bar"></div>
				</div>
			</div>
			<div class="jp-volume-controls">
				<button class="jp-mute" role="button" tabindex="0">mute</button>
				<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
				<div class="jp-volume-bar">
					<div class="jp-volume-bar-value"></div>
				</div>
			</div>
			<div class="jp-time-holder">
				<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
				<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
				<div class="jp-toggles">
					<button class="jp-repeat" role="button" tabindex="0">repeat</button>
				</div>
			</div>
		</div>
		<div class="jp-details">
			<div class="jp-title" aria-label="title">&nbsp;</div>
		</div>
		<div class="jp-no-solution">
			<span>Update Required</span>
			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
		</div>
	</div>
</div>



<form>
			<input type="hidden" id="content<?php echo $user4[$count]["ID"];   ?>" value="<?php echo "assets/sounds/".$user4[$count]["writer"]."/".$user4[$count]["content"].".wav";   ?>">
				
		     </form>

<!-- player end

 -->


 
 
 
 
<br/>


	<small style="margin-left:30px;font-size:15px;">Date : <?php echo $user4[$count]["date_"];   ?></small>
				<a href="reply.php?PID=<?php echo $user4[$count]["writer"];?>"><small style="margin-left:30px;font-size:15px;">Replies : <?php echo $user4[$count]["replies"];   ?></small></a>
				<small style="margin-left:30px;font-size:15px;">likes : <?php echo $user4[$count]["likes"];   ?></small>
				</br>

			</br>
			</br>
			<form action="posta.php" method="post">
			<input name="PID" type="hidden" value="<?php echo $user4[$count]["ID"];   ?>">
				<button style="float: left;" type="submit" class="btn btn-primary" type="button">Reply</button>
		     </form>
				
				<form action="assets/php/likea.php" method="post">
			<input name="PID" type="hidden" value="<?php echo $user4[$count]["ID"];   ?>">
			<input name="user" type="hidden" value="<?php echo $_SESSION['id'];   ?>">
				<button type="submit" class="btn btn-primary" type="button" style="margin-left:12px;">Like</button>
				 </form>


			</div>
        </div>
		
		<br/><br/>
		
		<!-- row end
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
		 <h5 class="text-center">No Notifications For You Yet!!</h5>
		 </br></br>
		</div>
		<!-- end of else action -->
		  
		<?php
		  
		   
		   }
		   
		 
		   }else echo "no user registered";
		
		?>
		
		
		
		
		
		
		
		
		
		
		
		
		
    </div>
	
	
	
	
	
	
	
	<!-- Website Design By: www.happyworm.com
   <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
 -->
 
</body>

</html>