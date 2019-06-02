
<?php

//including the database connection 
include("php/conf.php");

//getting text values to $ :D
	$title = mysqli_real_escape_string($con,$_POST['title']);
	$author = $_POST['author'];
	$isbn = $_POST['isbn'];
	$series = mysqli_real_escape_string($con,$_POST['series']);
	$cat = $_POST['cat'];
	$publisher = $_POST['publisher'];
	$pub_date=$_POST['pub_date'];
	$price=$_POST['price'];
	$description = mysqli_real_escape_string($con,$_POST['description']);
	$tags = mysqli_real_escape_string($con,$_POST['tags']);

//Checking for duplication
	$execDupQuery = mysqli_query($con,"select bookIsbn from store.book where bookIsbn='$isbn';");
	$dupResult = mysqli_fetch_array($execDupQuery);
	$dupIsbn = $dupResult['bookIsbn'];
	if(isset($dupIsbn)){
		echo "<script>alert('Duplicate Title')</script>";
		echo "<script>window.open('bookinfo.php','self')</script>";
	}

/////////////////////////////////////////////////////////////////////////////////////////////

//getting checkbox data
	if(isset($_POST['pdf'])){
		$formatID = 3;
	}

	if(isset($_POST['epub'])){
		$formatID = 2;
	}

	if(isset($_POST['mobi'])){
		$formatID = 1;
	}


	echo $formatID;
//	die(mysqli_error($con));

//getting file info
	$cover = $_FILES['cover']['name'];
	$temp_cover = $_FILES['cover']['tmp_name'];

	$book = $_FILES['book']['name'];
	$temp_book = $_FILES['book']['tmp_name'];

	$uniqueCoverName = $book.$cover;

//querys.....finally


	 $query_a = "insert into book (bookTitle, bookIsbn, bookSeries, catId, formatID, bookPublisher, bookPublished, bookPrice, bookDescription,bookTags, bookCover, fileName) values ('$title','$isbn','$series', $cat, $formatID,'$publisher','$pub_date',$price,'$description','$tags','$uniqueCoverName','$book');";

		$insert_t_book=mysqli_query($con,$query_a);

		if(!$insert_t_book){
			die("Main query failed!".mysqli_error($con));
		}



// uploading files.....
		echo $cover."</br></br>";
		echo $book."</br></br>";

		$c=move_uploaded_file($temp_cover,"data/covers/$uniqueCoverName");
		$b=move_uploaded_file($temp_book,"data/books/$book");

		if(!$c){
			echo "cover upload error!</br>";
		}
		else if(!$b){
			echo "book upload error!</br>";
		}
		else{
			echo "both upoads successfull</br>";
		}


		$query_f = "insert into authors (isbn, authorName) values ('$isbn','$author');";
		$insert_t_author = mysqli_query($con,$query_f);

		if(!$insert_t_author){
			die("Error!".mysqli_error($con));
		}
?>

<html>
<head>
	<title>info</title>
</head>
<body>
</br>
<a href="bookinfo.php">
   <button>Go back</button>
</a>
</body>
</html>
