<?php
session_start();
include("php/conf.php");
include("php/cartFunctions.php");


	$cid = getCartId();
	$isbnDown = $_GET['isbnfromget'];
 	$userID = $_SESSION['uid'];
	 $file = $_GET['file'];

$q = "SELECT purchasehistory.uid as uid, purchaseitems.isbn as isbn, book.fileName as fname from purchasehistory
    join purchaseitems on
    purchasehistory.purchaseId = purchaseitems.purchaseId
    join book on
    purchaseitems.isbn = book.bookIsbn
    where purchasehistory.uid='$userID' && purchaseitems.isbn = '$isbnDown';";


    $runQUERY = mysqli_query($con,$q);
    if(!$runQUERY){
    	die(mysqli_error($con));
    }

    if(mysqli_num_rows($runQUERY) == 0){
    	echo "<p align='center'>You can only download what you've paid for!</br>
    	<a href='index.php'><button>go back</button></a>
    	</p>";
    	die;
    }

    else{
		$file = "data/books/".$file;
		if(!$file){ // file does not exist
		    die('file not found');
		} 
		else {
		 //   header('Cache-Control: must-revalidate');
		 //   header('Pragma: public');
		    header("Content-Description: File Transfer");
		    header("Content-Disposition: attachment; filename=$file");
		//    header('Content-Type: application/force-download');
		    header("Content-Type: application/octet-stream");
		    header("Content-Transfer-Encoding: binary");
		    header('Content-Length: '.filesize($file));

		    // read the file from disk
		    readfile($file);

	}

}



?>