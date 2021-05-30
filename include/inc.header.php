<?php
$url = $_SERVER['REQUEST_URI'];
$Home =str_contains($url,'index')? 'active':'';
$cartCount = 0;
$totalPrice = 0;


$MealObj = new Meal_db();
$CartObj = $_COOKIE['Cart-Added']??"";


?>

<!--Bootstrap 4 navbar-->
<!DOCTYPE html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="css/style.css"
          rel="stylesheet"
          type="text/css"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400&family=Roboto&display=swap"
          rel="stylesheet">
    <title>Challenge</title>
</head>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top myNav">
    <a class="navbar-brand" href="#">
        <img alt="logo" src="images/projectImages/logo-White.svg" style="max-width:10rem">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sideMenu-nav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="sideMenu-nav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class=<?php echo '"' ."nav-link group1 $Home".'"' ?> href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link group1" href="#menu">Menu</a></li>
            <li class="nav-item"><a class="nav-link group1" href="#gallery"> Gallery</a></li>
            <li class="nav-item"><a class="nav-link group1" href="#Testimonials">Testimonials</a></li>
            <li class="nav-item"><a class="nav-link group1" href="#contact">ContactUs</a></li>
            <li class="nav-item"><a class="nav-link group2" href="#">Search</a></li>
            <li class="nav-item"><a class="nav-link group2" href="#">Profile</a></li>
            <li class="nav-item"><a href="#" class="nav-link group2"  data-toggle="modal" data-target="#checkout">Cart<span id="numCart"><?php

                        if (strlen($CartObj)>0){
                        $Cartcc = explode(",",$CartObj);
                        echo count($Cartcc);
                        }else{
                           echo $cartCount;
                        }
                        ?></span></a></li>
        </ul>
    </div>
</nav>
<!-- CheckOut model     -->


 
                <div class="col ">

<div class="container checkout-container">
    <div class="modal fade" id="checkout">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="font-family: Arial,serif">Cart content</h4>
                    <button type="button" class="close checkout-close" data-dismiss="modal">&times;</button>

                </div>

                <div class="modal-body">
                    <div class="row mb-1">
                  
         
                        <div class=" col-9">
                            <h6 style="font-family: Arial,serif">Item</h6>
                        </div>
                      
                        <div class=" col-3">
                            <h6 style="font-family: Arial,serif">Price</h6>
                        </div>
                    </div>
                    <!--                        Orders -->
                    <?php if (strlen($CartObj)>0):
                        $CartObj = explode(",",$CartObj);

                    ?>



                        <?php foreach ($CartObj as $CartId) {
                            $modalMeal = $MealObj->getMealById($CartId);
                            $price = $modalMeal["price"];
                            $totalPrice += $price;
                        ?>
                            <div class="row mb-1 justify-content-center align-items-center" style="height: 100px">
                                <div class=" col-3">
                                    <img src=<?php echo "images/projectImages/" . $modalMeal["image"] ?> style="width: 100px" alt="meal">
                                </div>
                                <div class=" col-6">
                                    <h6 style="font-family: Arial,serif"><?php echo $modalMeal["title"] ?></h6>
                                </div>
                                <div class="col-3" >
                                    <h6 style="font-family: Arial,serif"><span class="cart-price"><?php echo $modalMeal["price"] ?></span></h6>
                                </div>
                            </div>

                        <?php } ?>

                    <!--                               -->
                    <?php endif ?>
                    <div class="row mb-1">
                        <div class="col-9">
                            <h6 style="font-family: Arial,serif">Total</h6>
                           
                        </div>
                        <div class="col-3">
                          
                            <span><b id="totalPrice"> <?php echo $totalPrice ?></b></span> SAR
                        </div>

                   
                    </div>

                </div>
                <div class="modal-footer">
                    <form method="POST" action="php/order.php?" id="OrderNowForm">
                        <input type="hidden" name="ids" value="<?php echo $_COOKIE["Cart-Added"] ?>">
                        <input type="hidden" name="totalPrice" value="<?php echo $totalPrice ?>">
                    </form>
                    <button type="button" class="btn btn-default checkout-close-btn " data-dismiss="modal">Close</button>
                    <button form="OrderNowForm" type="submit" class="btn btn-default checkout-btn orderbutton" id="finalOrder" data-target="modal">Order Now</button>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- CheckOut model     -->


