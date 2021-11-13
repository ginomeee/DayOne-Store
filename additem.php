<?php
	// Made by Gino Araullo (C) 2021
	session_start();
	if(isset($_SESSION['user']) && $_SESSION['usertype'] == 0){
	} else {
		header("location:index.php");
	}
	if($_SERVER['REQUEST_METHOD'] == "POST"){ //Added an if to keep the page secured
		$user = $_SESSION['user'];
		$item = $_POST['item'];
		$desc = $_POST['desc'];
		$price = $_POST['price'];
		$img = $_POST['image'];
		$con = mysqli_connect("localhost", "id17778834_root", "-2JrCu|K*@hws%OX", "id17778834_dayonedb") or die(mysqli_error()); //Connect to server
		mysqli_query($con, "INSERT INTO `items` (item,description,price,img) VALUES
		('$item','$desc','$price','$img')"); //SQL query
		header("location:adminlist.php");
	} else {
		header("location:adminlist.php"); //redirects back to home
	}
?>
