<?php

include'php/conf.php';

	function listView(){
	global $con;
			if(!isset($_GET['GetCatId']) && !isset($_GET['goIsbn']) && !isset($_GET['authorName']))	{
			

			$queryGetBookInfo = "SELECT * FROM store.book where INSTOCK='1' ORDER BY RAND() LIMIT 0,6;";
			$queryRun = mysqli_query($con, $queryGetBookInfo);

			while($rowResult=mysqli_fetch_array($queryRun)){
				$bookTitle = $rowResult['bookTitle'];
				$bookIsbn = $rowResult['bookIsbn'];
				$bookPrice = $rowResult['bookPrice'];
				$bookCover = $rowResult['bookCover'];
				$quant = $rowResult['quantity'];

				$page = basename($_SERVER['PHP_SELF']);

				$queryGetAuthor = "SELECT authorName FROM authors WHERE isbn='$bookIsbn';"; 
				$a_author = mysqli_fetch_assoc(mysqli_query($con,$queryGetAuthor))['authorName'];

				if(isset($_SESSION['uid']) && $quant > 10){
				echo "<div id='singleBook' class='nodec'><a href='index.php?goIsbn=$bookIsbn' class='hoveref'><img src='data/covers/$bookCover' width='150' height='225' ></a><a href='index.php?goIsbn=$bookIsbn'><p><strong>$bookTitle</strong></p></a>
					<a href='index.php?authorName=$a_author'><p>$a_author</p></a>
				<p> </p>
				<p>Rs. $bookPrice</p>
				<form action='$page' method='POST'>
				<input type='hidden' name='isbn' value='$bookIsbn'>
				<input type='submit' name='addtocart' value='Add to cart'>
				</form>

				</div>";
			}
				else if($quant > 10){
					echo "<div id='singleBook' class='nodec'><a href='index.php?goIsbn=$bookIsbn' class='hoveref'><img src='data/covers/$bookCover' width='150' height='225' ></a><a href='index.php?goIsbn=$bookIsbn'><p><strong>$bookTitle</strong></p></a>
					<a href='index.php?authorName=$a_author'><p>$a_author</p></a>
				<p> </p>
				<p>Rs. $bookPrice</p>
				</div>";
				}

			}
			getBookCount();
		}
		elseif (isset($_GET['GetCatId'])){
			$catIdFromGet = $_GET['GetCatId'];
			$query_a = "SELECT * FROM store.book WHERE catId='$catIdFromGet' && INSTOCK='1';";
			$runQuery_a = mysqli_query($con, $query_a);
		//	if($runQuery_a == FALSE){
		//		echo "Oops...! No books from said genre found!";
		//	}
		//	else{
				while ($rowCatRun = mysqli_fetch_array($runQuery_a)) {
					if(!isset($rowCatRun)){
						die("Oops...! No books from said genre found!");
					}

					$bookTitle = $rowCatRun['bookTitle'];
					$bookIsbn = $rowCatRun['bookIsbn'];
					$bookPrice = $rowCatRun['bookPrice'];
					$bookCover = $rowCatRun['bookCover'];
					$quan = $rowCatRun['quantity'];

					$page = basename($_SERVER['PHP_SELF'])."?GetCatId=$catIdFromGet";

					$queryGetAuthor = "SELECT authorName FROM authors WHERE isbn='$bookIsbn';"; 
					$a_author = mysqli_fetch_assoc(mysqli_query($con,$queryGetAuthor))['authorName'];


					if(isset($_SESSION['uid']) && $quan > 10){
					echo "<div id='singleBook' class='nodec'><a href='index.php?goIsbn=$bookIsbn' class='hoveref'><img class='coverbook' src='data/covers/$bookCover' width='150' height='225' ></a><a href='index.php?goIsbn=$bookIsbn'><p><strong>$bookTitle</strong></p></a>
						<a href='index.php?authorName=$a_author'><p>$a_author</p></a>
					<p> </p>
					<p>Rs. $bookPrice</p>
					<form action='$page' method='POST'>
					<input type='hidden' name='isbn' value='$bookIsbn'>
				<input type='submit' name='addtocart' value='Add to cart'>
				</form>
				</div>";
			}
				else if($quan > 10){
						echo "<div id='singleBook' class='nodec'><a href='index.php?goIsbn=$bookIsbn' class='hoveref'><img class='coverbook' src='data/covers/$bookCover' width='150' height='225' ></a><a href='index.php?goIsbn=$bookIsbn'><p><strong>$bookTitle</strong></p></a>
						<a href='index.php?authorName=$a_author'><p>$a_author</p></a>
					<p> </p>
					<p>Rs. $bookPrice</p>
				</div>";
					
				}
			}
		}

		elseif(isset($_GET['goIsbn'])) {
			$isbn=$_GET['goIsbn'];
			$getBookData_Q="SELECT * FROM store.book WHERE bookIsbn = '$isbn' && INSTOCK='1';";
			$execute = mysqli_query($con,$getBookData_Q);
			if(isset($_SESSION['uid'])){
				$uidx = $_SESSION['uid'];
		}
			$array = mysqli_fetch_array($execute);

			$b_title = $array['bookTitle'];
			$b_series = $array['bookSeries'];
			$b_catId = $array['catId'];
			$b_publisher=$array['bookPublisher'];
			$b_published =$array['bookPublished'];
			$b_price =$array['bookPrice'];
			$b_desc = $array['bookDescription'];
			$b_cover= $array['bookCover'];
			$b_filename = $array['fileName'];

//***************************************************************************************
			$getratingQuery = "SELECT AVG(rating) as rate from rating group by isbn having isbn ='$isbn';";
			$rungetrating = mysqli_query($con,$getratingQuery);

			$frate = "<i>rating: ";
			$r = 0;
			if(mysqli_num_rows($rungetrating) == 0){
				$rt = $frate."</i> no ratings yet!";
			}
			else{
				$valR = mysqli_fetch_array($rungetrating)['rate'];
				$rt=$frate."</i><b>".$valR."</b>/5";
			}


//********************************************************************************************

			$rcountQ = "SELECT count(isbn) as c from rating group by isbn having  isbn='$isbn';";
			$rungetRcount = mysqli_query($con,$rcountQ);

			if(mysqli_num_rows($rungetRcount) == 0){
				$rcount = 0;
			}
			else{
			$rcount = mysqli_fetch_array($rungetRcount)['c'];
		}
//*********************************************************************************************



			$runFetchAuthor=mysqli_query($con,"SELECT authorName FROM store.authors WHERE isbn = '$isbn';");
			$b_author = mysqli_fetch_assoc($runFetchAuthor)['authorName'];

			$getcatname=mysqli_fetch_array(mysqli_query($con,"select cat from cat where catId = $b_catId;"))['cat'];
			
			$page = basename($_SERVER['PHP_SELF'])."?goIsbn=$isbn";

			if(isset($_SESSION['uid'])){
				echo "
		<div class='img'>
			<a href='viewimg.php?imgData=data/covers/$b_cover&ibsn=$isbn' class='hoveref'>
			<img class='coverbook' src='data/covers/$b_cover'></a>
			<p style='font-size:13px; text-align: center; font-family:monospace;'>
			<i>isbn:</i> <b>$isbn </b></br>
			<i>series:</i> <b>$b_series</b></br>
			<i>category: </i><b>$getcatname</b></br>
			<i>publisher:</i> <b> $b_publisher</b></br>
			<i>published on:</i><b> $b_published</b></br>
			<i>price:</i><b> $b_price</b></br>
			$rt </br>($rcount ratings)</br>";

			rate();
			star($isbn);
		
			$uname = getusername();
			$proimg = getpropic();
			$isreviewed = isreviewed($isbn);
			addreview();

			

			echo "
			</p>
			<div style='float:left; text-align: center'>
					<form action='$page' method='POST'>
					<input type='hidden' name='isbn' value='$isbn'>
					<input type='submit' name='addtocart' value='Add to cart' style='margin-left:70px; margin-top:10px;'>
					</form>
			</div>
		</div>
		

		<div class='titlediv'>
			<h4>$b_title</h4>
			<a href='index.php?authorName=$b_author'><h5>$b_author</h5></a>
		</div>
		<div class='deta'>
			<p>$b_desc</p>

		</div>

		<div style='display:inline-block; float:right; margin-top:70px; width: 880px;'>
			<table align='center'>
			<tr>
			<td><b>Reviews</b></td>
			</tr>
			</table>
		</div>



		";



if($isreviewed == 0){
	echo "
		<div class='review'>
			<table align='center' style='font-family:monospace;' cellpadding='10px' cellspacing='10px'>
				<tr>
					<td><img src='user_images/profile_images/$proimg' width='50'></td>
					<td><form action='' method='POST'>
						<input type='hidden' name='isbnfrompost' value='$isbn'>
						<textarea name= 'reviewtext' id='reviewtext' style='width: 600px; height: 100px;' placeholder='add review...'></textarea>
					
					</td>
					<td><input type='submit' name='addreveiw' value='post'></form></td>
				</tr>
			</table>
		</div>
		";
		}

		echo "<div class='allreviews'><table align='center' cellspacing='19' cellpadding='10' style='border-collapse: collapse'>";
		
		showreviews($isbn);
		
		echo "</table></div>";

}
			else{

		echo "
		<div class='img'>
		<a href='viewimg.php?imgData=data/covers/$b_cover&ibsn=$isbn' class='hoveref'>
			<img class='coverbook' src='data/covers/$b_cover'></a>
			<p style='font-size:13px; text-align: center; font-family:monospace;'>
			<i>isbn:</i> <b>$isbn </b></br>
			<i>series:</i> <b>$b_series</b></br>
			<i>category: </i><b>$getcatname</b></br>
			<i>publisher:</i> <b> $b_publisher</b></br>
			<i>published on:</i><b> $b_published</b></br>
			<i>price:</i><b> $b_price</b></br>
			$rt </br>($rcount ratings)</br>

			";
			star($isbn);
			echo"
			</p>
		</div>
		

		<div class='titlediv'>
			<h4>$b_title</h4>
			<a href='index.php?authorName=$b_author'><h5>$b_author</h5></a>
		</div>
		<div class='deta'>
			<p>$b_desc</p>
		</div>


		<div style='display:inline-block; float:right; margin-top:70px; width: 880px;'>
			<table align='center'>
			<tr>
			<td><b>Reviews</b></td>
			</tr>
			</table>
		</div>






		";
		
		echo "<div class='allreviews'><table align='center' cellspacing='19' cellpadding='10' style='border-collapse: collapse'>";
		
		showreviews($isbn);
		
		echo "</table></div>";



			}

		
 }

}
	


	function listCat(){
		global $con;
		$queryGetCat = "SELECT * from cat ORDER BY cat;";
		$runQuery = mysqli_query($con,$queryGetCat);

		while ($rowCat = mysqli_fetch_array($runQuery)) {
		$category = $rowCat['cat'];
		$categoryId = $rowCat['catId'];

		$runCount = mysqli_query($con,"SELECT COUNT(bookTitle) AS count FROM store.book where catId='$categoryId'");
		$res=mysqli_fetch_assoc($runCount)['count'];

		echo "<li><a href='index.php?GetCatId=$categoryId'>$category($res) </a></li>";
			
		}
	}

