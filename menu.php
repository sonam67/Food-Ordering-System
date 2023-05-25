<?php
    session_start();
    
    require 'dbconnect.php';
    if(!isset($_SESSION['logged-in']) || $_SESSION['logged-in']!=true){
        header("location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index1.css">
    <title>Menu</title>
</head>
<body>
    <div class="Menu-page" id="menu">
        <div class="Menu"> 
            <?php
                $sql = "SELECT * FROM menu";
                $result = mysqli_query($conn,$sql);                
                while ($data = mysqli_fetch_array($result)){
            ?>         
            <div class="card">
                <div class="card-link">
                    <div class="card-image" style="background-image: url(<?php echo $data['Image'];?>);"></div>
                    <div class="container">
                        <div class="container-boundry">
                            <div class="dish-name"><?php echo $data['Name'];?></div>
                            <div class="details"><?php echo $data['Details'];?></div>
                            <div class="more-detail">
                                <!-- <form action="">
                                    <input type = "submit" value = "Like" class="hamburger" onclick="Like()">
                                        <img src="icon/hamburger.svg" alt="hamburger" style="width: 20px;height: 15px;">
                                    </input>
                                    <input type = "submit" value = "Dislike" class="cross" style="display: none;" onclick="Dislike()">
                                        <img src="icon/cross.svg" alt="hamburger" style="width: 20px;height: 15px;">
                                    </input>
                                </form>
                                <script>
                                function Like() {
                                    document.getElementsByClassName("cross")[0].style.display = "block";
                                    document.getElementsByClassName("hamburger")[0].style.display = "none";
                                }
                                
                                function Dislike() {
                                    document.getElementsByClassName("hamburger")[0].style.display = "block";
                                    document.getElementsByClassName("cross")[0].style.display = "none";
                                }
                                </script>                               -->
                                <div class="prize">₹<?php echo $data['Price'];?></div>

                            </div>
                        </div>     
                    </div>
            
                    <input type="hidden" name="Image" value="<?php echo $data['Image'];?>">
                    <div class="add-to-cart" >
                        <input type="submit" name="Add_To_Cart" value="Add To Cart">
                    </div>
                       
                </div>
            </div>
            <?php
                }
            ?>
        </div>    
    </div>
</body>
</html>