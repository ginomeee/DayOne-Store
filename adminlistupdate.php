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
      <a class="navbar-brand" href="adminlist.php" style="height:inherit;">
        <img src="images/Store.png" class="navimgwht" height="40px">
      </a>
    </nav>
    <div class="d-flex flex-row justify-content-center">
    	<div class="col-md-8 p-4 m-5 shadow-lg card justify-content-center">
            <h2 align="center">Edit Item Listing</h2>
                <?php
                if(!empty($_GET['id'])) {
                    $id = $_GET['id'];
                    $_SESSION['id'] = $id;
                    $id_exists = true;
                    $con = mysqli_connect("localhost", "id17778834_root", "-2JrCu|K*@hws%OX", "id17778834_dayonedb") or die(mysqli_error()); //Connect to server
                    $sql = "Select * from `items` where id='$id'";
                    $query = mysqli_query($con, $sql); // SQL Query
                    $count = mysqli_num_rows($query);
                    if($count > 0) {
                      while($row = mysqli_fetch_array($query))
                      {
                          $item = $row['item'];
                          $desc = $row['description'];
                          $price = $row['price'];
                          $imageloc = $row['img'];
                          echo '<div class="card moderncard col-md-4 m-2 shadow d-flex mx-auto">';
                            echo "<div class='itemimg' style='background-image:url(itemimg/$imageloc)'></div>";
                            echo '<div class="p-3" height=100%><h3>'. $item . "</h3>";
                              echo '<h6 class="text-muted">'. $desc . "</h6>";
                            echo '</div>';
                            echo '<div class="mt-auto mx-3 mb-3"><h5>₱'. $row['price'] . "</h5></div>";
                            echo '<div class="text-center mb-3">
                                     <button class="btn btn-outline-dark align-center w-75 m-2" style="border-radius:40px" >Add to Cart</button>
                                   </div>
                                </div>';
                      }
                    }
                    else {
                        $id_exists = false;
                    }
                }
                ?>

                <?php
                if($id_exists==true) {
                    echo '
                <form class="form-group mt-3" method="POST" action="adminlistupdate.php">
                    <label>Item Name</label>
                    <input type="text" class="mb-2 form-control" name="item" value="' . $item . '" rows="1">
                    <label>Description</label>
                    <input type="text" class="mb-2 form-control" name="description" value="' . $desc . '" rows="1">
                    <label>Price</label>
                    <input type="number" class="mb-2 form-control" name="price" value="' . $price . '" rows="1">
                    <label>Image URL</label>
                    <input type="text" class="mb-2 form-control" name="img" value="' . $imageloc . '" rows="1">
                    <input type="submit" class="mt-4 btn btn-dark" style="width:100%" value="Update Fields"></submit>
                </form>
                    ';
                } else {
                    Print '<h4 align="center">There is no data to be edited.</h4>';
                }
                ?>

            <form action="adminlist.php" method="">
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
        $item = ($_POST['item']);
        $description = ($_POST['description']);
        $id = $_SESSION['id'];
        $price = $_POST['price'];
        $img = $_POST['img'];
        mysqli_query($con, "UPDATE `items` SET item='$item', price='$price', img='$img', description='$description' WHERE id='$id'") ;
            echo '<script>alert("Successfully Updated")</script>';
            echo "<script>window.location.assign('adminlistupdate.php?id=$id')</script>";
        }
        ?>
