<?php
require 'dbconnect.php';
if(isset($_POST['update_update_btn'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE `mycart` SET Quantity = '$update_value' WHERE ID = '$update_id'");
    if($update_quantity_query){
       header('location:mycart.php');
    };
 };
 
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `mycart` WHERE ID= '$remove_id'");
    header('location:mycart.php');
 };
 if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `mycart`");
    header('location:mycart.php');
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="index1.css">
    <link rel="stylesheet" href="mycart.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
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

        <div class="container" style="margin-top: 60px">
            <section class="scart" >
                <table>
                    <thead>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total price</th>
                    </thead>
                    <tbody>
                        <?php
                    $sql = "SELECT * FROM `mycart`";
                    $grand_total=0;
                $result = mysqli_query($conn,$sql);  
                if(mysqli_num_rows($result)>0){              
                while ($data=mysqli_fetch_array($result)){
            ?>  
                                <tr>
                                    <td><img src="<?php echo $data['Image'];?>" height="100"  alt="imageS"></td>
                                    <td><?php echo $data['Name'];?></td>
                                    <td><?php echo number_format($data['Price']);?>/-</td>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="update_quantity_id"  value="<?php echo $data['ID']; ?>" >  
                                            <input type="number" name="update_quantity" min="1" value="<?php echo $data['Quantity'];?>">
                                            <input type="submit" value="update" class="update-btn" name="update_update_btn">
                                        </form>
                                    </td>
                                    <td><?php echo $sub_total = number_format($data['Price'] * $data['Quantity']); ?>/-</td>
                                    <td><a href="mycart.php?remove=<?php echo $data['ID']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="delete-btn"></i> Remove</a></td>
                                </tr>
                                <?php
                                $grand_total+=((int)$sub_total);
                                };
                            };
                                 ?>
                                 <tr>
                                    <td><a href="index.php" class="delete-btn" style="margin-top:0;">continue shopping</a></td>
                                    <td colspan="3">Grand Total</td>
                                    <td><?php echo $grand_total; ?>/-</td>
                                    <td><a href="mycart.php?delete_all" onclick="return confirm('are you want to delete all?');" class="delete-btn"><i class="delete-btn"></i>Delete All</a></td>
                                 </tr>
                    </tbody>
                </div>
                </table>
                <div class="checkout-btn">
                    <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
                </div>
             </section>
        </div>
</body>
</html>
