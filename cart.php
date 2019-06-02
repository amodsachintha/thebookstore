<?php
session_start();
include("php/conf.php");
include("php/cartFunctions.php");



?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">

		body{
			width: 800px;
			height: auto;
			margin: 10px auto;
		
		}

		body{
			font-family: monospace;
			font-size: 13px;
		}
		.tablecart{
			width: 800px
			height:auto;
			margin: 10px auto;
		}

		.img{
			margin-top: 20px;
			margin-left: 264px;
		}
		table{
			border-collapse: collapse;
		}

		.cartBar{
			width: 830px;
			height: 65px;
			margin-bottom: 15px;
			display: inline-block;
			float: left;
			font-family: monospace;
			font-size: 13px;
			text-align: center;
			color: black;
			line-height: 34px;
		}
		.cartBar a{

			text-decoration: none;
			color: black;
		}

		.cartBar a:hover{
			text-decoration: underline;
			color: green;
		}

		.link tr td a{
			text-decoration: none;
			color: blue;
		}

		.link tr td a:hover{
			text-decoration: underline;
			color: orange;
		}

	</style>
	<title>cart</title>
	
</head>
<body>

<div class="img">
	<a href="index.php"> <img src="siteImg/logo_cropped.png"> </a>
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

		echo "<form action='index.php' method='POST'>
		<input type='text' name='seachparam' size='15'>
		<input type='submit' name='search' value ='search'>
	</form>

	";

	    ?>
</div>






<div class="tablecart">
<table cellpadding="10px" cellspacing="10px" width="800px" class="link">
	<tr style="border-bottom: 1pt solid grey;">
		<td><u>isbn</u></td>
		<td> </td>
		<td><u>title</u></td>
		<td><u> ship quantity</u></td>
		<td><u>price</u></td>

	</tr>
	<?php 
		viewCart();
		removefromcart();
		editquantity();
	?>
	<tr>
		<td> </td>
		<td> </td>
		<td> </td>
		<td><a href="index.php">
		<button>go home</button>
		</a>
		</td>

		<td>
<?php 
$ci = countCartItems();
if($ci != 0){
echo "<a href='checkout.php'>
		<button style='margin-left:10px;''>checkout</button>
		</a>";
	}


?>
		</td>
	</tr>

</table>
</div>



</body>
</html>