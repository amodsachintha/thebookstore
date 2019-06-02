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

	<style type="text/css">
		body, html{
			font-family: monospace;
		}
		.main{
		
			width: 957px;
			font-family: monospace;
			display: inline-block;
			float:right;
			margin-top: 30px;
			
		}

		.main table{
			padding: 4px;
			text-align: right;
		}
		.main table tr{
			margin:3px;
		}
		.submit input{
			margin-left: 142px;
		}
		.logo{
			margin-left: 40px;
		}
		.main table tr td{
			align:left;
		}
	</style>






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
			<li><a href="#">About</a></li>
<!--		<li><a href="view.php">All Books</a></li>	-->
			<li><a href="authors.php">Authors</a></li>
			<?php if(isset($_SESSION['uid'])){
				echo "<li><a href='profile.php'>My Profile</a></li>";
			}
			?>
			<li><a href="#">Gear</a></li>
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
</div>


	<div class="main">

		<?php 

usermod();

			if(!isset($_GET['id'])){
				die;
			}

			if($_GET['id'] == 1 ){

				//name change
				echo "
				<hr>
				<form action='manageprofile.php' method='POST'>
				<table align='center' cellspacing='5px' cellpadding='4px'>
					<tr>	
						<td>Enter first name: </td>
						<td><input type='text' name='fname' required></td>
					</tr>
					<tr>
						<td>Enter last name: </td>
						<td><input type='text' name='lname' required></td>
					</tr>
					<tr>
						<td><a href='profile.php'>go back</a></td>
						<td><input type='submit' name='submitname' value='change'></td>
					</tr>
				</table>
				</form>
					";
				}

			else if($_GET['id'] == 2 ){

				echo "
				<hr>
				<form action='manageprofile.php' method='POST'>
				<table align='center' cellspacing='5px' cellpadding='4px'>
					<tr>	
						<td>Enter new username: </td>
						<td><input type='text' name='username' required></td>
						<td><input type='submit' name='submitusername' value='change'></td>
					</tr>
					<tr>
						<td><a href='profile.php'>go back</a></td>
					</tr>
				</table>
				</form>
					";

			}

			else if($_GET['id'] == 3 ){

				echo "
				<hr>
				<form action='manageprofile.php' method='POST'>
				<table align='center' cellspacing='5px' cellpadding='4px'>
					<tr>	
						<td>Enter new email: </td>
						<td><input type='email' name='email' required></td>
						<td><input type='submit' name='submitemail' value='change'></td>
					</tr>
					<tr>
						<td><a href='profile.php'>go back</a></td>
					</tr>
				</table>
				</form>
					";

			}
			else if($_GET['id'] == 4 ){

				echo "
				<hr>
				<form action='manageprofile.php' method='POST'>
				<table align='center' cellspacing='5px' cellpadding='4px'>
					<tr>	
						<td>Enter new phone: </td>
						<td><input type='number' name='phone' maxlength='12' minlength='10' size='12' required></td>
						<td><input type='submit' name='submitphone' value='change'></td>
					</tr>

					<tr>
						<td><a href='profile.php'>go back</a></td>
					</tr>
				</table>
				</form>
					";

			}

			else if($_GET['id'] == 5 ){

				echo "
				<hr>
				<form action='manageprofile.php' method='POST'>
				<table align='center' cellspacing='5px' cellpadding='4px'>
					<tr>	
						<td>Enter old password: </td>
						<td><input type='password' name='pwd1' required></td>
						<td></td>
					</tr>
					<tr>
						<td>Enter new password</td>
						<td><input type='password' name='pwd2' minlength='8' required></td>
					</tr>
					<tr>
						<td>retype new password</td>
						<td><input type='password' name='pwd3' minlength='8' required></td>
					</tr>
						<td><a href='profile.php'>go back</a></td>
						<td><input type='submit' name='submitpassword' value='change password'></td>
					</tr>
				</table>
				</form>
					";

			}


			else if($_GET['id'] == 6 ){

					
				echo "
				<hr>
				<form action='manageprofile.php' method='POST' enctype='multipart/form-data'>
				<table align='center' cellspacing='5px' cellpadding='4px'>
					<tr>	
						<td>add new profile image: </td>
						<td><input type='file' name='propic'></td>
						<td><input type='submit' name='submitimage' value='change'></td>
					</tr>

					<tr>
						<td><a href='profile.php'>go back</a></td>
					</tr>
				</table>
				</form>
					";


			}

			else{
				die;
			}


			
		?>


	</div>


