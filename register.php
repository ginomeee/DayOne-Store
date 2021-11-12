<!doctype html>
<html>
<head>
	<title>Register | DayOne Store</title>
	<link rel='icon' href='favicon.ico' type='image/x-icon' />
	<link href="bootstrap-5.0.2/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="main.css" rel="stylesheet" type="text/css">
</head>
	<body class="landingbg d-flex flex-row justify-content-center">
		<div class="col-md-5 p-4 m-5 shadow-lg card">
		<img src="images/logo-blktransparent.png" width=50px class="pb-4 p-1" style="position:absolute;">
		<h1 class="pb-n3 text-strong text-center mt-4">Register Now</h1>
		<h4 class="text-center">Get exclusive deals when you register</h4>
			<form action="register.php" method="POST">
				<div class="form-group w-100">
					<label class="mt-4">Username</label>
					<input type="text" class="form-control" required name="username"><br>
					<label>Email</label>
					<input type="text" class="form-control" required name="email"><br>
					<label>Password</label>
					<input type="password" class="form-control" required name="password"><br>
					<label>Verify Password</label>
					<input type="password" class="form-control" required name="password2"><br>
				</div>
				<button class="btn btn-dark btn-lg w-100" type="submit" value="login">REGISTER</button>
				<h6 class="text-center mt-4 text-muted"><a href="login.php">Already have an account? Click here to login</a></h6>
			</form>
		</div>

<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$username = ($_POST['username']);
	$password = ($_POST['password']);
	$password2 = ($_POST['password2']);
	$emailinp = ($_POST['email']);
	$bool = true;
	$con = mysqli_connect("localhost", "id17778834_root", "-2JrCu|K*@hws%OX", "id17778834_dayonedb") or die(mysqli_error()); //Connect to server
	$uname = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
	$email = mysqli_query($con, "SELECT * FROM users WHERE email='$emailinp'");
	$passhash = password_hash($password, PASSWORD_DEFAULT);
	$insert = "INSERT INTO `users` (username, email, password, usertype) VALUES ('$username','$emailinp','$passhash',1)";

	if ($password2 != $password){
		Print '<script>alert("Passwords dont match! Try again");</script>';
		Print '<script>window.location.assign("register.php");</script>';
	} else if (mysqli_num_rows($uname) != 0){
		Print '<script>alert("Username has been taken!");</script>'; //Prompts the user
		Print '<script>window.location.assign("register.php");</script>'; // redirects to register.php
	} else if (mysqli_num_rows($email) != 0){
		Print '<script>alert("Email has been taken!");</script>'; //Prompts the user
		Print '<script>window.location.assign("register.php");</script>';
	} else {
		//print "<script>alert('$passhash');</script>"; //Used for debugging
		mysqli_query($con, $insert) or die(mysql_error()); //Inserts the value to table users
		Print '<script>alert("Successfully Registered!");</script>'; // Prompts the user
		Print '<script>window.location.assign("login.php");</script>'; // redirects to register.php
	}
} else {

}
?>
</body>
</html>
