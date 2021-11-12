<?php
session_start(); //starts the session
if (isset($_SESSION['user']) && isset($_SESSION['totalprice'])){ //checks if user is logged in
} else {
	header("location:home.php"); // redirects if user is not logged in
}
if($_SERVER['REQUEST_METHOD'] == "POST" && $_SESSION['totalprice']>0) {
	$user = $_SESSION['user'];
	$price = $_SESSION['totalprice'];
	$address = $_POST['address'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$card = $_POST['card'];
	$notes = $_POST['notes'];
	$time = strftime("%X");//time
	$date = strftime("%B %d, %Y");//date
	$con = mysqli_connect("localhost", "id17778834_root", "-2JrCu|K*@hws%OX", "id17778834_dayonedb") or die(mysqli_error()); //Connect to server
	mysqli_query($con, "INSERT INTO `orders` (user,price,address,fname,lname,card,time_posted,date_posted,notes,status) VALUES ('$user','$price','$address','$fname','$lname','$card','$time','$date','$notes','0')");
	$order = mysqli_fetch_assoc(mysqli_query($con, "SELECT id FROM orders WHERE user='$user' ORDER BY id DESC LIMIT 1")); //finds empty value
	$orderId = $order['id'];
	mysqli_query($con,"UPDATE `cart` SET orderId=$orderId WHERE user='$user' AND orderId=0");
	unset($_SESSION['price']);
	echo '<script>alert("Thank you for your purchase!");
	window.location.assign("user.php")</script>';
} else {
	echo '<script>alert("You do not have any items in your cart!");
	window.location.assign("cart.php")</script>';
}
?>
