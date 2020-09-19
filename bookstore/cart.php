<?php 
include 'dbh.php';
session_start();
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
	
	
<script type="text/javascript">
        
            function deletecart() {
               alert("Item has been deleted")
            }
        
</script>
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
    <div class="article-clean">
        <div class="container">
		<?php
if(isset($_SESSION['id'])){
$uid = $_SESSION['id'];
$sql = "select * from cart, books where u_id='$uid' and books.Id=p_id";
$result = mysqli_query($conn, $sql);



while($row = mysqli_fetch_assoc($result)) {
?>
            <!-- start of row -->
            <div class="row">
                <div class="col-lg-10 col-xl-8 offset-lg-1 offset-xl-2">
                    <div class="intro">
                        <h1 class="text-center"><?php echo $row["title"]; ?></h1>
                        <p class="text-center"></p>
						<img class="img-fluid" src="assets/img/books/<?php echo $row["Id"]; ?>.jpg"></div>
                    <div class="text">
                        
                        <h3 class="text-center"><?php echo $row["writer"]; ?></h3>
                        <h4 class="text-center">Price : <?php echo $row["Price"]; ?>$</h4>
						<?php if(isset($_SESSION['id'])){?>
						<form class = "addToCart" action="deletefromcart.php" method="post" >
						<input type="hidden" name="id" value=<?php echo $row["Id"];?>>
						<button class="btn btn-success float-none justify-content-center" type="submit" style="width:300px;margin:0px;margin-left:230px;margin-right:230px;">Delete From Shopping Cart</button>
						</form>
						<?php } else {?>
						<h4 class="text-center">Login to Add to cart></h4>
						<?php }?>
						</div>
                </div>
            </div>
			<!-- end of row -->
			<hr>
			<?php } } else { header ("Location: index.php"); }?>
			
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