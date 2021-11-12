<html>
<head>
    <title>DayOne Store</title>
    <link rel='icon' href='favicon.ico' type='image/x-icon' />
	  <link href="bootstrap-5.0.2/css/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	  <link href="main.css" rel="stylesheet" type="text/css">
</head>



<body class="homebg">
    <nav class="navbar navbar-dark bg-dark shadow">
        <form action="" autocomplete="off" class="form-horizontal w-100 mx-5" method="post" accept-charset="utf-8">
            <div class="input-group mt-2">
                <a class="mx-3" href="" style="height:inherit;">
                    <img src="images/Store.png" class="navimgwht" height="40px">
                </a>
                <input name="searchtext" placeholder="Search" class="form-control homesearch px-3 mr-3" type="text">
                <?php
                session_start(); //starts the session
                if (isset($_SESSION['user'])){
                  echo '
                  <a href="cart.php" class="mx-3 ml-5" style="height:inherit">
                  <img src="images/cart.svg" class="p-1 navimgwht" height="40px">
                  </a>
                  ';
                }
                  $time = strftime("%X");//time
        		      $date = strftime("%B %d, %Y");//date
                ?>
                <a class="" href="user.php" style="height:inherit;margin-left:20px">
                    <img src="images/user.svg" class="p-1 navimgwht" height="40px">
                </a>
            </div>
        </form>
    </nav>

    <div class="d-flex flex-wrap justify-content-center mt-4">
    	<div class="col-md-8 p-4 shadow-lg card moderncard m-3">
            <h2>&nbsp;Welcome to the DayOne Store!</h2>
            <h4>&nbsp;Today is <?php echo "$date"?></h4>
        </div>
        <div class="col-md-3 p-4 my-3 card moderncard text-center">
            <?php

            if(isset($_SESSION['user'])){
                $user = $_SESSION['user']; //assigns user value
                Print "Welcome back <h3>$user</h3>";
                Print "<a href=\"logout.php\">Click here to logout</a>";
                 //checks if user is logged in
            } else {
                Print '
                <a class="" href="user.php" style="height:inherit;margin-left:20px">
                    <img src="images/user.svg" class="p-1 navimgblk" height="40px">
                </a>
                <a href="login.php">Click here to login</a>'; // redirects if user is not logged in
            }
            ?>
        </div>
        <?php

        $con = mysqli_connect("localhost", "id17778834_root", "-2JrCu|K*@hws%OX", "id17778834_dayonedb") or die(mysqli_error()); //Connect to server
        if(isset($_POST['searchtext'])){
            $searchtext = $_POST['searchtext'];
            $query = mysqli_query($con, "Select * FROM `items` WHERE (item LIKE '%$searchtext%') OR (description LIKE '%$searchtext%')"); // SQL Query
        } else {
            $query = mysqli_query($con, "Select * FROM `items` ORDER BY price DESC"); // SQL Query
        }


        while($row = mysqli_fetch_array($query))
        {
            $imageloc = $row['img'];
            Print '<div class="card moderncard col-md-2 m-2 shadow d-flex">';
              Print "<div class='itemimg' style='background-image:url(itemimg/$imageloc)'></div>";
              Print '<div class="p-3" height=100%><h3>'. $row['item'] . "</h3>";
                Print '<h6 class="text-muted">'. $row['description'] . "</h6>";
              Print '</div>';
              Print '<div class="mt-auto mx-3 mb-3"><h5>₱'. $row['price'] . "</h5></div>";
              Print '<form method="POST" class="text-center" action="home-addcart.php">
                       <input type="hidden" name="itemId" value="' . $row['id'] . '" style="visibility:hidden">
                       <input type="submit" class="btn btn-outline-dark align-center w-75 m-2" style="border-radius:40px" value="Add to Cart"></input>
                     </form>
                  </div>';
        }
        ?>
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
