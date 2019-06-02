<?php 
	session_start();
	include_once 'php/functions.php'; 
	include("php/cartFunctions.php");
	
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" sizes="32x32" href="siteImg/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="siteImg/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="siteImg/favicon-16x16.png">

	<title>THE BOOKSTORE</title>
	<link rel="stylesheet" type="text/css" href="css/indexCss.css">
</head>
<body>
<script type="text/javascript">
	function hover(element) {
    	element.setAttribute('src', 'siteImg/ystar.jpg');
	}
	function unhover(element) {
    	element.setAttribute('src', 'siteImg/nstar.png');
	}

</script>

<script src="js/tinymce/tinymce.min.js"></script>
 <script>tinymce.init({

  selector:'textarea',
   menubar: false,
  statusbar: false,
  toolbar: 'undo redo | bold italic | alignleft aligncenter alignright',
  width : 600,
   plugins: [ "placeholder" ],
   body_class: 'my_class',
  content_css : 'css/texteditor.css'
});
  </script>

<div class="mainWrapper">
<div class="header">
<!-- **header** -->
	<a href="index.php"><img src="siteImg/logo_cropped.png"></a>
	<div class="menuBar">
		<ul class="menu">
			<li><a href="about.php">About</a></li>
<!--		<li><a href="view.php">All Books</a></li>	-->
		
			<li><a href="faq.php">FAQ</a></li>	
			<li><a href="authors.php">Authors</a></li>
			<?php if(isset($_SESSION['uid'])){
				echo "<li><a href='profile.php'>My Profile</a></li>";
			}
			?>
			<li><a href="index.php">Home</a></li>
		</ul>
	</div>
</div>

<div class="cartBar">
	<?php 
	if(isset($_SESSION['uid'])){
		addToCart();
	}
	?>
	
	<?php 
	
	if(isset($_SESSION['uid'])){
		$usrID = $_SESSION['uid'];
		echo "<strong><a href='profile.php'>".$_SESSION['username']."</strong></a>";


	}
	else{
		echo "<strong>guest </strong>| <a href='login.php'>login</a>";
	}
	?>
		
	  | <?php  
	if(isset($_SESSION['uid'])){
	 	echo "<a href='logout.php'>logout</a>";
	 } 
	 else{
	 	echo $date = date('Y/m/d');
	 }
	 
 if(isset($_SESSION['uid'])){
	   addCartId();
	   $citems = countCartItems();
	   echo" | <a href='cart.php'><img src='siteImg/cart.png' width='15'>cart($citems)</a> ";
	}
	
	if(isset($_SESSION['uid'])){
		if($_SESSION['uid'] == 101){
			echo "| <a href='bookinfo.php'>manage</a>";
		}
	}

	echo "<form action='index.php' method='POST'>
		<input type='text' name='seachparam' size='15'>
		<input type='submit' name='search' value ='search'>
	</form>

	";



	    ?>
</div>
<div>
<h1 style='text-align: center; color: gray;;'>FAQ</h1>

<h3>How do I place an order?</h3>
<p>First you need to set up an account, once that is created you are ready to place an order.</p>

<h3>How do I set up an account?</h3> 

<p>Click on the login button in under the title bar of the main page and then click on sign up button.</p>

<h3>How long does it take to process and ship orders?</h3>

<p>Please allow 2 - 3 business days (Monday-Friday) for order processing regardless of the shipping method chosen. Once shipped you should receive your order within 2 - 30 business days.</p>

<h3>Are all of the items guaranteed in stock?</h3>

<p>We try to update the website as often as possible to reflect out of stock conditions.</p>

<h3>I can't find a specific item on the website, are there items available that are not listed on the website?</h3>

<p>The items that are currently shown on our website represent what is currently available to view and order online.</p>

<h3>How can I check the status of my order?</h3>

<p>If you have registered for an account at THE BOOKSTORE, click on "My Account" and login with your email address and password. You can view the status of any orders that were made while you were signed in. </p>

<h3>How can I cancel or change my order?</h3>

<p>Befor downloading usually you have to add the selected items which you are going to buy to the cart.Befor pay for the items which you have selected you can check the list and ,if you are not intrest in buying one of them in the list click on the "delete" button.</p>

<h3>How much is the shipping charge on orders?</h3>

<p>The shipping charge depends on the shipping method chosen.Usually we ship books freely. </p>

<h3>What is your shipping method?</h3>

<p>All the shipping methods will appear to you when you place the order. </p>

<h3>What is your return policy?</h3>

<p>You may return items purchased within 30 days from the day you received your order and receive a full refund. Refund will be credited to original credit card used for payment.  Please see return policy instructions given  for additional information.</p>

<h3>How do I return an item?</h3>

<p>A copy of packing list/receipt and completed return form must be included with each return. Returns missing this information can not be credited.All items must be returned in the original condition. </p>

<h3>Where do I send my return?</h3>
<p>
Sri Lankan Institute of Information Technology <br>
Malabe-10115 <br>
sri Lanka <br>
</p>

</div>
<div class="footer">
	<?php footer(); ?>
</div>

</div>

</body>
</html>