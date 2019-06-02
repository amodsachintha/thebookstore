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



	    ?>
</div>
<?php 
if(isset($_SESSION['uid'])){
	if($_SESSION['uid'] == 101){

echo "
<html>
<head>
<link rel='icon' type='image/png' sizes='32x32' href='siteImg/favicon-32x32.png'>
<link rel='icon' type='image/png' sizes='96x96' href='siteImg/favicon-96x96.png'>
<link rel='icon' type='image/png' sizes='16x16' href='siteImg/favicon-16x16.png'>
	<title>
		book collection
	</title>
	<link rel='stylesheet' href='css/bookinfo.css'>
<style>
.all{
	font-family:monospace;
}

</style>


	<h2>All Books</h2>
	
</head>
</html>";


echo "<div class='all'>";


//global $con;



function remove(){
global $con;
	if(isset($_POST['submit'])){

			$is = $_POST['isbn'];

			$check = mysqli_query($con,"SELECT INSTOCK from book where bookIsbn='$is';");
			$qua = mysqli_fetch_assoc($check)['INSTOCK'];

			if($qua == 1){
				$r = mysqli_query($con,"UPDATE store.book set `INSTOCK`=0 where bookIsbn='$is';");
						if(!$r){
							die(mysqli_error($con));
						}
						else{
							echo "<script>alert('Book removed from site display!')</script>";
						}
			}
			else{
				$r = mysqli_query($con,"UPDATE store.book set `INSTOCK`=1 where bookIsbn='$is';");
						if(!$r){
							die(mysqli_error($con));
						}
						else{
							echo "<script>alert('Book added to site display!')</script>";
						}
			}

			}

}
function updatequa(){
	global $con;
	if(isset($_POST['upquan'])){
		$isbn = $_POST['isbn'];
		$val = $_POST['qua'];

		$run = mysqli_query($con,"UPDATE store.book set quantity=$val where bookIsbn='$isbn';");
		if(!$run){
			die(mysqli_error($con));
		}
		else{
			echo "<script>alert('quantity updated!'')</script>";
		}


	}
}

updatequa();
remove();

echo "<form action='all.php' method='POST'>
		<input type='text' name='seachparam' size='15'>
		<input type='submit' name='search' value ='search'>
	</form>

	";
	if(isset($_POST['search'])){

		searchbooka();
		booksByAuthora();
	}

$q="select *from store.book;";
$runQ = mysqli_query($con,$q);
if(empty($runQ)){
			echo "";
		}

		else{

while($row=mysqli_fetch_array($runQ)){

				$bookTitle = $row['bookTitle'];
				$bookIsbn = $row['bookIsbn'];
				$bookPrice = $row['bookPrice'];
				$bookCover = $row['bookCover'];
				if($row['INSTOCK'] == 0){
				$isDeleted = "not displayed on site";
				}
				else{
					$isDeleted = "displayed on site";
				}
				$qua = $row['quantity'];


				echo "<table align='center' width='800px' cellpadding='8' cellspacing='20'>
					<tr align='center'>

					<td><img src='data/covers/$bookCover' width='100px'></td>
						<td>$bookTitle</td>
						<td>$bookIsbn</td>
						<td>Rs:$bookPrice </td>
						<form action='all.php' method='POST' enctype='multipart/form-data'>
						<input type='hidden' name='isbn' value='$bookIsbn'>
						<td><input type='submit' name='submit' value='remove/add to shop'></td>
						</form>
						<td>$qua in stock </td>
						<td>$isDeleted</td>
						<form action='all.php' method='POST' enctype='multipart/form-data'>
						<input type='hidden' name='isbn' value='$bookIsbn'>
						<td><input type='number' name='qua' maxlength='3' style='width: 45px; margin-bottom: 5px;' required> <input type='submit' name='upquan' value='update stock'> </td>

						</form>
						
					</tr>
					</table>
					<hr>
					
				";

}
}




echo "<br><br>";


echo"<a href='admin.php'>
		<button style='margin-right:30px;'>go back</button></a>";

echo "<br><br><br><br><br><br>";

echo "</div><section class='footer'>
	
		 <div style='color:#808080;margin-bottom:20px;margin-right:100px;'> &copy;&nbsp;Copyright 2016 THE BOOKSTORE&trade;<br>All Right Reserved</div>
	
</section>";
}


else{


	echo "Look where you're going!!!";
}
}



