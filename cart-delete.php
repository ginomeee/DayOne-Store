<?php
session_start(); //starts the session
if (isset($_SESSION['user'])){ //checks if user is logged in
} else {
	header("location:home.php"); // redirects if user is not logged in
}
if($_SERVER['REQUEST_METHOD'] == "GET") {
	$con = mysqli_connect("localhost", "id17778834_root", "-2JrCu|K*@hws%OX", "id17778834_dayonedb") or die(mysqli_error()); //Connect to server
	$id = $_GET['id'];
	mysqli_query($con, "DELETE FROM cart WHERE cartId='$id'");
	header("location: cart.php");
}
?>
