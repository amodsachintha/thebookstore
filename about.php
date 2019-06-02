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

<h1 style='text-align: center ;color: gray;;'>About Us</h1>
<h3>Who are we?</h3>
<p>
Welcome to THE BOOKSTORE,One of the sri Lanka's leading specialist online bookstore. We're proud to offer various kinds of titles, all at unbeatable prices with free delivery worldwide to over 100 countries. Whatever your interest or passion, you'll find something interesting in our bookshop full of delights.</p>
<p>
<h3>How is it going?</h3>
<p>
THE BOOKSTORE is the fastest growing bookseller in Sri Lanka, shipping to thousands of customers every day throughout the world from our fulfilment centre in Malabe, Sri Lanka. We have over a million customers and a reputation for extremely high service levels.
</p>

<h3>Return Policy Instructions</h3>
<p>
Include the packing slip and receipt (receipt can be reprinted on the order history page) with your return. Repackage your item(s) in the original packaging or in an appropriate cardboard box. Select a carrier that offers you the option to insure and track your package.  Insuring and tracking your package protects you as the shipper and helps ensure your shipment goes to the correct destination in the same condition it was as when you sent it. Write down your tracking number and keep it until THE BOOKSTORE has refunded your money. 
</p>
<p>
Ship your return to the following address:<br>

Sri Lankan Institute of Information Technology <br>
Malabe-10115 <br>
Sri Lanka <br>
</p>
<p>
Arrange for a carrier to pick up your package or drop it off with the carrier. Shipping is the responsibility of the customer and is not refundable, unless due to our error. No credit is given for lost or damaged packages in route to THE BOOKSTORE. Please insure and track your package. Returns to THE BOOKSTORE will be refunded to the original credit card or account used for payment unless a different payment option was selected. A refund will be posted to your credit card or account once your return is received and processed. Processing times for returns vary, and may take up to 30 days from the day the return is received for a credit to be transmitted to your credit card or account. It normally takes 2-10 business days for financial institutions to process the transmitted credit request.
</p>
<h3>Contact THE BOOKSTORE</h3>

<p>
For media inquiries only:amod@gmail.com<br>
For customer service: jeewaka@gmail.com<br>
For queries regarding selling on THE BOOKSTORE: sarith@gmail.com<br>
Registered office address:<br>
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