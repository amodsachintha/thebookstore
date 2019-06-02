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



<div style="margin-top:60px;">
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
	 
 
	    ?>

</div>

</div>


<!-- JAVASCRIPT FORM VALIDATE -->

<script type="text/javascript">
	

function validate(){

var card = document.forms["card"]["cno"].value;
var cvc = document.forms["card"]["cvc"].value;


if(isNumeric(card))
	if(isCvc(cvc))
		return true;
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



function isCvc(elementValue){  

  //   var exp = new RegExp ("^([0‐9])$");
       if (!isEmpty(elementValue, "Card Number")) {               
          if (/^([0-9]{3,})$/.test(elementValue)) 
                return true; 
       else {          
                alert("Enter a valid cvc!");  
                return false;            
        }         
     }          
    else         
 return false;      

}   



 function isNumeric(elementValue){  

  //   var exp = new RegExp ("^([0‐9])$");
       if (!isEmpty(elementValue, "Card Number")) {               
          if (/^([0-9]{15,})$/.test(elementValue)) 
                return true; 
       else {          
                alert("Enter a 16 digit card Number!");  
                return false;            
        }         
     }          
    else         
 return false;      

}   


</script>





<?php

$pid=$_GET['pid'];

echo "
<div class='tablecart'>
<p align='center'><u>purchase details</u></p>
<form action='gateway.php?pid=$pid' method='POST' name='card' onsubmit='return validate()'>";



if(isset($_GET['pmeth']))
{

$methd=$_GET['pmeth'];



	if($methd=='1')
{

	echo "<table cellspacing='10px' cellpadding='5px' align='center' style='text-align:right'>
		<tr>
			<td align='left'>Email</td>
			<td><input type='email' name='pmail' required></td>
		</tr>
		
		<tr>
			<td>PayPal password</td>
			<td><input type='password' name='epw' required></td>

		</tr>

</table>";
}


else
{

echo "<table cellspacing='10px' cellpadding='5px' align='center' style='text-align:right'>
		<tr>
			<td>Card No</td>
			<td ><input type='number' name='cno' max ></td>
		</tr>
		
		<tr>
			<td align='left'>CVC</td>
			<td align='left'><input type='text' name='cvc' maxlength='3' size='3' ></td>
		</tr>
					
	</table>";

}

}

?>	




	<p style="font-size:11px; color: red;margin-top:60px;">
</br>

* Once you click PayNow, you will be redirected to THE BOOKSTORE's PayPay payment window.
</p>



<hr>
</div>
<div style="display:inline-block; float:right" class="paypal">
<!--
<img src="siteImg/paynow.png" width="100">
-->

<input type="submit"  name="buy" value="Pay Now" style="background-color:#ffad33;font-size:17px;border-radius: 29px;box-shadow: 0 2px black;
width:127px;
height:34px;
border: 0;">
</div>


<div style="display:inline-block; float:left; margin-top:-20px;">
	<img src="siteImg/SecurePayments.png" width="350">
</div>


<?php

$pid=$_GET['pid'];
echo "
</form>
<form action='gateway.php?pid=$pid' method='POST' name='cancel'>";
?>
<input type="submit"  name="cand" value="Cancle"style="background-color:#ffad33;font-size:17px;border-radius: 29px;box-shadow: 0 2px black;
width:127px;
height:34px;
border: 0; margin-left:170px;margin-right:0px;";>
</form>



<?php 
if(isset($_POST['buy'])){
	buyit();
}
if(isset($_POST['cand'])){
	cancleit();
}
 ?>
</body>
</html>