</body>
</html>



<?php
	
	function usermod(){

	global $con;
	$uid = $_SESSION['uid'];

		if(isset($_POST['submitname'])){

			$fname = $_POST['fname'];
			$lname = $_POST['lname'];

			$run1  = mysqli_query($con,"UPDATE user set fName='$fname', lName = '$lname' where uid = $uid;" );

			if(!$run1){
				die(mysqli_error($con));
			}

			echo "<script>alert('name changed!')</script>";
			echo "<script>window.open('profile.php','self')</script>";
		}
		
		
		else if(isset($_POST['submitusername'])){

			$username = $_POST['username'];

			$run2  = mysqli_query($con,"UPDATE user set username='$username' where uid = $uid;" );

			if(!$run2){
				die(mysqli_error($con));
			}

			echo "<script>alert('usename changed!')</script>";
			echo "<script>window.open('profile.php','self')</script>";
		}

		else if(isset($_POST['submitemail'])){

			$email = $_POST['email'];

			$run3  = mysqli_query($con,"UPDATE user set email='$email' where uid = $uid;" );

			if(!$run3){
				die(mysqli_error($con));
			}

			echo "<script>alert('Email address changed!')</script>";
			echo "<script>window.open('profile.php','self')</script>";
		}

		else if(isset($_POST['submitphone'])){

			$phone = $_POST['phone'];

			$run4  = mysqli_query($con,"UPDATE user set phone='$phone' where uid = $uid;" );

			if(!$run4){
				die(mysqli_error($con));
			}

			echo "<script>alert('Phone number changed!')</script>";
			echo "<script>window.open('profile.php','self')</script>";
		}


		else if(isset($_POST['submitpassword'])){

			$pwd1 = $_POST['pwd1'];
			$pwd2 = $_POST['pwd2'];
			$pwd3 = $_POST['pwd3'];

			$q1 = "SELECT * from user where uid = $uid && password=sha($pwd1);";
			$runc = mysqli_query($con,$q1);

				if(!$runc || mysqli_num_rows($runc) == 0){
					echo "<script>alert('Old password is a miss!')</script>";
					echo "<script>window.open('manageprofile.php?id=5','self')</script>";
				}

				else{
					if($pwd2 == $pwd3){

						$run5  = mysqli_query($con,"UPDATE user set password=sha('$pwd2') where uid = $uid;" );

						if(!$run5){
							die(mysqli_error($con));
						}

						echo "<script>alert('Password changed!')</script>";
						echo "<script>window.open('profile.php','self')</script>";

					}

					else{
						echo "<script>alert('New password do not match!')</script>";
						echo "<script>window.open('manageprofile.php?id=5','self')</script>";
					}
				
				}}



		else if(isset($_POST['submitimage'])){

			if(empty($_FILES['propic']['name'])){
						echo "<script>alert('profile picture not given')</script>";
						echo "<script>window.open('profile.php','self')</script>";
					}

					else{

							$usernamex = $_SESSION['username']; 
							$propic = $_FILES['propic']['name'];
							$propicTemp = $_FILES['propic']['tmp_name'];
							$uniquePicName = $usernamex.$propic;



							if(exif_imagetype($_FILES['propic']['tmp_name']) != IMAGETYPE_JPEG AND exif_imagetype($_FILES['propic']['tmp_name'])!= IMAGETYPE_GIF AND exif_imagetype($_FILES['propic']['tmp_name']) != IMAGETYPE_BMP){
      					echo "<script>alert('This is no Image!!')</script>";

      					echo "<script>window.open('manageprofile.php?id=6','self')</script>";

     					 exit(0);
    		}



							$qt = "UPDATE user set profileImg='$uniquePicName' where uid = $uid";
							$runqt = mysqli_query($con,$qt);
							if(!$runqt){
								die(mysqli_error($con));
							}

							move_uploaded_file($propicTemp,"user_images/profile_images/$uniquePicName");

							echo "<script>alert('profile picture updated!')</script>";
							echo "<script>window.open('profile.php','self')</script>";




					}




		}



			
		}



?>