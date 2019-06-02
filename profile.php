
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
<?php
	if(isset($_SESSION['uid']) && !isset($_GET['pid'])){

		$userID = $_SESSION['uid'];

		$userQ = "SELECT * FROM store.user WHERE uid = $userID";
		$userAgeQ = "SELECT TIMESTAMPDIFF(YEAR, birthday, CURDATE()) AS age from user where uid=$userID;";
		$runAgeQ = mysqli_query($con,$userAgeQ);

		$runQ = mysqli_query($con,$userQ);
		$row = mysqli_fetch_array($runQ);

		$uname = $row['username'];
		$uemail = $row['email'];
		$umemberSince = $row['create_time'];
		$ufname = $row['fName']." ".$row['lName'];
		$uage = mysqli_fetch_array($runAgeQ)['age'];
		$uphone = $row['phone'];
		$profileImg = $row['profileImg'];
		$ip = getip();

		echo "<div class='profile'>
<hr>
		<div class='propicimage'>
			<img src='user_images/profile_images/$profileImg' width='160'>
			<p class = 'propicchange'><a href='manageprofile.php?id=6'>change</a></p>
		</div>

		<div class='descript'>
			<table cellspacing='5px' cellpadding='4px'>
				<tr>
					<td>name:</td>
					<td>$ufname<a href='manageprofile.php?id=1'>(change)</a></td>
					<td></td>
				</tr>
				<tr>
					<td>username:</td>
					<td>$uname<a href='manageprofile.php?id=2'>(change)</a></td>
					<td></td>
				</tr>
				<tr>
					<td>email:</td>
					<td>$uemail<a href='manageprofile.php?id=3'>(change)</a></td>
					<td> </td>
				</tr>
				<tr>
					<td>member since:</td>
					<td>$umemberSince</td>
				</tr>
				<tr>
					<td>age</td>
					<td>$uage years</td>
				</tr>
				<tr>
					<td>phone</td>
					<td>$uphone<a href='manageprofile.php?id=4'>(change)</a></td>
					<td> </td>
				</tr>
				<tr>
					<td>ip address</td>
					<td>$ip</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><a href='manageprofile.php?id=5'>change</br>password </a></tr>
				</tr>


			</table>
		</div>

<hr>

</div>";

	}

?>
<div class="purchases">
	<p align="center" style="font-size: 15px; font-family: monospace;"><b>
	<?php 
		if(isset($_GET['pid'])){
			echo "<a href='profile.php'>purchase history</a>";
		}
		else{
			echo "purchase history";
		}
	?>
	</b></p>
	<hr>
	<table align="center" cellpadding="8" cellspacing="15">
	<?php 
	if(isset($_GET['pid'])){
		viewpurchasedetails();

	}
	else {
	echo "
		<tr align='center'>
			<td><u>date:time</u></td>
			<td><u>purchase id</u></td>
			<td><u>shipped address</u></td>
			<td><u>amount</u></td>
		</tr>
		";
			viewPurchases();

		}
		?>
	</table>
<hr>
</div>


<div class="footer">
	<?php footer(); ?>
</div>

</div>
</body>
</html>
