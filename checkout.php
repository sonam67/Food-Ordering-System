<?php
require 'dbconnect.php';
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $mobile_no.=$_POST['mobile_no.'];
    $email=$_POST['email'];
    $method=$_POST['method'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $pincode=$_POST['pincode'];
    $sql="INSERT INTO `checkout`(`name` , `mobile_no.`, `email`, `method`, `address`,`city`,`state`,`pincode`)
     VALUES('$name', '$mobil_no.','$email', '$method', '$address' ,'$city','$state','$pincode')";
     $insert_data=mysqli_query($conn,$sql);

     echo 'Now Go For Payment';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="checkout.css">
    <link rel="stylesheet" href="index1.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
<div class="Home-page" id="home">
        <div class="Navbar-layout">
            <div class="Navbar">
                <div class="Nav-left">
                    <h6>FOODIE</h6>
                </div>
                <div class="Nav-right">
                    <div class="nav-menu">
                        <ul class="nav-name">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="menu.php">Menu</a></li>
                            <li><a href="favorite_food.php">Favorite Food</a></li>
                            
                            <?php
                                $select_rows = mysqli_query($conn, "SELECT * FROM `mycart`") or die('query failed');
                                $row_count = mysqli_num_rows($select_rows);
                            ?>
                            <li><a href="mycart.php" class="btn btn-outline-success">Cart (<span><?php echo $row_count; ?></span>)</a></li>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="signup.php">Sign Up</a></li>
                        </ul>
                        <ul class="nav-icon">
                            <li><a href="#home"><img src="icon/home.svg" alt="Home"
                                        style="width: 17px;height: 17px;"></a></li>
                            <li><a href="#menu"><img src="icon/restaurant-menu.svg" alt="Menu"
                                        style="width: 17px;height: 17px;"></a></li>
                            <li><a href="favorite_food.php"><img src="icon/favorite.svg" alt="Favorite Food"
                                        style="width: 17px;height: 17px;"></a></li>
                            <li><a href="#cart"><img src="icon/cart.svg" alt="Cart"
                                        style="width: 17px;height: 17px;"></a></li>
                            <li><a href="login.php"><img src="icon/login.svg" alt="Login"
                                        style="width: 17px;height: 17px;"></a></li>
                            <li><a href="signup.php"><img src="icon/sign-up.svg" alt="Sign Up"
                                        style="width: 17px;height: 17px;"></a></li>
                        </ul>
                        <div class="hamburger-icon">
                            <a href="javascript:void(0)" class="hamburger" onclick="openNav()">
                                <img src="icon/hamburger.svg" alt="hamburger" style="width: 30px;height: 20px;">
                            </a>
                            <a href="javascript:void(0)" class="cross" onclick="closeNav()">
                                <img src="icon/cross.svg" alt="cross" style="width: 20px;height: 20px;">
                            </a>

                            <div class="dropdown-content" id="drop">
                                <div class="dropdown">
                                    <a href="#home">Home</a>
                                    <a href="#menu">Menu</a>
                                    <a href="favorite_food.php">Favorite Food</a>
                                    <a href="#cart">Cart</a>
                                    <a href="login.php">Login</a>
                                    <a href="signup.php">Sign Up</a>
                                </div>     
                            </div>
                            <script>
                                function openNav() {
                                    document.getElementById("drop").style.height = "247px";
                                    document.getElementsByClassName("cross")[0].style.display = "block";
                                    document.getElementsByClassName("hamburger")[0].style.display = "none";
                                }
                                
                                function closeNav() {
                                    document.getElementById("drop").style.height = "0%";
                                    document.getElementsByClassName("hamburger")[0].style.display = "block";
                                    document.getElementsByClassName("cross")[0].style.display = "none";
                                }
                                </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="container" style="margin-top: 150px;">
        
  
        <div class="checkout-form">
 
            <form action="payment.php" method="POST">
            
                <div class="column">
                <div class="inputbox">
                    <span>Name</span>
                    <input type="text" name="name" placeholder="e.g. Sonam" required>
                </div>
                <div class="inputbox">
                    <span>Mobile No.</span>
                    <input type="number" name="mobile_no." placeholder="+91 " required>
                </div>
                <div class="inputbox">
                    <span>Email</span>
                    <input type="email" name="email" placeholder="enter your email" required>
                </div>
                <div class="inputbox">
                <span>Payment Method</span>
                 <select name="method">
                    <option value="cash on delivery" selected>cash on devlivery</option>
                    <option value="credit cart">credit cart</option>
                    <option value="paypal">paypal</option>
                 </select>
                </div>
                    </div>
                    <div class="column">
                <div class="inputbox">
                    <span>Address</span>
                    <input type="text" name="address" placeholder="Enter a valid address" required>
                </div>
                <div class="inputbox">
                    <span>City</span>
                    <input type="text" name="city" placeholder="e.g. Indore">
                </div>
                <div class="inputbox">
                    <span>State</span>
                    <input type="text" name="state" placeholder="e.g. MP">
                </div>
                <div class="inputbox">
                    <span>Pincode</span>
                    <input type="number" name="pincode" placeholder="e.g. 12346">
                </div>
                    </div>
                    <div class="display-order">
                        <div class="s"><span>Order Details</span><br></div>
                <?php
                 $select_cart = mysqli_query($conn, "SELECT * FROM `mycart`");
                 $total = 0;
                $grand_total = 0;
                    if(mysqli_num_rows($select_cart) > 0){
                        while($data = mysqli_fetch_assoc($select_cart)){
                            $total_price = number_format($data['Price'] * $data['Quantity']);
                            $grand_total = $total += $total_price;
                ?>
                    <span><?= $data['Name']; ?>(<?= $data['Quantity']; ?>)</span>
                    <?php
                       }
                    }else{
                           echo "<div class='display-order'><span>your cart is empty!</span></div>";
                     }
                 ?>
                 <span class="grand-total"> grand total : <?php echo $grand_total; ?>/- </span>
                 </div>
                 <div class="inputbox">
                 <input type="hidden"  value="<?php echo 'OID'.rand(10,100);?>" name="orderid">
                    <input type="hidden" ame="grand_total" value="<?php echo 1; ?>">
                </div>
               
                <button type="submit" name="submit">Confirm Order</button>
            </form>
        </div>
    </div>
    
</body>
</html>