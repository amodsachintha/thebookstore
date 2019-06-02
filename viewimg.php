<?php
	function viewimg(){
		$img = $_GET['imgData'];
		$isbn = $_GET['ibsn'];

	echo "<a href='index.php?goIsbn=$isbn'><div class='image'> 
			<img src='$img' width='510px'>
		</div>
		<div class='logo'>
			<img src='siteImg/logo_cropped.png'>
		</div></a>";
	}


?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body, html{
			width: 680px;
			height: auto;
			margin: 0px auto; 
			padding: 0px;
			font-family: monospace;
			font-size: 12px;

		}
		.image{
			display: inline-block;
			float: left;
		}

		.logo{
			display: inline-block;
			float: left;
			margin-top: 260px;
			margin-left: -150px;
		}
		.footer{
			display: inline-block;
			float: left;
			text-align: center;
			width: 510px;
		}
	</style>
</head>
<body>
<?php viewimg();
?>
<div class="footer">
	THE BOOKSTORE&trade; &copy;2016
</div>
</body>
</html>