function booksByAuthora(){
	global $con;
	if(isset($_GET['authorName'])){
			$authorNameFromGet = $_GET['authorName'];
			$query_a = "SELECT * FROM store.authors WHERE authorName LIKE '%$authorNameFromGet%';";
			$runQuery_a = mysqli_query($con, $query_a);

				while ($rowAuthRun = mysqli_fetch_array($runQuery_a)) {
					$bookIsbn = $rowAuthRun['isbn'];
					$bookInfo = mysqli_query($con,"SELECT * FROM store.book WHERE bookIsbn='$bookIsbn';");
						while ($x=mysqli_fetch_array($bookInfo)) {

								$bookCover = $x['bookCover'];
								$bookTitle = $x['bookTitle'];
								$bookPrice = $x['bookPrice'];
								if($row['INSTOCK'] == 0){
				$isDeleted = "not displayed on site";
				}
				else{
					$isDeleted = "displayed on site";
				}
				$qua = $row['quantity'];


						}

//					$queryGetAuthor = "SELECT authorName FROM author WHERE bookIsbn_author='$bookIsbn';"; 
//					$a_author = mysqli_fetch_assoc(mysqli_query($con,$queryGetAuthor))['authorName'];

					echo "<table align='center' width='800px' cellpadding='8' cellspacing='20'>
					<tr align='center'>

					<td><img src='data/covers/$bookCover' width='100px'></td>
						<td>$bookTitle</td>
						<td>$bookIsbn</td>
						<td>Rs:$bookPrice </td>
						<form action='all.php' method='POST' enctype='multipart/form-data'>
						<input type='hidden' name='isbn' value='$bookIsbn'>
						<td><input type='submit' name='submit' value='remove/add to shop'></td>
						</form>
						<td>$qua in stock </td>
						<td>$isDeleted</td>
						<form action='all.php' method='POST' enctype='multipart/form-data'>
						<input type='hidden' name='isbn' value='$bookIsbn'>
						<td><input type='number' name='qua' maxlength='3' style='width: 45px; margin-bottom: 5px;' required> <input type='submit' name='upquan' value='update stock'> </td>

						</form>
						
					</tr>
					</table>
					<hr>
					
				";
					
				}
		}
}


	function searchbooka(){
		global $con;
		if(!isset($_POST['seachparam'])){
			echo "<p align='center'>No results to show! Sorry</p>";
			die;
		}

		$searchparam = $_POST['seachparam'];
		
		$Query = 
		"select quantity,INSTOCK,book.bookIsbn as isbn, book.bookTitle as title, book.bookPrice as price ,
		 book.bookCover as cover, cat.cat as cat , cat.catId as catId, authors.authorName as author from book
    	join cat on
    	book.catId=cat.catId
    	join authors on
    	book.bookIsbn = authors.isbn
    	where book.bookTitle like '%$searchparam%' or authorName like '%$searchparam%' or book.bookSeries like 
    	'%$searchparam%' or book.bookTags like '%$searchparam%'; ";


    	$runQ = mysqli_query($con,$Query);
    	if(!$runQ){
    		die(mysqli_error($con));
    	}

    	if(mysqli_num_rows($runQ)==0){
    		echo "<p align='center'>No results to show! Sorry</p>";
    	}

    	echo "<div class='search'> <table cellpadding='10px' cellspacing='10px' style='border-collapse: collapse'>";
    	while($row = mysqli_fetch_array($runQ)){

    		$isbn = $row['isbn'];
    		$title = $row['title'];
    		$price = $row['price'];
    		$cover = $row['cover'];
    		$cat = $row['cat'];
    		$catId = $row['catId'];
    		$author =$row['author'];
    		if($row['INSTOCK'] == 0){
				$isDeleted = "not displayed on site";
				}
				else{
					$isDeleted = "displayed on site";
				}
				$qua = $row['quantity'];


    		echo "<table align='center' width='800px' cellpadding='8' cellspacing='20'>
					<tr align='center'>

					<td><img src='data/covers/$cover' width='100px'></td>
						<td>$title</td>
						<td>$isbn</td>
						<td>Rs:$price </td>
						<form action='all.php' method='POST' enctype='multipart/form-data'>
						<input type='hidden' name='isbn' value='$isbn'>
						<td><input type='submit' name='submit' value='remove/add to shop'></td>
						</form>
						<td>$qua in stock </td>
						<td>$isDeleted</td>
						<form action='all.php' method='POST' enctype='multipart/form-data'>
						<input type='hidden' name='isbn' value='$isbn'>
						<td><input type='number' name='qua' maxlength='3' style='width: 45px; margin-bottom: 5px;' required> <input type='submit' name='upquan' value='update stock'> </td>

						</form>
						
					</tr>
					</table>
					<hr>
					
				";

    	}

    	echo "</div>";

	}
?>