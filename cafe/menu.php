<!DOCTYPE html>
<html>
<head>
  <title>Cafe</title>
  <link rel="stylesheet" type= "text/css" href="style.css" />
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





<div id="items">


<?php
$about = array("
An affogato is a simple dessert coffee that is treat during summer and after dinner. It is made by placing one big scoope of vanilla ice cream within a single or double shot of espresso:

• Add one scoop of vanilla ice-cream into a tumbler glass milk• Pour a single or double shot of espresso over the vanilla ice-cream

Barista Tip: If you feel like an irish kick add a shot of Frangelico liqueur into the mix.",
 "
The espresso (aka “short black”) is the foundation and the most important part to every espresso based drink. So much so that we’ve written a guide on how to make the perfect espresso shot. But for the purposes of this post an espresso consists of:

• 1 Shot of espresso in an espresso cup", 
"
A café latte, or “latte” for short, is an espresso based drink with steamed milk and micro-foam added to the coffee. This coffee is much sweeter compared to an espresso due to the steamed milk. It is made as follows:

• Extract 1 shot of espresso into a tumbler glass• Add steamed milk• 1cm of micro-foam on top of the steamed milk

Barista tip: In the USA it is common to use a cup instead of a tumbler glass for a latte.
", 
"
A long macchiato is the same as a short macchiato but with a double shot of espresso. The same rule of thirds applies in the traditionally made long macchiato:

• 2 shots of espresso in a tumbler glass or cup• A dollop of steamed milk and foam placed on top of the espresso

Barista tip: The key to making the perfect three layers is to place the dollop of steamed milk and foam on top of the espresso and then gently turning the cup clockwise a few times to mix the milk and espresso.", 
"
A mocha is a mix between a cappuccino and a hot chocolate. It is made by putting mixing chocolate powder with an espresso shot and then adding steamed milk and micro-foam into the beverage. The steps are as follows:

• Extract 1 shot of espresso into a cup• Add one spoon of chocolate powder into the espresso shot and mix• Add steamed milk• Add 2-3cm of micro-foam• Sprinkle chocolate powder on t
");
$count = 1;
while($count < 6) {
?>

<div id="item" style="width:96%;">

<img style="float: left; margin-right:30px;" src="images/<?php echo $count; ?>.jpg" alt="<?php  echo $count; ?>"  width="350" height="250">

  
<p style="font-size:30px;">
<?php echo $about[$count-1];    ?>
</p>

</div>
<?php $count = $count +1; } ?>



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