function getBookCount(){
	global $con;
	$query = "SELECT COUNT(bookIsbn) AS nCount FROM store.book where INSTOCK='1';";
	$runQuery = mysqli_query($con,$query);
	$rowResult=mysqli_fetch_assoc($runQuery)['nCount'];
	echo"<p style='text-align:center; font-size: 12px; color: gray; margin-right: 60px;'> 6/$rowResult </p>";
}

function footer(){
	echo"<div style='color:#808080;margin-bottom:20px;'> &copy;&nbsp;Copyright 2016 THE BOOKSTORE&trade;<br>All Rights Reserved</div>";
}


function listAuthors(){
	global $con;
	$runQueryAuthor = mysqli_query($con,"SELECT DISTINCT authorName FROM authors ORDER BY authorName;");
	$count = 1;
	while($resultAuthor = mysqli_fetch_array($runQueryAuthor)){
		$count++;
		$authorRes=$resultAuthor['authorName'];
		$bookCount=mysqli_query($con,"SELECT COUNT(isbn) AS count FROM authors WHERE authorName LIKE '%$authorRes%';");
		$bookCountRes = mysqli_fetch_assoc($bookCount)['count'];
		echo "<li><a href='index.php?authorName=$authorRes'>$authorRes ($bookCountRes)</a></li>";
			
	}
}

