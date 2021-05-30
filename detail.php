
<?php
if (isset($_COOKIE['Cart-Added']))
$_SESSION['cart'] = explode(",",$_COOKIE["Cart-Added"]);
$id = $_GET["id"];
require_once "php/meals.php";
require_once "php/meal_db.php";
include 'include/inc.header.php';
$Meals = new Meals();
$Meals_db = new Meal_db();
$rating_db =$Meals_db->getRating($id);
$mealById = $Meals->getMealById($id);
$mealById_db = $Meals_db->getMealById($id);
$mealreview_db = $Meals_db->getMealReviews($id);

$recent = $_COOKIE['recent-bought']??"";

?>
<!DOCTYPE html>
<html lang="en">
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


<?php if (isset($_GET["id"])): ?>
    <body>



    <!--best sandwich -->
    <article class="galleryDetail">
    
        
        <form method="post"
                    
                  action="php/cart.php?<?php echo "id=" . $mealById["id"] ."&back=..%2Findex.php"; ?>">
                  <div class="best_container">
            <div class="bestSandwich-item bestSandwich-item-1">
                <img src=<?php echo "images/projectImages/" . $mealById_db["image"] ?>  style="max-height:60rem" alt="mealD">
            </div>
            <div class="bestSandwich-item bestSandwich-item-2">
                <h1><?php echo $mealById_db["title"] ?></h1>
                <p><?php echo number_format((float)$mealById_db["price"], 2, '.', '')  ?> SAR </p>
                <p> &#11088; <?php echo number_format((float) $rating_db['average'], 2, '.', '') ?> rating</p>
                <p><?php echo $mealById_db["description"] ?></p>

                <a class="minus" onclick="decrement()"  >-</a>
                <a class="number">1</a>
                <a class="plus" onclick="increment()" > +</a>
                <?php //echo "id=" . $mealObj["id"] . "&back=..%2Findex.php%23gallerySection"; ?><!--">Add to cart</a>-->
                <button class="addtocartbutton btn" type="submit" >Add to cart
                                </button>



            </div>
            </form>
        </div>

    </article>

    <!--description -->


    <!--    Three dots                -->
    <article>
        <div class="dotsSlide2">
            <button class="dot2 dot-1 " id="home" onclick="show_description()"> description</button>
            <button class="dot2 dot-2" onclick="showReview(<?php echo $mealById_db['id'] ?>)">Review</button>
        </div>


    </article>


    <!--   end of Three dots          -->
    <div id="descriptionID">
        <div class="description_container">
            <div class="description2">
                <p>Lorem, ipsum dolar sit amet consectur adisicing elite, alias dolore hie quaerat deserunt poero
                    eveniet maiores repellendus! lusto architecto, officia impedit consequmntur earum voluptatum totam
                    quo minima molestine velit nesciunt voluptas preaseninm est. </p>
            </div>
            <div class="description3">
                <p>Nam nesciunt ex earum inventore corrupti consequunfur molestias accusamus eaque, dignissimos
                    exercitationem explicebo expedita adipisei dolor nisi! Blanditiis cmnis, nobis earum non architecto
                    sapiente tempora asperiores minus, hie,deleniti </p>
            </div>
        </div>

        <!--Table section -->
<!-- test -->

        <table>

            <div class="n_fact">
                <h2>nutrition facts</h2>
            </div>
            <tr>
                <td colspan="3" class="highlightTable"><b>Supplement Facts</b></td>
            </tr>
            <tr>
                <td colspan="3" class="highlightTable"><b>Serving Size: </b><?php echo $mealById["nutrition"]["serving_size"] ?></td>
            </tr>
            <tr>
                <td colspan="3" class="highlightTable"><b>Serving Per Container: </b></b><?php echo $mealById["nutrition"]["serving_per_container"] ?></td>

            </tr>
            <tr>
                <td></td>
                <td><b>Amount Per Serving </b></td>
                <td><b>%Daily Value*</b></td>
            </tr>
            <?php for($i = 0 ; $i < count($mealById["nutrition"]["facts"]); $i++){?>
            <tr>

                <td><?php echo $mealById["nutrition"]["facts"][$i]["item"] ?> </td>
                <td><?php echo $mealById["nutrition"]["facts"][$i]["amount_per_serving"] ." ". $mealById["nutrition"]["facts"][$i]["unit"] ?></td>
                <td><?php echo $mealById["nutrition"]["facts"][$i]["daily_value"] ?></td>

            </tr>
            <?php } ?>
            <tr>
                <td colspan="3">*Percent Daily Values are based on a 2,000 calories diet. Your daily values may be
                    higher or lower depending on your calorie needs
                </td>
            </tr>
        </table>
    </div>
    <!-- End of table section-->
    <!--        Review section-->
   
    <div id="reviewID2" class="reviewForm2 hide">
        <div class="review-section">
            <a name="review"></a>
            <h3>Reviews</h3>
          
                   
       <!--      slide        -->
      <body>
       <div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators" >

  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner " >

      </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev" >
    <span class="carousel-control-prev-icon" style="background-color:  #bbb !important;"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon" style="background-color:  #bbb !important;"></span>
  </a>
  </div>
</div>
</body>     
     <!--      end of Review section-->
     
    
        </article>
        <article id="review">
            <button id="reviewButton" class="review-button" onclick="addYourReview()">Add Your Review</button>

            <form name="form" id="reviewID" class="reviewForm hide" method="POST" action="review.php"
                  enctype="multipart/form-data" onsubmit="return pForm(this)">
                <input type="hidden" name="id" id="formID" value="<?php echo $mealById_db['id'] ?>">
                <div class="box slideMe">
                    <p>
                        <label for="file">Image</label></p>
                    <p>
                        <input type="file" id="file" name="image" required>
                    </p>
                    <p>
                        <label for="RateFood">Rate the food</label>
                    </p>
                    <input type="range" id="RateFood" name="rating"
                           min="0" max="5" list="rate">
                    <datalist id="rate">
                        <option value="1"></option>
                        <option value="2"></option>
                        <option value="3"></option>
                        <option value="4"></option>
                        <option value="5"></option>
                    </datalist>
                    <input type="hidden" name="id" id="formID" value="<?php echo $mealById_db['id'] ?>">
                    <p>Name </p>
                    <div class="input-name">
                        <input type="text" id="reviewerName" name="reviewer_name" placeholder="First and last name " required>
                    </div>
                    <p>City</p>
                    <div class="input-name">
                        <input type="text" id="city" name="city" placeholder="City name" required>
                    </div>
                    <p>Review</p>
                    <div class="input-review">
                        <div id="wrongmsgID" class="wrongmsg"></div>
                        <input id="reviewText" type="text" name="review"
                               placeholder=" Type your review here max 500 charecters " maxlength="500"
                               onkeyup="textCount()">
                        <p><span id="wordCount">0</span> / 500</p>
                    </div>
                    <div>

                        <button type="submit" id="submitReview" class="submit-button">Submit</button>
                    </div>
                </div>
            </form>
         
        </article>
    </div>
    </div>
    </div>
    <!--        End of Review section-->

    <script
            src="js/app.js"
    ></script>
    </body>
<?php endif ?>

<?php
include 'include/inc.footer.php';
?>

</html>
