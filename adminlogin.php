<!doctype html>
<html>
<head>
	<title>Login | Admin Console</title>
	<link rel='icon' href='favicon.ico' type='image/x-icon' />
	<link href="bootstrap-5.0.2/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="main.css" rel="stylesheet" type="text/css">
</head>

<body class="d-flex flex-column justify-content-center landingbg">
	<div class="logocontainer d-none d-md-block">
		<img src="images/DO-store-wht.png" class="imgshadow" width=300px height=auto>
	</div>
	<div class="col col-lg-5 p-4 m-5 shadow-lg card">
		<div class="align-middle text-justify p-1">
			<h4 class="align-middle text-justify">
			<img src="images/logo-blktransparent.png" width=50px>&nbsp;&nbsp;|  Admin Console
			</h4>
		</div>
		<h1 class="pb-n3 text-strong">Media that makes<font class="text-muted"> meaning.</font></h1>
		<form action="adminchecklogin.php" method="POST">
			<div class="form-group w-100">
				<label class="mt-4">Username</label>
				<input type="text" class="form-control" required name="username"><br>
				<label>Password</label>
				<input type="password" class="form-control w-100" required name="password"><br>
			</div>
			<button class="btn btn-dark btn-lg w-100" type="submit" value="login">ADMIN LOGIN</button>
		    <h6 class="text-center mt-4 text-muted"><a href="register.php">Don't have an account? Click here to register</a></h6>
		</form>
	</div>
</body>
</html>
