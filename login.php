<!doctype html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html>
<head>
	<title>Login | DayOne Store</title>
	<link rel='icon' href='favicon.ico' type='image/x-icon' />
	<link href="bootstrap-5.0.2/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="main.css" rel="stylesheet" type="text/css">
</head>

<body class="d-flex flex-column justify-content-center landingbg">
	<div class="logocontainer d-none d-md-block">
		<img src="images/DO-store-wht.png" class="imgshadow" width=300px height=auto>
	</div>
	<div class="col col-lg-5 p-4 m-5 shadow-lg card">
		<img src="images/logo-blktransparent.png" height=auto width=50px class="pb-4 p-1">
		<h1 class="pb-n3 text-strong">DayOne Merch? <font class="text-muted">Delivered.</font></h1>
		<h4>Your favorite DayOne Merch all in one place.</h4>
		<form action="checklogin.php" method="POST">
			<div class="form-group w-100">
				<label class="mt-4">Username</label>
				<input type="text" class="form-control" required name="username"><br>
				<label>Password</label>
				<input type="password" class="form-control w-100" required name="password"><br>
			</div>
			<button class="btn btn-dark btn-lg w-100" type="submit" value="login">LOGIN</button>
		    <h6 class="text-center my-4 text-muted"><a href="register.php">Don't have an account? Click here to register</a></h6>
			<h6 class="text-center m-4 text-muted" >Press 'ESC' to access the admin login page</h6>
		</form>
	</div>

	<script>
	document.body.addEventListener("keyup", function (event) {
		if (event.key === "Escape") {
	        window.location.href = 'adminlogin.php';
	    }
	});
	</script>
</body>
</html>
