<html>
<head>
    <title>Edit | DayOne Store</title>
    <link rel='icon' href='favicon.ico' type='image/x-icon' />
	<link href="bootstrap-5.0.2/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="main.css" rel="stylesheet" type="text/css">
</head>
<?php
session_start(); //starts the session
if($_SESSION['user'] && $_SESSION['usertype'] == 0){ //checks if user is logged in
} else {
    header("location:index.php "); // redirects if user is not logged in
}
$user = $_SESSION['user']; //assigns user value
$id_exists = false;
?>
<body class="homebg">
    <nav class="navbar navbar-dark bg-dark shadow">
      <a class="navbar-brand" href="home.php" style="height:inherit;">
        <img src="images/Store.png" class="navimgwht" height="40px">
      </a>
    </nav>
    <div class="d-flex flex-row justify-content-center">
    	<div class="col-md-8 p-4 m-5 shadow-lg card">
            <h2 align="center">Currently Selected</h2>
            <table border="1px" width="100%">
                <tr>
                    <th>Id</th>
                    <th>Details</th>
                    <th>Post Time</th>
                    <th>Edit Time</th>
                    <th>Public Post</th>
                </tr>
                <?php
                if(!empty($_GET['id']))
                {
                    $id = $_GET['id'];
                    $_SESSION['id'] = $id;
                    $id_exists = true;
                    $con = mysqli_connect("localhost", "root", "", "DayOneDB") or die(mysqli_error()); //Connect to server
                    $sql = "Select * from orders Where id='$id'";
                    $query = mysqli_query($con, $sql); // SQL Query
                    $count = mysqli_num_rows($query);
                    if($count > 0)
                    {
                        while($row = mysqli_fetch_array($query))
                        {
                            Print "<tr>";
                            Print '<td align="center">'. $row['id'] . "</td>";
                            Print '<td align="center">'. $row['details'] . "</td>";
                            Print '<td align="center">'. $row['date_posted']. " - ". $row['time_posted']."</td>";
                            Print '<td align="center">'. $row['date_edited']. " - ". $row['time_edited']. "</td>";
                            Print '<td align="center">'. $row['public']. "</td>";
                            Print "</tr></table><br/>";
                            $details = $row['details'];
                            $public = $row['public'];
                        }
                    }
                    else {
                        $id_exists = false;
                    }
                }
                if($id_exists) {
                    Print '<form action="edit.php" method="POST">
                    Update List: <br/>
                    Details: <input type="text" name="details" required value="'.$details.'"/><br/>';
                    if($public == "yes") {
                        Print 'Public Post? <input type="checkbox" name="public[]" checked/><br/>';
                    } else {
                        Print 'Public Post? <input type="checkbox" name="public[]"/><br/>';
                    }
                    Print '<input type="submit" value="Update List"/></form>';
                }
                else
                {
                    Print '<h2 align="center">There is no data to be edited.</h2>';
                }
                ?>
        </div>
    </div>


</body>
</html>



    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $con = mysqli_connect("localhost", "root", "", "DayOneDB") or die(mysqli_error()); //Connect server
        $details = ($_POST['details']);
        $public = "no";
        $id = $_SESSION['id'];
        $time = strftime("%X");//time
        $date = strftime("%B %d, %Y");//date
        foreach($_POST['public'] as $list)
        {
            if($list != null)
            {
                $public = "yes";
            }
        }
        foreach($_POST['sale'] as $list)
        {
            if($list != null)
            {
                $sale = "yes";
            }
        }
        mysqli_query($con, "UPDATE orders SET details='$details', public='$public', date_edited='$date',
            time_edited='$time' WHERE id='$id'") ;
            header("location: home.php");
        }
        ?>