function booksByAuthor(){
	global $con;
	if(isset($_GET['authorName'])){
			$authorNameFromGet = $_GET['authorName'];
			$query_a = "SELECT * FROM store.authors WHERE authorName LIKE '%$authorNameFromGet%';";
			$runQuery_a = mysqli_query($con, $query_a);

				while ($rowAuthRun = mysqli_fetch_array($runQuery_a)) {
					$bookIsbn = $rowAuthRun['isbn'];
					$bookInfo = mysqli_query($con,"SELECT * FROM store.book WHERE bookIsbn='$bookIsbn' && INSTOCK='1';");
						while ($x=mysqli_fetch_array($bookInfo)) {

								$bookCover = $x['bookCover'];
								$bookTitle = $x['bookTitle'];
								$bookPrice = $x['bookPrice'];
						}

//					$queryGetAuthor = "SELECT authorName FROM author WHERE bookIsbn_author='$bookIsbn';"; 
//					$a_author = mysqli_fetch_assoc(mysqli_query($con,$queryGetAuthor))['authorName'];

					echo "<div id='singleBook' class='nodec'><a href='viewimg.php?imgData=data/covers/$bookCover' class='hoveref'><img src='data/covers/$bookCover' width='150' height='225' ></a><a href='index.php?goIsbn=$bookIsbn'><p><strong>$bookTitle</strong></p></a>
						<a href='index.php?authorName=$authorNameFromGet'><p>$authorNameFromGet</p></a>
					<p> </p>
					<p>Rs. $bookPrice</p></div>";
					
				}
		}
}


	function searchbook(){
		global $con;
		if(!isset($_POST['seachparam'])){
			echo "<p align='center'>No results to show! Sorry</p>";
			die;
		}

		$searchparam = $_POST['seachparam'];
		
		$Query = 
		"select book.bookIsbn as isbn, book.bookTitle as title, book.bookPrice as price ,
		 book.bookCover as cover, cat.cat as cat , cat.catId as catId, authors.authorName as author from store.book
    	join store.cat on
    	book.catId=cat.catId
    	join store.authors on
    	book.bookIsbn = authors.isbn
    	where (book.bookTitle like '%$searchparam%' or authorName like '%$searchparam%' or book.bookSeries like 
    	'%$searchparam%' or book.bookTags like '%$searchparam%') and book.INSTOCK='1' ;";


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

    		echo "
    			<tr style='border-bottom: 1px solid grey; '>
    				<td><a href='index.php?goIsbn=$isbn'><img src='data/covers/$cover' width='50'></a></td>
    				<td><a href='index.php?goIsbn=$isbn'><b>$title</b></a></td>
    				<td><a href='index.php?authorName=$author'><i>$author</i></a></td>
    				<td><a href='index.php?GetCatId=$catId'>$cat</a></td>
    				<td>Rs $price</td>
    			</tr>

    		";

    	}

    	echo "</table></div>";

	}





