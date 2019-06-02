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
		purchase history
	</title>
	<link rel='stylesheet' href='css/bookinfo.css'>

	<h2>Purchase History</h2>
	
</head>
</html>";

	echo "<table align='center' cellpadding='8' cellspacing='46';>
		<tr align='center'>
			<td><u>user id</u></td>
			<td><u>user name</u></td>
			<td><u>date:time</u></td>
			<td><u>purchase id</u></td>
			<td><u>shipped address</u></td>
			<td><u>amount</u></td>
		</tr>
		</table>
		<hr>
		";
			

			global $con;
		
		$q = "select purchasehistory.uid,user.username,purchasehistory.date,purchasehistory.purchaseId,purchasehistory.shipaddress,purchasehistory.total from store.purchasehistory
join store.user where user.uid=purchasehistory.uid order by date desc;";
		$runQ = mysqli_query($con,$q);

		if(empty($runQ)){
			echo "";
		}
		else{

			while ($row = mysqli_fetch_array($runQ)) {

				$id=$row['uid'];
				$name=$row['username'];
				$date = $row['date'];
				$purchaseId = $row['purchaseId'];
				$shipaddress = $row['shipaddress'];
				$total = $row['total'];

			echo "<table align='center' cellpadding='8' cellspacing='20';>
					<tr align='center'>
						<td style='width:100px'>$id</td>
						<td style='width:100px'>$name</td>
						<td style='width:100px'>$date</td>
						<td style='width:100px'><a href=profile.php?pid=$purchaseId>$purchaseId</a></td>
						<td style='width:100px'>$shipaddress </td>
						<td style='width:100px'>Rs $total/=</td>
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
?>