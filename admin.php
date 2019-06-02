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

	<title>THE BOOKSTORE: Admin</title>
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
	<a href="index.php"><img src="siteImg/logo_cropped.png" style="margin-left: 14px;"></a>
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

<?php 
if(isset($_SESSION['uid'])){
	if($_SESSION['uid'] == 101){

echo "
<head>
	<link rel='stylesheet' href='css/bookinfo.css'>

	<h1 style='font-size:40px;'>Maintenance</h1>
	<h1 style='font-size:25px;'>(Admin use only)</h1>
	<style>
		.panel a{
			text-decoration:none;
			color:blue;
		}

		.panel a:hover{
			text-decoration:underline;
			color:orange;
		}
	</style>

	</head>

	<body>
	<div class= 'panel' style='font-size:30px;'>
		<ul style='list-style-type:none;'>
			<li><a href='index.php'>Home</a></li>
			<li><a href='authors.php'>Authors</a></li>
			<li><a href='history.php'>Transactions</a></li>
			<li><a href='all.php'>All Books</a></li>
			<li><a href='bookinfo.php'>Adding books</a></li>
			<li><a href='profile.php'>Admin Profile</a></li>
			<li><a href='users.php'>All Users</a></li>
			</ul>
	</div>


	</body>
	</html>";



echo "<br><br>";



echo "<br><br><br><br><br><br>";

echo "</div><section class='footer'>
	
		 <div style='color:#808080;margin-bottom:20px;margin-right:50px;'> &copy;&nbsp;Copyright 2016 THE BOOKSTORE&trade;<br>All Right Reserved</div>
	
</section>";

}


else{


	echo "Look where you're going!!!";
}
}