function star($isbnr){
	global  $con;
	if(isset($_SESSION['uid'])){
	$uidz = $_SESSION['uid'];
}
	$is = $isbnr;
	$rate=3;
	$s=1;

	$qq = "SELECT isbn, AVG(rating) as rate from rating group by isbn having isbn ='$is';";

		$run_qq = mysqli_query($con,$qq);
		if(!$run_qq){
			die(mysqli_error($con));
		}

	if(mysqli_num_rows($run_qq) == 0){
		$rate = 0;
	
	}
	
	else{
		$rate = mysqli_fetch_array($run_qq)['rate'];
	}


	if(isset($_SESSION['uid'])){

	while($s<=5){
		if($s<=$rate){
			echo "
			<a href='index.php?goIsbn=$is&star=$s'><img src='siteImg/ystar.jpg' width='20' onmouseover='hover(this);' onmouseout='unhover(this);'></a>";
			$s++;
		}
		else{
			echo "
			<a href='index.php?goIsbn=$is&star=$s'><img src='siteImg/nstar.png' width='20' onmouseover='hover(this);' onmouseout='unhover(this);'></a>";
			$s++;
		}
	}

}

	else{

while($s<=5){
		if($s<=$rate){
			echo "
			<img src='siteImg/ystar.jpg' width='20'>";
			$s++;
		}
		else{
			echo "
			<img src='siteImg/nstar.png' width='20'>";
			$s++;
		}
	}



	}

}




