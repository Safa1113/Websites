<!DOCTYPE html>
<html>
<head>
  <title>Cafe</title>
  <link rel="stylesheet" type= "text/css" href="style.css" />
  <link rel="stylesheet" type= "text/css" href="contactform.css" />
  <link rel="stylesheet" type= "text/css" href="socialmedia.css">
<link rel="stylesheet" href="font-awesome.min.css">


</head>

<body>



<div class="frontbox">
<div id="title">
<h1>Cafe<h1/>

</div>
<div id="Nav">
<ul>
<li>
<a href="index.php">
Home
</a>
</li>
<li>
<a href="menu.php">
Menu
</a>
</li>
<li>
<a href="contact-us.php">
Contact Us
</a>
</li>


</ul>


</div>
 </div>



<div id="contact-form">


<div class="container">
<p>Our house blend is custom made by Rosso Roasting Co, a Melbourne based boutique roaster.

Rosso Roasting Co expertly hand roast & lovingly prepare each cup using only Rainforest Alliance & Fairtrade Organic coffee sourced from farming communities across South America, Central Africa & Indonesia.
For those looking for something different, we also offer other types of coffee, brewed in very special ways, including Cold Drip, Syphon & Pour Over.</p>
</br></br>
<h3>Contact Form</h3>
  <form method="post" action="contact.php">
    <label for="fname">First Name</label>
    <input required type="text" id="fname" name="firstname" placeholder="Your name..">

    <label for="lname">Last Name</label>
    <input required type="text" id="lname" name="lastname" placeholder="Your last name..">

	<label for="lname">Email</label>
    <input required type="text" id="email" name="email" placeholder="Your Email">

    <label for="subject">Subject</label>
    <textarea required id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

    <input type="submit" value="Submit">
  </form>
</div>
</div>



<div id="footer">
<!-- Add font awesome icons -->
<a href="https://www.facebook.com/" class="fa fa-facebook"></a>
<a href="https://twitter.com/" class="fa fa-twitter"></a>
<a href="https://www.youtube.com/" class="fa fa-youtube"></a>
<a href="https://www.instagram.com/" class="fa fa-instagram"></a>
<p>  &copy; All rights reserved 2018</p>
</div>



</body>
</html>