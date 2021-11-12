<html>
<head>
	<title>Verifying...</title>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel='icon' href='favicon.ico' type='image/x-icon' />
</head>
<?php
session_start();
$userinp = ($_POST['username']);
$passinp = ($_POST['password']);
$con = mysqli_connect("localhost", "id17778834_root", "-2JrCu|K*@hws%OX", "id17778834_dayonedb") or die(mysqli_error()); //Connect to server
$uname = mysqli_query($con, "SELECT * FROM users WHERE username='$userinp'");
$email = mysqli_query($con, "SELECT * FROM users WHERE email='$userinp'");
$unamerow = mysqli_fetch_assoc($uname);
$emailrow = mysqli_fetch_assoc($email);
$queryHashUser = "SELECT DISTINCT password FROM `users` WHERE username='$userinp'";
$queryHashEmail = "SELECT DISTINCT password FROM `users` WHERE email='$userinp'";


if (mysqli_num_rows($uname)>0) {
	$password = mysqli_fetch_assoc(mysqli_query($con,$queryHashUser));
	$passval = $password['password'];
	$passveri = password_verify($passinp, $passval);
	if ($passveri==true){
		if ($unamerow['usertype'] == 0){
			echo '
			<script>
			if (window.confirm("It looks like you\'re an admin. Did you mean to login with the admin portal?")) {
	  			window.location.assign("adminlogin.php");
			}
			</script>
			';
			$_SESSION['user']= $unamerow['username'];
			$_SESSION['email']=$unamerow['email'];
			$_SESSION['usertype']=$unamerow['usertype'];
			echo '<script>window.location.assign("home.php")</script>';
		} else {
			$_SESSION['user']= $unamerow['username'];
			$_SESSION['email']=$unamerow['email'];
			$_SESSION['usertype']=$unamerow['usertype'];
			header("location: home.php");
		}
	} else {
		Print '<script>alert("Incorrect Password!");</script>'; //Prompts the user
		Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
	}
	mysqli_free_result($uname); //Free Result
} else if (mysqli_num_rows($email)>0){
	$password = mysqli_fetch_assoc(mysqli_query($con,$queryHashEmail));
	$passval = $password['password'];
	$passveri = password_verify($passinp, $passval);
	if ($passveri==true){
		if ($emailrow['usertype'] == 0){
			echo '
			<script>
			if (window.confirm("It looks like you\'re an admin. Did you mean to login with the admin portal?")) {
	  			window.location.assign("adminlogin.php");
			}
			</script>
			';
			$_SESSION['user']= $emailrow['username'];
			$_SESSION['email']=$emailrow['email'];
			$_SESSION['usertype']=$emailrow['usertype'];
			echo '<script>window.location.assign("home.php")</script>';
		} else {
			$_SESSION['user']= $emailrow['username'];
			$_SESSION['email']=$emailrow['email'];
			$_SESSION['usertype']=$emailrow['usertype'];
			echo '<script>window.location.assign("home.php")</script>';
		}


	} else {
		Print '<script>alert("Incorrect Password!");</script>'; //Prompts the user
		Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
	}
} else {
	Print '<script>alert("Username or Email does not exist");</script>'; //Prompts the user
	Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
}
?>
</html>
