<html>
<head>
    <title>Admin | DayOne Store</title>
    <link rel='icon' href='favicon.ico' type='image/x-icon' />
	<link href="bootstrap-5.0.2/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="main.css" rel="stylesheet" type="text/css">
</head>

<?php
session_start(); //starts the session
if($_SESSION['user'] && $_SESSION['usertype'] == 0){ //checks if user is logged in and admin

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
    	<div class="col-md-8 p-4 m-5 shadow-lg card moderncard">
            <h4 align="center">Administrative Center</h4>
            <h2 align="center" class="pb-2">Order List</h2>
            <table border="1px" width="100%">
                <tr>
                    <th>Id</th>
                    <th>Notes</th>
                    <th>Price</th>
                    <th>Post Time</th>
                    <th>Edit Time</th>
                    <th>Update</th>
                    <th>Delete</th>
                    <th>Status</th>
                    <th>User</th>
                </tr>
                <?php
                $con = mysqli_connect("localhost", "id17778834_root", "-2JrCu|K*@hws%OX", "id17778834_dayonedb") or die(mysqli_error()); //Connect to server
                $query = mysqli_query($con, "Select * FROM `orders` ORDER BY 'date_posted', 'date_edited' ASC"); // SQL Query
                $infostatus = "";
                while($row = mysqli_fetch_array($query))
                {
                    Print "<tr>";
                    Print '<td align="center">'. $row['id'] . "</td>";
                    Print '<td align="center">'. $row['notes'] . "</td>";
                    Print '<td align="center">'. $row['price'] . "</td>";
                    Print '<td align="center">'. $row['date_posted']. " - ". $row['time_posted']."</td>";
                    Print '<td align="center">'. $row['date_edited']. " - ". $row['time_edited']. "</td>";
                    Print '<td align="center"><a href="update.php?id='. $row['id'] .'"><img src="images/edit.svg" height="25px"></a> </td>';
                    Print '<td align="center"><a href="#" onclick="myFunction('.$row['id'].')"><img src="images/backspace.svg" height=25px></a> </td>';
                    switch($row['status']){
                        case 0:
                        $infostatus="PROCESSING";
                        break;
                        case 1:
                        $infostatus="CANCELLED";
                        break;
                        case 2:
                        $infostatus="CONFIRMED";
                        break;
                        case 3:
                        $infostatus="ON THE WAY";
                        break;
                        case 4:
                        $infostatus="DELIVERED";
                        break;
                    }
                    Print '<td align="center">'. $infostatus. "</td>";
                    Print '<td align="center">'. $row['user']. "</td>";
                    Print "</tr>";
                }
                ?>
            </table>
        </div>
        <div class="col-lg-2">
            <div class="card moderncard row p-4 mt-5 mb-4">
                Welcome back Admin
                <h2><?php Print "$user"?></h2>
                <h5><?php Print "$email"?></h5>
                <a href="logout.php">Click here to logout</a>
                <a href="admin.php">Access admin options</a>

            </div>
        </div>
    </div>




    <script>
    function myFunction(id)
    {
        var r=confirm("Are you sure you want to delete this record?");
        if (r==true)
        {
            window.location.assign("deleteorder.php?id=" + id);
        }
    }
    </script>
</body>
</html>
