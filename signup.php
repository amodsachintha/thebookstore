<?php
		include ("php/conf.php");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" sizes="32x32" href="siteImg/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="siteImg/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="siteImg/favicon-16x16.png">

	<title>THE BOOKSTORE: signup</title>
	<style type="text/css">
		body, html{
			margin-top: 0px;
			width: 378px;
			height: 600px;
			margin: 40px auto;
			background-color: #e6e6e6;
			font-family: monospace;
		}

		.main table{
			padding: 4px;
			text-align: right;
		}
		.main table tr{
			margin:3px;
		}
		.submit input{
			margin-left: 142px;
			margin-bottom: 20px;
		}
		.logo{
			margin-left: 40px;
		}
		.main table tr td{
			align:left;
		}
	</style>
</head>
<body>

<!-- JAVA SCRIPT FORM VALIDATION -->

<script type="text/javascript">
	
function validate(){

	var fname = document.forms["signup"]["fname"].value;
	var lname = document.forms["signup"]["lname"].value;
	var email = document.forms["signup"]["email"].value;
	var uname = document.forms["signup"]["username"].value;
	var phone = document.forms["signup"]["phone"].value;


	if(isAlphabetic(fname))
		if(isAlphabetic(lname))
			if(phoneValidation(phone,10,12))
				if(userNameValidation(uname,6,20))
					if(emailValidation(email))
						return true;
					else{
						alert("email invalid!");
						return false;
					}
				else{
					return false;
				}
				else{
					return false;
				}
			else{
			//	alert("Last name invalid!");
				return false;
			}
		else{
		//	alert("First name invalid!");
			return false;
		}


}


function isEmpty(elementValue, field){
	if(elementValue=="" || elementValue == null){
		alert("You cannot have " + field + " field empty!");
		return true;
	}
	else
		return false;
}




function isAlphabetic(elementValue){
	var exp = /^[a-zA-Z]+$/;

	if(!isEmpty(elementValue, "First Name")){
		if(elementValue.match(exp)){
			return true;
		}
		else{
			return false;
		}
	}
	else
		return false;
}





 function userNameValidation(elementValue, min, max) {    
	      if (!isEmpty(elementValue, "UserName")) {      
		        if (elementValue.length >= min && elementValue.length <= max) {      
			        return true;             
		         }             
				 else {           
			       alert("Enter a username in between " + min + " and " + max + " characters"); 
				   return false;           
		         }      
	    }        
	      else         
		      return false;         
  }



 
function userNameValidation(elementValue, min, max) {    
	      if (!isEmpty(elementValue, "UserName")) {      
		        if (elementValue.length >= min && elementValue.length <= max) {      
			        return true;             
		         }             
				 else {           
			       alert("Enter a username in between " + min + " and " + max + " characters"); 
				   return false;           
		         }      
	    }        
	      else         
		      return false;         
  }



function phoneValidation(elementValue, min, max) {    
	      if (!isEmpty(elementValue, "UserName")) {      
		        if (elementValue.length >= min && elementValue.length <= max) {      
			        return true;             
		         }             
				 else {           
			       alert("Enter a Phone Number in between " + min + " and " + max + " characters"); 
				   return false;           
		         }      
	    }        
	      else         
		      return false;         
  }




 function emailValidation(elementValue) {      
	    if (!isEmpty(elementValue, "Email")){      
		        var atpos = elementValue.indexOf("@");      
		        var dotpos = elementValue.indexOf(".");    
		          if (atpos < 1 || dotpos + 2 >= elem.length || atpos + 2 > dotpos){                 
					alert("Enter a valid email address");     
		            return false;            
	             }            
	             else                
		              return true;      
        }        
	  else          
          return false;    
  }  






</script>


