<?php session_start(); ?>
<?php
require_once 'assets/php/include/DB_Functions.php';
if(!isset($_SESSION['id'])){
header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

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
	
		<!-- emoji style sheet -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="assets/emoji/lib/css/emoji.css" rel="stylesheet">
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
                        <li class="nav-item" role="presentation"><a class="nav-link" href="notifications.php">Notifications</a></li>
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
    <div class="register-photo">
        <div class="form-container">
            <form method="post" action="assets/php/postt.php">
                <h2 class="text-center"><strong>Post</strong></h2>

				<?php if(isset($_POST['PID'])){ ?>
				<input type="hidden" name="to_id" value="<?php echo $_POST['PID']; ?>">
				
				<?php } ?>
				
                <div class="form-group"><input required class="form-control" type="text" name="b1" placeholder="You Should At Least Block One User; Blocked User Can't View The Post"></div>
                <!-- 
					
				<div class="form-group"><input class="form-control" type="text" name="b2" placeholder="Block User"></div>
                <div class="form-group"><input class="form-control" type="text" name="b3" placeholder="Block User"></div>
                 
				
				<div class="form-group">
				
				<textarea class="form-control" wrap="hard" data-emoji-input="unicode" name="content" data-emojiable="true" placeholder="Write Your Emotions Here" style="height:108px;"></textarea>
				
				</div>
                  -->
				 <!-- 
					
				emoji text area
                 --> 
				 
				 

            <p class="lead emoji-picker-container">
              <textarea required class="form-control textarea-control" wrap="hard" name="content" rows="3" placeholder="Write Your Emotions Here" style="height:108px;" data-emojiable="true" data-emoji-input="unicode"></textarea>
			  
            </p>
   
				 
				 
				  <!-- 
					
				end of emoji text area
                 --> 
				 
				 
				<div class="form-group"><button class="btn btn-primary btn-block" type="submit">Post</button></div>
            </form>
        </div>
    </div>
    <div class="projects-horizontal"></div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	<!-- begin of emoji--> 
	    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Begin emoji-picker JavaScript -->
    <script src="assets/emoji/lib/js/config.js"></script>
    <script src="assets/emoji/lib/js/util.js"></script>
    <script src="assets/emoji/lib/js/jquery.emojiarea.js"></script>
    <script src="assets/emoji/lib/js/emoji-picker.js"></script>
    <!-- End emoji-picker JavaScript -->

    <script>
      $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: 'assets/emoji/lib/img/',
          popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
      });
    </script>
    <script>
      // Google Analytics
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-49610253-3', 'auto');
      ga('send', 'pageview');
    </script>
	<!-- end of emoji--> 
	
	
	<!--
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
	 end of emoji--> 
</body>

</html>