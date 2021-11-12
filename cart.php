<html>
<head>
    <title>Cart | DayOne Store</title>
    <link rel='icon' href='favicon.ico' type='image/x-icon' />
	<link href="bootstrap-5.0.2/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="main.css" rel="stylesheet" type="text/css">
</head>

<?php
session_start(); //starts the session
if(isset($_SESSION['user'])){ //checks if user is logged in and admin

} else {
    Print '<script>alert("You are not authorized to view this page!");</script>';
    Print '<script>window.location.assign("home.php");</script>'; // redirects to login.php
}
$user = $_SESSION['user']; //assigns user value
$email = $_SESSION['email']; //assigns user value
?>

<body class="homebg">
    <nav class="navbar navbar-dark bg-dark shadow">
      <a class="navbar-brand" href="home.php">
        <img src="images/Store.png" class="navimgwht" height="40px">
      </a>
    </nav>

    <div class="d-flex flex-row justify-content-center">
    	<div class="col-md-8 p-4 m-5 shadow-lg card">
            <?php echo "
            <h3 align='center' class='text-capitalize' >
            <img src='images/user.svg' class='pb-1 navimgblk' height='40px'>
            $user's Cart
            </h3>";?>
            <table width="100%" class="mt-5">
                <tr>
                    <th>Qty</th>
                    <th>Details</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th align="right" style="mx-y">Delete</th>
                </tr>
                <?php
                $con = mysqli_connect("localhost", "id17778834_root", "-2JrCu|K*@hws%OX", "id17778834_dayonedb") or die(mysqli_error()); //Connect to server
                $query = mysqli_query($con, "Select DISTINCT cart.quantity, cart.cartId, items.id, items.item, items.description, items.price FROM items INNER JOIN cart ON items.id=cart.itemId WHERE user='$user' AND orderId=0"); // SQL Query
                $subtotal = 0;
                while($row = mysqli_fetch_array($query))
                {
                    Print "<tr>";
                    Print '<td align="center">'. $row['quantity'] . "</td>";
                    Print '<td>'. $row['item'] . "</td>";
                    Print '<td>'. $row['description'] . "</td>";
                    Print '<td align="center">'. $row['price'] * $row['quantity'] . '</td>';
                    Print '<td align="center"><a href="#" onclick="myFunction('.$row['cartId'].')"><img src="images/backspace.svg" height=25px></a> </td>';
                    Print "</tr>";
                    $subtotal += $row['price'] * $row['quantity'];
                }
                $vat = $subtotal * 0.12;
                $totalprice = $subtotal * 1.12;
                $_SESSION["totalprice"] = $totalprice;
                echo "<tr class='pt-2'><td colspan='3' align='right'>Subtotal</td><td colspan='2' align='left'>Php $subtotal</td></tr>";
                echo "<tr class='pt-2'><td colspan='3' align='right'>VAT</td><td colspan='2' align='left'>Php $vat</td></tr>";
                echo "<tr class=''><td colspan='3' align='right'><b>Total (With 12% Value-Added Tax)</b></td><td colspan='2' align='left'><b>Php $totalprice</b></td></tr>";
                ?>
            </table><br>
            <hr>
            <form action="checkout.php" class="mt-2" method="POST">
              <h4 class="text-center">Check Billing and Delivery details below</h4>
                <label class="mt-4">Delivery Address</label>
                <input type="text" class="form-control mb-2" name="address" placeholder="123 H.V. De La Costa St., Makati City, NCR, Philippines" required>
                <div class="row mb-2">
                    <div class="col">
                      <label class="">Last Name</label>
                      <input type="text" class="form-control" name="lname" placeholder="Dela Cruz" required>
                    </div>
                    <div class="col">
                      <label class="">First Name</label>
                      <input type="text" class="form-control" name="fname" placeholder="Jose Protacio" required>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>Card Number</label>
                    <input type="text" class="form-control mb-2" name="card" placeholder="1234 5678 9876 7777" maxlength="16" pattern="[0-9]{13,16}" required>
                  </div>
                  <div class="col-md-2">
                    <label>Month:</label><br>
                    <select name="cardMonth" required>
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label>Year:</label><br>
                    <select name="cardYear" required>
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                      <option value="2023">2023</option>
                      <option value="2024">2024</option>
                      <option value="2025">2025</option>
                      <option value="2026">2026</option>
                      <option value="2027">2027</option>
                      <option value="2028">2028</option>
                      <option value="2029">2029</option>
                      <option value="2030">2030</option>
                      <option value="2031">2031</option>
                      <option value="2032">2032</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label>CVV:</label>
                    <input type="text" class="form-control" name="cardCVV" placeholder="123" maxlength="3" pattern="[0-9]{3}" required></input>
                  </div>
                </div>
                <div class="form-group">
                  <label>Notes to Seller</label>
                  <textarea class="form-control" name="notes" rows="3" placeholder="e.g. Add fragile stickers or make sure the package is secure"></textarea>
                </div>
                <input type="submit" class="mt-4 btn btn-dark" style="width:100%" value="Confirm & Checkout" name="Checkout"></submit>
            </form>
            <form action="home.php" method="">
              <input type="submit" class="btn btn-outline-dark" style="width:100%" value="Go Back"></input>
            </form>
        </div>
        <div class="col-lg-2">
            <div class="card row p-4 mt-5 mb-4">
                Welcome back
                <h2><?php Print "$user"?></h2>
                <h5><?php Print "$email"?></h5>
                <a href="logout.php">Click here to logout</a>

            </div>
        </div>
    </div>




    <script>
    function myFunction(id)
    {
        var r=confirm("Are you sure you want to delete this record?");
        if (r==true)
        {
            window.location.assign("cart-delete.php?id=" + id);
        }
    }
    </script>
</body>
</html>