function rate(){
global $con;


if(isset($_GET['goIsbn']) && isset($_GET['star'])){
	$isbn = $_GET['goIsbn'];
	$star = $_GET['star'];
	$uid = $_SESSION['uid'];
	$ratingID = mt_rand();

	$qc1 = "SELECT user.uid as uid , rating.ratId as rid from user 
	join rated on
	user.uid = rated.uid
	join rating on
	rated.ratId = rating.ratId 
	where user.uid = $uid && rating.isbn = '$isbn';
	";

	$run_qc1 = mysqli_query($con,$qc1);
	if(!$run_qc1){
		die(mysqli_error($con));
	}

	$getRatingID = mysqli_fetch_array($run_qc1)['rid'];


	if(mysqli_num_rows($run_qc1) == 0){

		$q1 = "INSERT into store.rated (uid, ratId) values ($uid,'$ratingID');";
		$run_q1 = mysqli_query($con,$q1);
		if(!$run_q1){
			die(mysqli_error($con));
		}


		$q2 = "INSERT into store.rating (ratId, isbn, rating) values ('$ratingID','$isbn',$star);";
		$run_q2 = mysqli_query($con,$q2);
		if(!$run_q2){
			die(mysqli_error($con));
		}


	}

	else if(mysqli_num_rows($run_qc1) == 1){

		$q3 = "UPDATE store.rating set rating=$star where ratId='$getRatingID'";
		$run_q3 = mysqli_query($con,$q3);
		if(!$run_q3){
			die(mysqli_error($con));
		}



	}

}}




function getusername(){
	global $con;
	if(isset($_SESSION['uid'])){
		$uid = $_SESSION['uid'];

		$q="SELECT username, profileImg from store.user where uid = $uid;";
		$run = mysqli_query($con,$q);
		if(!$run){
			die(mysqli_error($con));
		}

		$user=mysqli_fetch_array($run)['username'];


		return $user;


	}
}



function getpropic(){
	global $con;
	if(isset($_SESSION['uid'])){
		$uid = $_SESSION['uid'];

		$q="SELECT username, profileImg from store.user where uid = $uid;";
		$run = mysqli_query($con,$q);
		if(!$run){
			die(mysqli_error($con));
		
}
		$user=mysqli_fetch_array($run)['profileImg'];

		return $user;


	}
}