<!-- ************* JS OVER  ****************** -->







	<div class="logo">
		<a href="index.php"><img src="siteImg/logo_cropped.png"></a>
	</div>
	<div class="main">
	<hr>
	<form action="signup.php" method="POST" enctype="multipart/form-data" name="signup" onsubmit="return validate()">
		<table cellspacing="5px" cellpadding="4px">
			<tr>
				<td><strong>name </strong></td>
				<td align="left"><input type="text" name="fname" placeholder="first" required><span style="color:red;">*</span></td>
				
			</tr>

			<tr>
				<td></td>
				<td align="left"><input type="text" name="lname" placeholder="last" required><span style="color:red;">*</span></td>
			</tr>

			<tr>
				<td><strong>email</strong></td>
				<td align="left"><input type="email" name="email" placeholder="me@example.com" required><span style="color:red;">*</span></td>
			</tr>	

			<tr>
				<td><strong>username</br>(6-12) </strong></td>
				<td align="left"><input type="text" name="username" placeholder="eg: first + last" required><span style="color:red;">*</span></td>
			</tr>

			<tr>
				<td><strong>create password(>8)</strong></td>
				<td align="left"><input type="password" name="pwd1" minlength="8" required><span style="color:red;">*</span></td>
			</tr>

			<tr>
				<td><strong>confirm password</strong></td>
				<td align="left"><input type="password" name="pwd2" minlength="8" required><span style="color:red;">*</span></td>
			</tr>
			<tr>
				<td><strong>security question</strong></td>
				<td> <select name="question">
						<?php 

						function echoques(){
							global $con;
							$ques = mysqli_query($con,"SELECT * from store.samplequestions;");

							while($ans = mysqli_fetch_array($ques)){
								$q = $ans['question'];
								$id = $ans['id'];

								echo "<option value='$id'>$q</option>";
							}

						}

						echoques();

						?>

				</select></td>
			</tr>
			<tr>
				<td><strong>Your answer</strong></td>
				<td align="left"><input type="text" name="secanswer" required><span style="color:red;">*</span></td>
			</tr>

			<tr>
				<td><strong>phone no.</strong></td>
				<td align="left"><input type="number" name="phone" maxlength="12" minlength="10" size="12" placeholder="0123456789" required></td>
			</tr>

			<tr>
				<td><strong>birthday</strong></td>
				<td align="left"><input type="date" name="bday" min="1930-01-01" max="2002-12-30" placeholder="eg: 0000-00-00" required></td>
			</tr>

			<tr>
				<td><strong>Gender</strong></td>
				<td align="left"><select name="gender">
					<option value="1">Male</option>
					<option value="2">Female</option>
				</select></td>
			</tr>

			<tr>
				<td><strong>profile image</strong></td>
				<td align="left"><input type="file" name="propic"></td>
			</tr>
		</table>
		<hr>
		<div class="submit">
		<input type="submit" name="submit" value="signup">
		</div>
	</form>

	</div>
	<?php  if(isset($_POST['submit'])){
			useradd();
		} 
	?>
</body>

</html>

<?php


	function useradd(){
		global $con;

		$fname = mysqli_real_escape_string($con,$_POST['fname']);
		$lname = mysqli_real_escape_string($con,$_POST['lname']);
		$email = mysqli_real_escape_string($con,$_POST['email']);
		$username = mysqli_real_escape_string($con,$_POST['username']);
		$pwd1 = mysqli_real_escape_string($con,$_POST['pwd1']);
		$pwd2 = mysqli_real_escape_string($con,$_POST['pwd2']);
		$qID = $_POST['question'];
		$ans = mysqli_real_escape_string($con,$_POST['secanswer']);
		$phone = $_POST['phone'];
		$bday = $_POST['bday'];
		$gender = $_POST['gender'];


//*************** check for profile pic(auto-asign if null)***************
		if(empty($_FILES['propic']['name']) && $gender == 1){
			$uniquePicName = "default_male.png";
		}

		else if(empty($_FILES['propic']['name']) && $gender == 2){
			$uniquePicName = "default_female.jpeg";
		}

		else if(!empty($_FILES['propic']['name'])){

				if(exif_imagetype($_FILES['propic']['tmp_name']) != IMAGETYPE_JPEG AND exif_imagetype($_FILES['propic']['tmp_name'])!= IMAGETYPE_GIF AND exif_imagetype($_FILES['propic']['tmp_name']) != IMAGETYPE_BMP){
      					echo "<script>alert('This is no Image!!')</script>";
      				//	echo "<script>window.open('signup.php','self')</script>";

     					 exit(0);
    		}


			$propic = $_FILES['propic']['name'];
			$propicTemp = $_FILES['propic']['tmp_name'];
			$uniquePicName = $username.$propic;
			move_uploaded_file($propicTemp,"user_images/profile_images/$uniquePicName");
		}
		

//******************* duplicate email check **************************

		$mailRun=mysqli_query($con,"SELECT uid FROM store.user WHERE email='$email'");

		if(mysqli_num_rows($mailRun)!=0){
			echo "<script>alert('Duplicate email found...forgot password?')</script>";
			echo "<script>window.open('login.php','self')</script>";
			die;
		}

//************************ password check  *******************************


		if($pwd1 != $pwd2){
			echo "<script>alert('Passwords do not match!')</script>";
			die;
		}


//***********************  Now, lets run the query ****************************

		$runuery = mysqli_query($con,"INSERT INTO store.user (`username`, `email`, `password`, `fName`, `lName`, `birthday`,`gender`,`phone`,`profileImg`) VALUES ('$username', '$email', sha1('$pwd1'), '$fname', '$lname', '$bday',$gender,'$phone','$uniquePicName');");

		if(!$runuery){
			echo "<script>alert('Unknown error! Try again later.')</script>";
			die;
		}

		$secAns = mysqli_query($con,"INSERT into accountRecovery (uid, questionID, answer) select user.uid, $qID, '$ans'
										from user
									where user.email = '$email';
								");

		if(!$secAns){
			echo "<script>alert('Unknown error! Try again later.')</script>";
			die;
		}

		echo "<script>alert('Account created! You can login now..')</script>";
		echo "<script>window.open('login.php','self')</script>";

	}		




?>









