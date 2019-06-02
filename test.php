<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>
<div>
<form action="test.php" method="POST">
	<input type="submit" name="addtocart" value="Add to cart">
</form>
	<?php
		if(isset($_POST['addtocart'])){
			echo "it works!";
		}
	?>

</div>
</body>
</html>
