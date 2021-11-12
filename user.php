<html>
<head>
    <title>User | DayOne Store</title>
    <link rel='icon' href='favicon.ico' type='image/x-icon' />
	<link href="bootstrap-5.0.2/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="main.css" rel="stylesheet" type="text/css">
</head>

<?php
session_start(); //starts the session
if(isset($_SESSION['user'])){ //checks if user is logged in and admin
} else {
    Print '<script>alert("Login to proceed");</script>';
    Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
}
$user = $_SESSION['user']; //assigns user value
$email = $_SESSION['email']; //assigns user value
?>

<body class="homebg">
    <nav class="navbar navbar-dark bg-dark shadow">
      <a class="navbar-brand" href="home.php" style="height:inherit;">
        <img src="images/Store.png" class="navimgwht" height="40px">
      </a>
    </nav>

    <div class="d-flex flex-row justify-content-center">
    	<div class="col-md-8 p-4 m-5 shadow-lg card moderncard">
            <h4 align="center">User Purchases</h4>
            <h2 align="center" class="pb-2">Inventory & Purchase List</h2>
            <table width="100%">
                <tr>
                    <th>Order Id</th>
                    <th>Info</th>
                    <th>Purchase Time</th>
                    <th>Address</th>
                    <th>Status</th>
                </tr>
                <?php
                $con = mysqli_connect("localhost", "id17778834_root", "-2JrCu|K*@hws%OX", "id17778834_dayonedb") or die(mysqli_error()); //Connect to server
                $query = mysqli_query($con, "Select * from orders WHERE user='$user'"); // SQL Query
                while($row = mysqli_fetch_array($query)) {
                    Print '<a href="http://google.com/' . $row['id'] .'">';
                    Print '<tr>';
                    Print '<td align="center">'. $row['id'] . "</td>";
                    Print '<td align="center">'. $row['notes'] . "</td>";
                    Print '<td align="center">'. $row['date_posted']. " - ". $row['time_posted']."</td>";
                    Print '<td align="center">'. $row['address']."</td>";
                    switch($row['status']){
                        case 0:
                        $status="PROCESSING";
                        break;
                        case 1:
                        $status="CANCELLED";
                        break;
                        case 2:
                        $status="CONFIRMED";
                        break;
                        case 3:
                        $status="ON THE WAY";
                        break;
                        case 4:
                        $status="DELIVERED";
                        break;
                    }
                    Print '<td align="center">'. $status ."</td>";
                    Print "</tr></a>";
                }
                ?>
            </table>
        </div>
        <div class="col-lg-2">
            <div class="card row p-4 mt-5 mb-4 moderncard">
                Welcome back
                <h2><?php Print "$user"?></h2>
                <h5><?php Print "$email"?></h5>
                <a href="logout.php">Click here to logout</a>

            </div>
        </div>
    </div>
</body>
</html>
