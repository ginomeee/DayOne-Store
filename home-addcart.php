<?php
	session_start();
	if(isset($_SESSION['user'])){
	} else {
		header("location:home.php");
	}

	if($_SERVER['REQUEST_METHOD'] = "POST") { //Added an if to keep the page secured
		$user = $_SESSION['user'];
		$itemId = $_POST['itemId'];
		$con = mysqli_connect("localhost", "id17778834_root", "-2JrCu|K*@hws%OX", "id17778834_dayonedb") or die(mysqli_error()); //Connect to server
		$itemExists = mysqli_query($con, "SELECT * FROM `cart` WHERE itemId='$itemId' AND user='$user' AND orderId=0"); //checks if item exists and is not currently in an order
		if (mysqli_num_rows($itemExists)>0){
				mysqli_query($con,"UPDATE `cart` SET quantity=quantity+1 WHERE itemId='$itemId' AND user='$user'");
				echo "<script>alert('Hello $user! Successfully updated cart quantity of item $itemId');";
		        echo "window.location.assign('home.php');</script>";
		} else {
			mysqli_query($con, "INSERT INTO `cart` (user, itemId) VALUES ('$user','$itemId')"); //SQL query
			echo "<script>alert('Hey $user! Successfully added item $itemId to your cart');</script>";
			echo "<script>window.location.assign('home.php');</script>";
		} 
		//echo "<script>window.location.assign('home.php');</script>";
	}

?>
