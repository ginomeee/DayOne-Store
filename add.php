<?php
// Made by Gino Araullo (C) 2021
	session_start();
	if($_SESSION['user']){
	} else {
		header("location:index.php");
	}
	if($_SERVER['REQUEST_METHOD'] = "POST"){ //Added an if to keep the page secured
		$user = $_SESSION['user'];
		$notes = ($_POST['notes']);
		$time = strftime("%X");//time
		$date = strftime("%B %d, %Y");//date
		$status = 0;
		$con = mysqli_connect("localhost", "root", "", "DayOneDB") or die(mysqli_error()); //Connect to server
		foreach($_POST['c'] as $each_check){ //gets the data from the checkbox
			if($each_check !=null ){ //checks if the checkbox is checked
				$decision = "yes"; //sets the value
			}
		}
		mysqli_query($con, "INSERT INTO orders (notes, date_posted, time_posted, user, status) VALUES
		('$notes','$date','$time','$user','$status	')"); //SQL query
		header("location:adminpurchase.php");
	} else {
		header("location:adminpurchase.php"); //redirects back to home
	}
?>
