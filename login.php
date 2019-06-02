<?php
	include ("php/conf.php");
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" sizes="32x32" href="siteImg/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="siteImg/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="siteImg/favicon-16x16.png">

	<title>THE BOOKSTORE: login</title>
	<style type="text/css">
		body, html{
			margin-top: 0px;
			width: 378px;
			height: 600px;
			margin: 90px auto;
			background-color: #e6e6e6;
			font-family: monospace;
		}

		.log_form{
			width: 300px;
			height: auto;
			
		}

		.img{
			margin-left: 35px;
		}
		.log_form form input{
			margin-left:100px;
		}
		.log_form input[type='submit']{
			margin-left: 150px;
			width: 50px;
		}
		.log_form p{
			margin-left: 100px;
			line-height: 15px;
		}
		.forgot{
			margin-left: 10px;
		}
		.forgot a{
			text-decoration: none;
			color: grey;
		}
		.forgot a:hover{
			text-decoration: none;
			color: green;
			text-decoration: underline
		}
		.signup{
			text-align: center;
		}
		.signup p{
			margin-left: 44px;
		}
		.signup a{
			text-decoration: none;
			color: grey;
		}
		.signup a:hover{
			text-decoration: none;
			color: green;
			text-decoration: underline;
		}
		.forgotnow{
			margin-left: 31px;
			margin-top: 20px;
		}
	</style>
</head>
<body>

<div class="img">
	<a href="index.php"><img src="siteImg/logo_cropped.png"></a>
</div>

<?php fogot(); ?>

<?php
if(isset($_POST['newpwd'])){

	resetpwd();

}






if(!isset($_GET['forgot'])&&!isset($_GET['gete'])&&!isset($_GET['geta'])) {
echo "<div class='log_form'>
	<form action='login.php' method='POST' enctype='multipart/form-data'>
		<p>email:</p>
		<input type='email' name='email' placeholder='your email' required> </br>
		<p>password:</p>
		<input type='password' name='passwd' placeholder='your password' required></br></br>
		<input type='submit' name='submit' value='login'>
	</form>



	<div class='forgot'>
	<a href='login.php?forgot=1'><p>forgot password?</p></a>
	</div>
	<div class='signup'>
		<p>not a member? then,</p>
		<a href='signup.php'><p>sign-up</p></a>
	</div>
</div>";
}
?>
<?php
	if(isset($_POST['submit'])){
		login();
	}
?>
</body>
</html>

<?php
	
	function login(){
		global $con;
		$email = mysqli_real_escape_string($con,$_POST['email']);
		$pwd = mysqli_real_escape_string($con,$_POST['passwd']);

		$query_1 = "SELECT uid, username, email FROM store.user WHERE email='$email' && password = sha('$pwd');";
		$runQ=mysqli_query($con,$query_1);

		
		if(mysqli_num_rows($runQ) == 0){
			echo "<script>alert('username password are not a match!')</script>";
			die;
		}

		else if(mysqli_num_rows($runQ) == 1){
			$data = mysqli_fetch_array($runQ);
			$r_email = $data['email'];
			$r_username = $data['username'];
			$r_uid = $data['uid'];

			session_start();
			$_SESSION['uid'] = $r_uid;
			$_SESSION['email'] = $r_email;
			$_SESSION['username'] = $r_username;

	/*		echo $_SESSION['uid'];
			echo $_SESSION['email'];
			echo $_SESSION['username'];
	*/
			echo "<script>window.open('index.php','self')</script>";
		}


	}



	function fogot(){
		global $con;
		if(isset($_GET['forgot'])){

			

			echo "<div class='forgotnow'> 
					<table cellspacing='10'>
						<tr>
							<td>email:</td>
							<form action='login.php?gete=1' method='POST'>
							<td><input type='email' name='email1'></td> 
							<td> </td>
							
							
						</tr>
						<tr>
							<td> </td>
							<td align='center'><b></b></td>
							<td> </td>
						</tr>
						<tr>
							
							<td> </td>
							<td><input type='submit' name='submite'></form></td>
						</tr>

					</table>
				</div>";



}
	if(isset($_GET['gete'])){

		$e=mysqli_real_escape_string($con,$_POST['email1']);
		$q="SELECT email FROM store.user where email = '$e'";
					$qResult = mysqli_query($con,$q);
					$row = mysqli_num_rows($qResult);

					if($row == 0){
						echo "<script>alert('Check above email, you might not be a registered user!')</script>";
						echo "<script>window.open('login.php?forgot=1','self')</script>";
					}

					$req=mysqli_query($con,"select user.uid from store.user where user.email='$e';");
					$f=mysqli_fetch_array($req);
					$u=$f['uid'];

					$qes=mysqli_query($con,"select question,id from store.samplequestions as sq join store.accountrecovery as ar on sq.id=ar.questionID where ar.uid='$u';");
					$row = mysqli_fetch_array($qes) ;
						$qid=$row['id'];
						$ques=$row['question'];



			echo "<div class='forgotnow'> 
					<table cellspacing='10'>
					<form action='login.php?geta=$e' method='POST'>
						<tr>

							$ques
							
							
						</tr>

						<tr>
							<td>Your answer</td>
							<td><input type='text' name='answer'></td>
							<td> </td>
						</tr>


						<tr>
							
							<td> </td>
							<td><input type='submit' name='submita'></form></td>
						</tr>

					</table>
				</div>";
			}

			if(isset($_GET['geta'])){

				$e=mysqli_real_escape_string($con,$_GET['geta']);
				$req=mysqli_query($con,"select user.uid from store.user where user.email='$e';");
					$f=mysqli_fetch_array($req);
					$u=$f['uid'];

					$qes=mysqli_query($con,"select id from store.samplequestions as sq join store.accountrecovery as ar on sq.id=ar.questionID where ar.uid='$u';");
					$row = mysqli_fetch_array($qes) ;
						$qid=$row['id'];
						


				if(isset($_POST['submita'])) {
					
					
					$ansq = mysqli_real_escape_string($con,$_POST['answer']);
					
					


					$secrun = mysqli_query($con,"select answer from store.accountrecovery where questionID='$qid' and uid='$u';");

					$rowq = mysqli_fetch_array($secrun);
						if($rowq['answer'] != $ansq){
							echo "<script>alert('question answer combination is not a match!')</script>";
							echo "<script>window.open('login.php?forgot=1','self')</script>";
						} 

					else{
						echo "
						</br>
						</br>
							<table>
							<tr><form action='login.php' method='POST'>
							<input type='hidden' name = 'email' value ='$e'>
								<td>new password: </td>
								<td><input type='password' name='pwd1' minlength='8' required></td>

							</tr>

							<tr>
								<td>confirm: </td>
								<td><input type='password' name='pwd2' minlength='8' required></td>
							</tr>

							<tr>
								<td> </td>
								<td> <input type='submit' name='newpwd' value='change'></td>
							</tr>
							</form>
							</table>


						";
					}




}


}
				
		}
	



	function resetpwd(){
		global $con;

		$email = $_POST['email'];
		$pwd1 = $_POST['pwd1'];
		$pwd2 = $_POST['pwd2'];

		if($pwd1 != $pwd2){
			echo "<script>alert('Password do not match!!')</script>";
			echo "<script>window.open('login.php?forgot=1','self')</script>";
		}

		else{

			$run = mysqli_query($con,"UPDATE user set password=sha('$pwd1') where user.email = '$email';");
			if(!$run){
				die(mysqli_error($con));
			}

			echo "<script>alert('Password changed, you can login now!!')</script>";

		}




	}

?>