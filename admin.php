<html>
<head>
    <title>Admin | DayOne Store</title>
    <link rel='icon' href='favicon.ico' type='image/x-icon' />
	<link href="bootstrap-5.0.2/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="main.css" rel="stylesheet" type="text/css">
</head>

<?php
session_start(); //starts the session
if(isset($_SESSION['user']) && $_SESSION['usertype'] == 0){ //checks if user is logged in and admin

} else {
    Print '<script>alert("You are not authorized to view this page!");</script>';
    Print '<script>window.location.assign("home.php");</script>'; // redirects to login.php
}
$user = $_SESSION['user']; //assigns user value
$email = $_SESSION['email']; //assigns user value
?>

<body class="homebg">
    <nav class="navbar navbar-dark bg-dark shadow">
      <a class="navbar-brand" href="#" style="height:inherit;">
        <img src="images/Store.png" class="navimgwht" height="40px">
      </a>
    </nav>
    <div class="d-flex flex-row justify-content-center">
        <div class="row col-md-4 p-3 card admincardmain text-center" style="border-top-left-radius:0px;border-top-right-radius:0px;">
            <h5>Welcome back</h5>
            <h1><?php echo "$user";?></h1>
        </div>
    </div>
    <div class="d-flex flex-row justify-content-center mt-4">
        <a href="adminlist.php" class="col-md-3 p-5 shadow-lg card admincardsecond" style="border-bottom-right-radius:0px;border-top-right-radius:0px;">
            <div class="my-auto">
                <h1 class="text-right align-middle"><img src="images/list.svg" height="50px" class="mb-2"> Item List</h1>
            </div>
        </a>
        <div class="d-flex flex-column col-md-3">
            <a href="home.php" class="p-5 shadow-lg card admincardsecond" style="border-radius:0px;">
            <div class="">
                <h1 class="text-center"><img src="images/home.svg" height="50px" class="mb-2"> Home    </h1>
            </div>
            </a>
            <a href="logout.php" class="p-5 shadow-lg card admincardsecond" style="border-radius:0px;">
            <div class="">
                <h1 class="text-center"><img src="images/power.svg" height="50px" class="mb-2"> Logout    </h1>
            </div>
            </a>
        </div>
        <a href="adminpurchase.php" class="col-md-3 p-5 shadow-lg card admincardsecond" style="border-bottom-left-radius:0px;border-top-left-radius:0px;">
            <div class="my-auto">
                <h1 style="text-align:right">Purchases <img src="images/cartblk.svg" height="50px"></h1>
            </div>
        </a>
    </div>
</body>
</html>
