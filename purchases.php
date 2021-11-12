<html>
<head>
    <title>Admin | DayOne Store</title>
    <link rel='icon' href='favicon.ico' type='image/x-icon' />
	<link href="bootstrap-5.0.2/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="main.css" rel="stylesheet" type="text/css">
</head>

<?php
session_start(); //starts the session
if($_SESSION['user']){ //checks if user is logged in
} else {
    header("location:index.php"); // redirects if user is not logged in
}
$user = $_SESSION['user']; //assigns user value
?>

<body class="homebg">
    <nav class="navbar navbar-dark bg-dark shadow">
      <a class="navbar-brand" href="#" style="height:inherit;">
        <img src="images/Store.png" class="navimgwht" height="40px">
      </a>
    </nav>

    <div class="d-flex flex-row justify-content-center">
    	<div class="col-md-8 p-4 m-5 shadow-lg card">
            <h2 align="center">Inventory & Purchase List</h2>
            <table border="1px" width="100%">
                <tr>
                    <th>Id</th>
                    <th>Details</th>
                    <th>Post Time</th>
                    <th>Edit Time</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Public Post</th>
                </tr>
                <?php
                $con = mysqli_connect("localhost", "root", "", "DayOneDB") or die(mysqli_error()); //Connect to server
                $query = mysqli_query($con, "Select * from orders"); // SQL Query
                while($row = mysqli_fetch_array($query))
                {
                    Print "<tr>";
                    Print '<td align="center">'. $row['id'] . "</td>";
                    Print '<td align="center">'. $row['details'] . "</td>";
                    Print '<td align="center">'. $row['date_posted']. " - ". $row['time_posted']."</td>";
                    Print '<td align="center">'. $row['date_edited']. " - ". $row['time_edited']. "</td>";
                    Print '<td align="center"><a href="edit.php?id='. $row['id'] .'">edit</a> </td>';
                    Print '<td align="center"><a href="#" onclick="myFunction('.$row['id'].')">delete</a> </td>';
                    Print '<td align="center">'. $row['public']. "</td>";
                    Print "</tr>";
                }
                ?>
            </table>
        </div>
        <div class="col-lg-2">
            <div class="card row p-4 mt-5 mb-4">
                Welcome back
                <h2><?php Print "$user"?></h2>
                <a href="logout.php">Click here to logout</a>

            </div>
            <div class="card row p-4 mt-n3">
                <form action="add.php" method="POST">
                    <h5>Add more to list </h5>
                    Details: <input type="text" required name="details"><br>
                    Public Post? <input type="checkbox" name="public[]" value="yes"/><br/>
                    <input type="submit" value="Add to list"/>
                </form>
            </div>
        </div>
    </div>




    <script>
    function myFunction(id)
    {
        var r=confirm("Are you sure you want to delete this record?");
        if (r==true)
        {
            window.location.assign("delete.php?id=" + id);
        }
    }
    </script>
</body>
</html>
