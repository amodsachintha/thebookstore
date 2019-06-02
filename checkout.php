<?php
session_start();
include("php/conf.php");
include("php/cartFunctions.php");



?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">

		body{
			width: 800px;
			height: auto;
			margin: 10px auto;
		
		}

		body{
			font-family: monospace;
			font-size: 13px;
		}
		.tablecart{
			width: 800px
			height:auto;
			margin: 10px auto;
		}

		.img{
			margin-top: 20px;
			margin-left: 264px;
		}
		table{
			border-collapse: collapse;
		}

		.cartBar{
			width: 830px;
			height: 30px;
			margin-bottom: 15px;
			display: inline-block;
			float: left;
			font-family: monospace;
			font-size: 13px;
			text-align: center;
			color: black;
		}
		.cartBar a{

			text-decoration: none;
			color: black;
		}

		.cartBar a:hover{
			text-decoration: underline;
			color: green;
		}

		.link tr td a{
			text-decoration: none;
			color: blue;
		}

		.link tr td a:hover{
			text-decoration: underline;
			color: orange;
		}

		.paypal a img{
			 -webkit-transition: all 0.2s ease;
			 -moz-transition: all 0.2s ease; 
   			 -ms-transition: all 0.2s ease; 
   			 transition: all 0.2s ease;
		}

		.paypal a img:hover{
			 -webkit-transform:scale(1.1);
			 -moz-transform:scale(1.1); 
  			  -ms-transform:scale(1.1); 
  			  transform:scale(1.1);
		}

	</style>
	<title>cart</title>
	
</head>
<body>

<div class="img">
	<a href="index.php"> <img src="siteImg/logo_cropped.png"> </a>
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

	    ?>

</div>
<div style="margin-top:10px; margin-bottom:20px;">
<p align="center"><u>order details</u></p>
	<table align="center" cellpadding="3" cellspacing="10">
		
		<?php 
			viewcartmin();
		?>
	</table>
<hr>
</div>


<!-- JS FORM VALIDATION -->

<script type="text/javascript">
	
function validate(){

	var address1 = document.forms["addr"]["s_address1"].value;
	var address2 = document.forms["addr"]["s_address2"].value;
	var address3 = document.forms["addr"]["s_address3"].value;
	var address4 = document.forms["addr"]["s_address4"].value;



	if(isAlphaNumeric(address1))
		if(isAlphaNumeric(address2))
			if(isAlphaNumeric(address3))
				if(isAlphaNumeric(address4))
					return true;
				else
					return false;
			else
				return false;
		else
			return false;
	else
		return false;

}




function isEmpty(elementValue, field){
  if(elementValue=="" || elementValue == null){
    alert("You cannot have " + field + " field empty!");
    return true;
  }
  else
    return false;
}


 
function isAlphaNumeric(elementValue){        
//    var exp = /^[0‐9a‐zA‐Z]+$/;          
  if (!isEmpty(elementValue, "Address")){   
     if (/^([0-9a-zA-Z /-'_]{1,})$/.test(elementValue)) 
         return true;  
              
    else{  
        alert("Enter only letters and numbers for the Address");              
        return false;             
   } 
         
 }        
 else           
    return false;     
 }  



</script>





<div class="tablecart">
<p align="center"><u>purchase details</u></p>
<form action="checkout.php" method="POST" name="addr" onsubmit="return validate()">
	<table cellspacing="10px" cellpadding="5px" align="center" style="text-align:right">
		<tr>
			<td>shipping address</td>
			<td><input type="text" name="s_address1" required></td>
		</tr>
		<tr>
			<td> </td>
			<td><input type="text" name="s_address2" required></td>
		</tr>
		<tr>
			<td> </td>
			<td><input type="text" name="s_address3" required></td>
		</tr>
		<tr>
			<td> </td>
			<td><input type="text" name="s_address4" required></td>
		</tr>
		<tr>
			<td>country</td>
			<td><select name=country>
				
			<?php  listCountry(); ?>

			</select></td>
		</tr>
			<tr>
			<td>payment method**</td>
			<td><select  name="payM" id="payM">
				<option value="1">Payal</option>
				<option value="2">Visa</option>
				<option value="3">Mastercard</option>
				<option value="4">Discover</option>
				<option value="5">American Express</option>
				<option value="6">On Delivery(Sri Lanka)</option>
			</select></td>
			
		</tr>


	</table>
	<p style="font-size:11px; color: red;">
** All payments are processed through PayPal&trade;, including but not limited to VISA, Mastercard, Discover and AmEx.</br>

* Once you click PayNow, you will be redirected to THE BOOKSTORE's PayPay payment window.
</p>



<hr>
</div>
<div style="display:inline-block; float:right" class="paypal">
<!--
<img src="siteImg/paynow.png" width="100">
-->

<input type="submit" name="info" value="" style="background-image: url(siteImg/paynow_s.png); background-repeat: no-repeat;
width:136px;
height:39px;
border: 0;">

</div>
</form>
<div style="display:inline-block; float:left; margin-top:-20px;">
	<img src="siteImg/SecurePayments.png" width="350">
</div>

<?php 
if(isset($_POST['info'])){
	checkout();
}

 ?>

</body>
</html>




<?php 

function listCountry(){

	global $con;
	$q = "SELECT nicename from store.country;";
	$run = mysqli_query($con,$q);

	while($row = mysqli_fetch_array($run)){
		$country = $row['nicename'];
		if($country == "Sri Lanka")
			echo "<option value='$country' selected>$country</option>";
		else
			echo "<option value='$country'>$country</option>";
	}

}





?>