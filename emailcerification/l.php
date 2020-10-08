<<?php 
session_start()
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<?php

	include 'dbcon.php';

if (isset($_POST['submit'])) {
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);

	$email_search = "select *registration where email='$email' and status='active' ";

	$query = mysqli_num_rows($query);

	$email_count = mysqli_num_rows($query);

	if ($email_count) {
		$email_pass =mysqli_fetch_assoc($query);

		$db_pass = $email_pass['password'];

		$_SESSION['email'] = $email_pass['email'];
		$pass_decode = password_verify($password, $db_pass);


		}
		
	}

?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" name="form" action="" method="POST">
	<table align="center">
		<tr>
		<td>first name </td>
			<td><input type="text" placeholder="firstname" name="firstname" required=""></td>
		</tr>
		<tr>
			<td>last name</td>
			<td> <input type="text" placeholder="lastname" name="lastname" required=""></td>
		</tr>

		</form>
 	</table>
</body>
</html>