function isreviewed($isb){

	global $con;
	if(isset($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
	}

		$q="SELECT * from store.userReviews where uid = $uid && isbn='$isb';";
		$run = mysqli_query($con,$q);

		if(!$run){
			die(mysqli_error($con));
		}

		if(mysqli_num_rows($run) == 0){

			return 0;
		}
		else{
			return 1;
		}

}



function showreviews($isbx){
	global $con;
	if(isset($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
	}



	$q = "SELECT userreviews.review as review, userreviews.date as datem, user.username as uname, user.uid as revUID, user.profileImg as proimg from store.userreviews 
		join user on 
		user.uid = userreviews.uid 
		where userreviews.isbn='$isbx'";

	$run = mysqli_query($con,$q);
	if(!$run){
			die(mysqli_error($con));
		}



		


	if(mysqli_num_rows($run) == 0){
		echo "
		<tr>		
				<td> </td>
				<td>No reviews yet</td>
				<td> </td>
		</tr>";
	}

	else{

		while($row = mysqli_fetch_array($run)){
			$uname = $row['uname'];
			$proimg = $row['proimg'];
			$review = $row['review'];
			$revUID = $row['revUID'];
			$datem = $row['datem'];

			$qr = "SELECT user.uid as uia, rating.rating as rat from user join
							rated on
							rated.uid=user.uid join
							rating on 
							rating.ratId = rated.ratId
							where user.uid = $revUID && rating.isbn='$isbx';";


			$qrun = mysqli_query($con,$qr);
			if($qrun || !empty($qrun)){
				$rat = mysqli_fetch_array($qrun)['rat'];
			}
			else{
				echo mysqli_error($con);
			}

			



			if(isset($uid) && $uid == $revUID && isset($rat)){
				echo "
					<tr style='border-bottom: 2pt solid grey;'>
						<td align='center'><img src='user_images/profile_images/$proimg' width='50'></br><a href='profile.php'>$uname</br>(You)</a></td>
						<td><p>$review</br>rated: $rat/5</br>
						<i>date added: $datem</i></p></td>
						<td><a href='update.php?isbn=$isbx'> edit </a></td>
					</tr>
					";
			}

			else if(isset($uid) && $uid == $revUID){

				echo "
					<tr style='border-bottom: 2pt solid grey;'>
						<td align='center'><img src='user_images/profile_images/$proimg' width='50'></br><a href='profile.php'>$uname</br>(You)</a></td>
						<td><p>$review</br>
						<i>date added: $datem</i></p></td>
						<td><a href='update.php?isbn=$isbx'> edit </a></td>
					</tr>
					";



			}
			else if(isset($rat)){
				echo "
					<tr style='border-bottom: 2pt solid grey;'>
						<td align='center'><img src='user_images/profile_images/$proimg' width='50'></br>$uname</td>
						<td><p>$review</br>rated: $rat/5</br>
						<i>date added: $datem</i></p></td>
						<td> </td>
					</tr>
					";
			}


			else{


				echo "
					<tr style='border-bottom: 2pt solid grey;'>
						<td align='center'><img src='user_images/profile_images/$proimg' width='50'></br>$uname</td>
						<td><p>$review</br>
						<i>date added: $datem</i></p></td>
						<td> </td>
					</tr>
					";

			}
		}


	}


}


function addreview(){
	global $con;

	if(isset($_POST['addreveiw'])){
		 $isbn = $_POST['isbnfrompost'];
		 $rev = mysqli_real_escape_string($con,$_POST['reviewtext']);
		 $uid = $_SESSION['uid'];


		$run = mysqli_query($con, "INSERT into userreviews (uid,isbn,review) values ($uid,'$isbn','$rev');");
		if(!$run){
			die(mysqli_error($con));
		}

		echo "<script>window.open('index.php?goIsbn=$isbn','self')</script>";

	}


}



?>
