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


</div>

<div class="edit">
	<table cellspacing="20" cellpadding="8" align="center">
		<tr align="center"><td> </td> <td><h3>update review</h3></td></tr>
		
<?php 
update();
printrev();


if(isset($_GET['isbn'])){
			$isbh = $_GET['isbn'];
		}

echo" <tr><form action='update.php' method='POST' enctype='multipart/form-data'>
		<input type='hidden' name='isbn' value =$isbh>
		<td>new</br>review</td>
		<td><textarea name = 'newtext' id='newtext' style='width: 600px; height: 120px;'></textarea></td>
		<td><input type='submit' name='update' value='update'></td>

		</tr></form>";
	
?>	

<tr>
	<td> </td>
	<td><?php  echo "<a href='index.php?goIsbn=$isbh'>go back</a>";    ?></td>
	<td></td>
</tr>

</table>




</div>

<?php
		function printrev(){
			global $con;
			if(isset($_GET['isbn'])){
					$isbw = $_GET['isbn'];
			}
			else{
				die;
			}
		$uidq = $_SESSION['uid'];


		$q = "SELECT userreviews.review as review, user.username as uname, user.profileImg as img from store.userreviews 
			join user on 
			user.uid = userreviews.uid 
			where userreviews.isbn='$isbw' && user.uid=$uidq";

			$runsql = mysqli_query($con, $q);

			$res = mysqli_fetch_array($runsql);

			$oldreview = $res['review'];
			$uname = $res['uname'];
			$img = $res['img'];

			echo "

				<tr><td>old</br> review</td>
					<td><p>$oldreview</p></td>
					<td></td>
				</tr>";

		}

		function update(){

		global $con;
			if(isset($_POST['isbn'])){

			 	$isbw = $_POST['isbn'];
			 	$new = mysqli_real_escape_string($con,$_POST['newtext']);
		
		 		$uidq = $_SESSION['uid'];

		 		$q = "UPDATE userreviews set review='$new' where isbn='$isbw' && uid=$uidq;";
		 		$run = mysqli_query($con,$q);
		 		if(!$run){
		 			die(mysqli_error($con));
		 		}
		 		else{

		 			echo "<script>alert('Your review has been updated.')</script>";
		 			echo "<script>window.open('index.php?goIsbn=$isbw','self')</script>";
				}

		}



		}


?>




</body>
</html>
