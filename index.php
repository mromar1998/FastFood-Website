<?php
if (isset($_COOKIE['Cart-Added']))
    $_SESSION['cart'] = explode(",",$_COOKIE["Cart-Added"]);
      
require_once "php/meal_db.php";
include 'include/inc.header.php';
$Meals = new Meal_db();

$meal = $Meals->getAllMeals();
//var_dump($meal);
$recent = $_COOKIE['recent-bought']??"";
?>

<html lang="en">
<div id="partysection">
    <!--Bootstrap 4 navbar-->

    <h1>Party Time</h1>
    <div class="shape" style="position: static">
        <h3 class="inshape">Buy any 2 burgers and get 1.5L Pepsi Free</h3>
    </div>
    <div id="ordernow">
        <a class="orderbutton" href="#">Order Now</a>
    </div>

</div>
<body>

<?php if (strlen($recent)>0):
    $recent = explode(",",$recent);
    ?>

    <!--    RECENT ITEM-->

    <div class="container myGalleryCon py-5">
        <h2>Your Recent Bought Product</h2>
        <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-4 ">
            <!--                    CARD-->

            <?php foreach (array_unique($recent) as $recentBuy) {
            $recMeal = $Meals->getMealById($recentBuy);
            $rating_db = $Meals->getRating($recentBuy);
            ?>
            <form method="post"
                  action="php/cart.php?<?php echo "id=" . $recMeal["id"] . "&back=..%2Findex.php%23gallerySection"; ?>">
                <div class="col ">
                    <div class="card myCard-style">
                        <a href=<?php echo "detail.php?id=" . $recMeal["id"] ?>><img class="card-img-top" alt="meal1"
                              src=<?php echo "images/projectImages/" . $recMeal["image"] ?>></a>
                        <div class="card-body">
                            <p> &#11088; <?php echo number_format((float) $rating_db['average'], 2, '.', '') ?> Rating</p>
                            <h4 class="card-title"><?php echo $recMeal["title"] ?></h4>
                            <p>Some description</p>
                            <!--                                <a class="addtocartbutton btn" href="php/cart.php?-->
                            <?php //echo "id=" . $recMeal["id"] . "&back=..%2Findex.php%23gallerySection"; ?><!--">Add to cart</a>-->
                            <button class="addtocartbutton btn" type="submit" onclick="addToCart()">Buy Again</button>
                            <span class="item-price"><?php echo number_format((float)"id=" . $recMeal["price"] , 2, '.', '') ?> SAR</span>
            </form>
        </div>
    </div>
    </div>
    <?php } ?>
    <!--                   end CARD-->
    </div>
    </div>
