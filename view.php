<?php
session_start();
include_once 'php/conf.php';



	function listView(){
		global $con;

		$queryGetBookInfo = "SELECT * FROM store.book ORDER BY bookTitle;";
		$queryRun = mysqli_query($con, $queryGetBookInfo);
		while($rowResult=mysqli_fetch_array($queryRun)){
			$bookTitle = $rowResult['bookTitle'];
			$bookIsbn = $rowResult['bookIsbn'];
			$bookPrice = $rowResult['bookPrice'];
			$bookCover = $rowResult['bookCover'];
			$queryGetAuthor = "SELECT authorName FROM authors WHERE isbn='$bookIsbn';"; 
			$a_author = mysqli_fetch_assoc(mysqli_query($con,$queryGetAuthor))['authorName'];
			
			echo "<div id='singleBook' class='nodec'><a href='data/covers/$bookCover'><img src='data/covers/$bookCover' width='150' height='225'></a><a href='index.php?goIsbn=$bookIsbn'><p><strong>$bookTitle</strong></p>
				<p>$a_author</p></a>
			<p> </p>
			<p>Rs. $bookPrice</p></div>";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="css/indexCss.css">

	<title>book view</title>
	<style type="text/css">
		body{
			width: 890px;
			height: 760px;
			margin: 20px auto;
			font-family: Arial;

		}

		#content{
			padding: 5px;
			width: 900px;
			height: 1000px;
		/*	border: solid 1px;	*/
			text-align: center;
		}

		#singleBook{
			width: 200px;
			height: 400px;
			padding-top: 10px;
		/*	border: solid 1px;	*/
			margin-right: 15px;
			margin-bottom: 60px;
			display: inline-block;
			float: left;	
		}

		#singleBook a{
			text-decoration: none;
			color: grey;
		}
		#singleBook a:hover{
			text-decoration: none;
			color: black;
		}
		#hoverimg:hover{

		}
	</style>
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
	 
	// if(isset($_SESSION['uid'])){
	 //  addCartId();
	//   $citems = countCartItems();
	//   echo" | <a href='cart.php'>cart($citems)</a> ";
//	}

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
	<div id="content">
		<?php listView(); ?>
	</div>

</body>
</html>