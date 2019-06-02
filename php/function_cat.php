<?php
	
	function getCat(){
		global $con;
		$query = "SELECT * FROM cat ORDER BY cat;";
		$runQuery=mysqli_query($con,$query);
		if(!$runQuery){
			echo "Error";
		}

		while($rowCat=mysqli_fetch_array($runQuery)){
			$catId=$rowCat['catId'];
			$catTitle=$rowCat['cat'];

			echo "<option value='$catId'>$catTitle</option>";
		}

	}

	getCat();


?>