<?php
session_start(); //starts the session
if($_SESSION['user'] && $_SESSION['usertype'] == 0){ //checks if user is logged in and is admin
} else {
header("location:index.php"); // redirects if user is not logged in
}
if($_SERVER['REQUEST_METHOD'] == "GET") {
$con = mysqli_connect("localhost", "id17778834_root", "-2JrCu|K*@hws%OX", "id17778834_dayonedb") or die(mysqli_error()); //Connect to server
$id = $_GET['id'];
mysqli_query($con, "DELETE FROM orders WHERE id='$id'");
echo '<script>alert("Successfully deleted");
      window.location.assign("adminpurchase.php");</script>';
}
?>
