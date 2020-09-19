<?php 
include 'dbh.php';
session_start();
if(isset($_SESSION['id']))
{ header ("Location: index.php"); }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopping</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="assets/css/Article-Clean.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <header>
         <nav class="navbar navbar-light navbar-expand-md">
            <div class="container-fluid"><a class="navbar-brand" href="index.php">Brand</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse"
                    id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="cart.php">My Shopping Cart</a></li>
						<?php
if(isset($_SESSION['id'])){
?>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Logout</a></li>
						<?php } else {?>
						<li class="nav-item" role="presentation"><a class="nav-link" href="register.php">SignUp</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="login.php">Login</a></li>
						<?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="simple-slider">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background-image:url(assets/img/1.jpg);"></div>
                <div class="swiper-slide" style="background-image:url(assets/img/2.jpg);"></div>
                <div class="swiper-slide" style="background-image:url(assets/img/3.jpeg);"></div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
    <div class="register-photo">
        <div class="form-container">
            <div class="image-holder"></div>
            <form method="post" action="registerform.php">
                <h2 class="text-center"><strong>Create</strong> an account.</h2>
				<div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username"></div>
                <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
                <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Sign Up</button></div><a href="login.php" class="already">You already have an account? Login here.</a></form>
        </div>
    </div>
    <div class="footer-basic">
        <footer>
            <p class="copyright">BookStore © 2018</p>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assets/js/Simple-Slider1.js"></script>
</body>

</html>