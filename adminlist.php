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
            <h2 align="center" class="pb-2">Inventory List</h2>
            <table border="1px" width="100%">
                <tr>
                    <th>Id</th>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $con = mysqli_connect("localhost", "id17778834_root", "-2JrCu|K*@hws%OX", "id17778834_dayonedb") or die(mysqli_error()); //Connect to server
                $query = mysqli_query($con, "Select * FROM `items` ORDER BY 'id' ASC"); // SQL Query
                $infostatus = "";
                while($row = mysqli_fetch_array($query))
                {
                    Print "<tr>";
                    Print '<td align="center">'. $row['id'] . "</td>";
                    Print '<td align="center">'. $row['item'] . "</td>";
                    Print '<td align="center">'. $row['description'] . "</td>";
                    Print '<td align="center">'. $row['price'] . "</td>";
                    Print '<td align="center">'. $row['img'] . "</td>";
                    Print '<td align="center"><a href="adminlistupdate.php?id='. $row['id'] .'"><img src="images/edit.svg" height="25px"></a> </td>';
                    Print '<td align="center"><a href="#" onclick="myFunction('.$row['id'].')"><img src="images/backspace.svg" height=25px></a> </td>';
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
            <div class="card moderncard row p-4 mt-n3">
                <form action="additem.php" class="form-group" method="POST">
                    <h5>Add more to list </h5>
                    <label>Item</label>
                    <input type="text" class="form-control mb-2" name="item"></input>
                    <label>Description</label>
                    <input type="text" class="form-control mb-2" name="desc"></input>
                    <labe>Price</label>
                    <input type="number" class="form-control mb-2" name="price"></input>
                    <label>Image Link</label>
                    <input type="text" class="form-control mb-2" name="image"></input>
                    <input type="submit" class="btn btn-dark w-100 mt-4" value="Add to list"/>
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
            window.location.assign("deleteitem.php?id=" + id);
        }
    }
    </script>
</body>
</html>
