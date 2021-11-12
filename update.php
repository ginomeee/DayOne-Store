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
                    <th>Order Id</th>
                    <th>Notes</th>
                    <th>Post Time</th>
                    <th>Edit Time</th>
                    <th>Price</th>
                </tr>


                <?php
                if(!empty($_GET['id'])) {
                    $id = $_GET['id'];
                    $_SESSION['id'] = $id;
                    $id_exists = true;
                    $con = mysqli_connect("localhost", "id17778834_root", "-2JrCu|K*@hws%OX", "id17778834_dayonedb") or die(mysqli_error()); //Connect to server
                    $sql = "Select * from `orders` where id='$id'";
                    $query = mysqli_query($con, $sql); // SQL Query
                    $count = mysqli_num_rows($query);
                    if($count > 0)
                    {
                        while($row = mysqli_fetch_array($query))
                        {
                            Print "<tr>";
                            Print '<td align="center">'. $row['id'] . "</td>";
                            Print '<td align="center">'. $row['notes'] . "</td>";
                            Print '<td align="center">'. $row['date_posted']. " - ". $row['time_posted']."</td>";
                            Print '<td align="center">'. $row['date_edited']. " - ". $row['time_edited']. "</td>";
                            Print '<td align="center">PHP '. $row['price']. "</td>";
                            Print '<td align="center">'. $row['address']. "</td>";
                            Print "</tr></table><br/>";
                            $notes = $row['notes'];
                            $status = $row['status'];
                            $checkuser = $row['user'];
                            $fname = $row['fname'];
                            $lname = $row['lname'];
                            $address = $row['address'];
                            $card = $row['card'];
                        }
                    }
                    else {
                        $id_exists = false;
                    }
                }
                echo "<h5>User: $checkuser</h5>";
                echo "<h5>Name: $lname, $fname</h5>";
                echo "<h5>Delivery Address: $address</h5>";
                echo "<h5>Payment Info: Debit Card [$card]</h5>";
                ?>
                <form class="form-group mt-3" method="POST" action="update.php">
                <?php
                if($id_exists) {
                    echo '
                    <label>Set Order Status:</label>
                    <select name="status" required>';
                    switch($status){
                      case 0:
                      echo '
                      <option value="0" selected>0 - PROCESSING</option>
                      <option value="1">1 - CANCELLED</option>
                      <option value="2">2 - CONFIRMED</option>
                      <option value="3">3 - ON THE WAY</option>
                      <option value="4">4 - DELIVERED</option>
                      ';
                      break;
                      case 1:
                      echo '
                      <option value="0">0 - PROCESSING</option>
                      <option value="1" selected>1 - CANCELLED</option>
                      <option value="2">2 - CONFIRMED</option>
                      <option value="3">3 - ON THE WAY</option>
                      <option value="4">4 - DELIVERED</option>
                      ';
                      break;
                      case 2:
                      echo '
                      <option value="0">0 - PROCESSING</option>
                      <option value="1">1 - CANCELLED</option>
                      <option value="2" selected>2 - CONFIRMED</option>
                      <option value="3">3 - ON THE WAY</option>
                      <option value="4">4 - DELIVERED</option>
                      ';
                      break;
                      case 3:
                      echo '
                      <option value="0">0 - PROCESSING</option>
                      <option value="1">1 - CANCELLED</option>
                      <option value="2">2 - CONFIRMED</option>
                      <option value="3" selected>3 - ON THE WAY</option>
                      <option value="4">4 - DELIVERED</option>
                      ';
                      break;
                      case 4:
                      echo '
                      <option value="0">0 - PROCESSING</option>
                      <option value="1">1 - CANCELLED</option>
                      <option value="2">2 - CONFIRMED</option>
                      <option value="3">3 - ON THE WAY</option>
                      <option value="4" selected>4 - DELIVERED</option>
                      ';
                      break;
                    }
                    echo '</select><br>';
                    echo '
                    <label>Notes</label>
                    <input type="text" class="form-control" name="notes" value="' . $notes . '" rows="1">
                    </input>
                    ';
                }
                else
                {
                    Print '<h4 align="center">There is no data to be edited.</h4>';
                }
                ?>
                <input type="submit" class="mt-4 btn btn-dark" style="width:100%" value="Update Fields" name="Checkout"></input>
            </form>
            <form action="adminpurchase.php" method="">
              <input type="submit" class="btn btn-outline-dark" style="width:100%" value="Go Back"></input>
            </form>
        </div>
    </div>


</body>
</html>



    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $con = mysqli_connect("localhost", "id17778834_root", "-2JrCu|K*@hws%OX", "id17778834_dayonedb") or die(mysqli_error()); //Connect server
        $notes = ($_POST['notes']);
        $status = ($_POST['status']);
        $id = $_SESSION['id'];
        $time = strftime("%X");//time
        $date = strftime("%B %d, %Y");//date
        mysqli_query($con, "UPDATE orders SET notes='$notes', status='$status', date_edited='$date',
            time_edited='$time' WHERE id='$id'") ;
            echo '<script>alert("Successfully Updated")</script>';
            echo "<script>window.location.assign('update.php?id=$id')</script>";
        }
        ?>