<?php endif ?>
    <!--    END OF RECENT-->
    <!--        Menu Section-->
    <article id="menuSection">
        <a name="menu"></a>
        <h2>Want to eat</h2>
        <p>Try our most delicious food and usually take minutes to deliver</p>
        <ul>
            <li><a class="items" href="">Burger</a></li>
            <li><a class="items" href="">Pizza</a></li>
            <li><a class="items" href="">FastFood</a></li>
            <li><a class="items" href="">Cupcake</a></li>
            <li><a class="items" href="">Sandwich</a></li>
            <li><a class="items" href="">Spaghetti</a></li>
        </ul>
    </article>
    <div id="menuSection2">
        <div class="sidemenu sidemenu-left">
            <img alt="Delivery man" id="deliveryman" src="images/projectImages/delivery.png">
        </div>
        <div class="sidemenu sidemenu-right">
            <ul>

                <li class="shaptri"><h2 class="inshapetri">We guarantee 30 minutes delivery</h2></li>

                <li class="para"><p>if your are having a meeting working late all nigt and need an extra oush</p></li>
            </ul>
        </div>

    </div>
    <!--        End of Menu-->
    <!--        Gallery Section-->

    <article id="gallerySection">
        <a name="gallery"></a>
        <h2>Our most popular recipes</h2>
        <p>Try our most delicious food and usually take minutes to deliver</p>
        <div class="container myGalleryCon">

            <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-4 ">
                <!--                    CARD-->
                <?php foreach ($meal as $mealObj) {
                     $rating_db = $Meals->getRating($mealObj["id"]);
                      ?>
                  
                <form method="post"
                      action="php/cart.php?<?php echo "id=" . $mealObj["id"] . "&back=..%2Findex.php%23gallerySection"; ?>">
                    <div class="col ">
                        <div class="card myCard-style">
                            <a href=<?php echo "detail.php?id=" . $mealObj["id"] ?>><img class="card-img-top"
                                          alt="meal1"
                                           src=<?php echo "images/projectImages/" . $mealObj["image"] ?>></a>
                            <div class="card-body">
                                <p> &#11088; <?php echo number_format((float) $rating_db['average'], 2, '.', '') ?> Rating</p>
                                <h4 class="card-title"><?php echo $mealObj["title"] ?></h4>
                                <p>Some description</p>
                                <!--                                <a class="addtocartbutton btn" href="php/cart.php?-->
                                <?php //echo "id=" . $mealObj["id"] . "&back=..%2Findex.php%23gallerySection"; ?><!--">Add to cart</a>-->
                                <button class="addtocartbutton btn" type="submit" >Add to cart
                                </button>
                                <span class="item-price"><?php echo number_format((float)"id=" . $mealObj["price"] , 2, '.', '') ?> SAR</span>
                </form>
            </div>
        </div>
        </div>
        <?php } ?>
        <!--                   end CARD-->
        </div>
        </div>
        <!--        </div>-->


    </article>

    <!--        End of Gallery-->
    <!--        Testimonials Section-->
    <a name="Testimonials"></a>
    <article class="TestimonialsSection">
        <h2>Clients testimonials</h2>
        <!--        first slide             -->
        <div class="slidesContainar">
            <div class="testSection-containar slider sliderFade">
                <div class="testSection testSection-1">
                    <img alt="man eat burger" src="images/projectImages/man-eating-burger.png">
                </div>
                <div class="testSection testSection-2">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque ullam deserunt laboriosam,
                        veritatis
                        quibusdam blanditeiis dolor exercitationem velit commodi quae assumenda incidunt voluptas.
                        Corporis
                        ex
                        nulla repellendus ullam nihi ! 1
                    </p>
                </div>
            </div>

            <div class="testSection-containar slider sliderFade">
                <div class="testSection testSection-1">
                    <img alt="man eat burger" src="images/projectImages/man-eating-burger.png">
                </div>
                <div class="testSection testSection-2">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque ullam deserunt laboriosam,
                        veritatis
                        quibusdam blanditeiis dolor exercitationem velit commodi quae assumenda incidunt voluptas.
                        Corporis
                        ex
                        nulla repellendus ullam nihi ! 2
                    </p>
                </div>
            </div>

            <div class="testSection-containar slider sliderFade">
                <div class="testSection testSection-1">
                    <img alt="man eat burger" src="images/projectImages/man-eating-burger.png">
                </div>
                <div class="testSection testSection-2">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque ullam deserunt laboriosam,
                        veritatis
                        quibusdam blanditeiis dolor exercitationem velit commodi quae assumenda incidunt voluptas.
                        Corporis
                        ex
                        nulla repellendus ullam nihi ! 3
                    </p>
                </div>
            </div>
            <!--        end of first slide    -->
            <!--        Next and prev slide   -->
            <a class="nextSlide" onclick="nextSlide(1)">&#10095;</a>
            <a class="prevSlide" onclick="nextSlide(-1)">&#10094;</a>
        </div>
        <!--   End of Next and prev slide -->
        <!--    Three dots                -->
        <div class="dotsSlide">
            <div class="dot dot-1" onclick="currentSlide(1)"></div>
            <div class="dot dot-2" onclick="currentSlide(2)"></div>
            <div class="dot dot-3" onclick="currentSlide(3)"></div>
        </div>
        <!--   end of Three dots          -->
    </article>
    <!--        End of Testimonials-->
    <?php
    include 'include/inc.footer.php';
    ?>
    <script
            src="js/app.js"
    ></script>
    </body>

</html>
