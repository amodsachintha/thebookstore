<!DOCTYPE html>
<?php
session_start();
include("php/conf.php");
?>

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
		book info collector
	</title>
	<link rel='stylesheet' href='css/bookinfo.css'>

	<h2>Database Builder v0.3.1</h2>
	<h3>Books</h3>
</head>
<body>
<div id='main'>
<form action='insert.php' method='post' enctype='multipart/form-data'>
	&nbsp;&nbsp;&nbsp;&nbsp;Title:<input type='text' name='title' id='title' required></br></br>
	&nbsp;&nbsp;&nbsp;Author:<input type='text' name='author' id='author' required></br></br>
	&nbsp;&nbsp;&nbsp;&nbsp;ISBN: <input type='text' name='isbn' id='isbn' required></br></br>
	&nbsp;&nbsp;&nbsp;Series:<input type='text' name='series'></br></br>
	&nbsp;Category: &nbsp;&nbsp;<select name='cat' id='cat'>

	";

	?>
								<?php include('php/function_cat.php') ?>

	<?php 
	echo "
			</select></br></br>

	Publisher: <input type='text' name='publisher' id='publisher'></br></br>
	Published: <input type='text' name='pub_date' id='pub_date' placeholder='yyyy-mm-dd'></br></br>
	&nbsp;&nbsp;&nbsp;&nbsp;Price: <input type='text' name='price' id='price' placeholder='Rs.'></br></br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tags: <input type='text' name='tags' id='tags'></br></br>
	Format(s):</br>
		 <input type='checkbox' name='pdf' value='yes'>*.pdf &nbsp; &nbsp;
		 <input type='checkbox' name='epub' value='yes'>*.epub &nbsp; &nbsp;
		 <input type='checkbox' name='mobi' value='yes'>*.mobi</br></br>

		 Book cover: <input type='file' name='cover' id='cover' /></br>
		 <hr />
		 File: <input type='file' name='book'  id='book' /></br></br>
	Description: </br>
		<textarea name= 'description' id='description' rows='10' cols='43'></textarea></br></br>
		
		<input type='submit' name='submit_info' value='Submit Now' style='margin-right:30px; margin-left:10px;'>
		<button name='reset' type='reset' style='width:100px'> Reset </button>


<!--		<input type='button' name='reset' value='ReEEset' onclick=reset()> 
			<input type='text' name='description' id='desc'></br></br>-->
		
</form>
</div>";


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
