<?php
session_start();


?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Signup form
	</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
	<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
	<link rel="stylesheet" type="text/css" href="file.css?v=<?php echo time(); ?>">
	 <link rel="stylesheet"href= "https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<?php include 'links.php' ?>

	</style>
   
</head>
<body>
<?php
include 'dbcon.php';

if (isset($_POST['submit'])) {
	$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);


	$pass = password_hash($password, PASSWORD_BCRYPT);
	$conpassword = password_hash($cpassword, PASSWORD_BCRYPT);

	$token =bin2hex(random_bytes(15));
	
	$insertquery = "insert into registration(firstname, lastname, email, password, cpassword, token ,status) values('$firstname','$lastname','$email','$pass','$conpassword','$token','$inactive')";
	$iquery = mysqli_query($con, $insertquery);
	if ($iquery) {

		
		$subject = "Email Activation";
		$body = "नमस्कार, $firstname. WELCOME
		
		http://localhost/emailcerification/activate.php?token=$token";
		$sender_email = "From: vishwakarmaaditya999@gmail.com";

if(mail( $email, $subject, $body, $sender_email)) {
 	$_SESSION['msg'] = "check mail to activate account $email";
	header('location:login.php');

	
}
	else {
		echo "Email sending failed..";
	}
		
		
	}else{
		?>
		<script type="text/javascript">
			alert("no");
		</script>
		<?php
}
	
}



?>



	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" name="form" action="" method="POST">
	<table align="center">
		<th style="background-color: black"> <h1>SIGNUP FORM </h1>


</th>

		
		<tr>
		<td>First name </td>
			<td><input type="text" placeholder="firstname" name="firstname" required=""></td>
		</tr>
		<tr>
			<td>Last name</td>
			<td> <input type="text" placeholder="lastname" name="lastname" required=""></td>
		</tr>
		<tr>			
		<td>Email address </td>
			<td><input type="text" placeholder="email"  name="email" required=""></td>
		</tr>
		<tr>
		<td>Password</td>
			<td><input type="text" placeholder="password" name="password" required=""></td>
		</tr>
		<tr>
		<td>Confirm password</td>
		<td><input type="text" placeholder="Re-enter your password" name="cpassword" required=""></td>
	    </tr>
		<tr>
		<td>Submit</td>
		<td><a href="login.html"> <input type="submit" name="submit" value="Signup"></a></td>
	</tr>
	</form>
 	</table>
</body>
</html>



