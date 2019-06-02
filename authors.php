
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
	<title>THE BOOKSTORE : Authors</title>
	<link rel="stylesheet" type="text/css" href="css/indexCss.css">
</head>
<body>
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
			echo "| <a href='admin.php'>manage</a>";
		}
	}

	echo "<form action='index.php' method='POST'>
		<input type='text' name='seachparam' size='15'>
		<input type='submit' name='search' value ='search'>
	</form>

	";



	    ?>
</div>
<div class="cat">
<!-- **categories** 
<h3> &nbsp;GENRE </h3>-->
	<ul>
		<?php 
			listCat();
		 ?>
	</ul>
</div>
<div class="content">
<!-- **content** -->
<ul class="author">
	<?php
		listAuthors();
	?>
</ul>

</div>

<div class="footer2">
	<?php footer(); ?>
</div>

</div>

</body>
</html>