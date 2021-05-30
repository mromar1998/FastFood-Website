//open add review section
$(document).ready(function () {
    $("#reviewButton").click(function () {
        $("#reviewID").slideDown();
        $('.slideMe').removeClass('slide-active1').addClass('slide-active');

    });
});
$('.sideNav').click(function (){
    $("#menuElements").slideToggle();

});

let tabletS = window.matchMedia("(max-width: 768px)");
tabletS.addEventListener('change',(ev =>{
    if (ev.matches){
        $("#menuElements").css('display',"block").hide();


    }else{
        $("#menuElements").css('display',"flex").show();
    }
} ));
// gallery card
// var addToCartButton = document.getElementsByClassName("addtocartbutton");
// for( var i = 0 ; i < addToCartButton.length ; i++){
//     var button = addToCartButton[i]
//     button.addEventListener('click',addToCartClicked)
//     var cookie = document.cookie
//         .split(';')
//         .map(cookie=>cookie.split('='))
//         .reduce((accumulator,[key,value])=>({...accumulator,[key.trim()]: decodeURIComponent(value)}),{});
// //alert(cookie["Cart-Added"]);
//     function addToCartClicked(event){
//         var button = event.target
//         var galleryItem = button.parentElement
//         var itemName = galleryItem.getElementsByClassName('card-title')[0].innerText
//         var itemPrice = galleryItem.getElementsByClassName('item-price')[0].innerText
//         var itemImg = galleryItem.parentElement.getElementsByClassName('card-img-top')[0].src
//         addItemToCart(itemName,itemPrice,itemImg);
//     }
//
//     function addItemToCart(name,price,img){
//         var cartRow = document.createElement('div');
//         var cartItems = document.getElementsByClassName('cart-item')[0]
//         var cartRowContent =` <div class="row mb-1 justify-content-center align-items-center" style="height: 100px">
//                         <div class=" col-3">
//                             <img src="${img}" style="width: 100px" alt="meal">
//                         </div>
//                         <div class=" col-6">
//                             <h6 style="font-family: Arial,serif">${name}</h6>
//                         </div>
//                         <div class="col-3" >
//                             <h6 style="font-family: Arial,serif"><span class="cart-price">${price}</span></h6>
//                         </div>
//                     </div>`
//         cartRow.innerHTML = cartRowContent
//         cartItems.appendChild(cartRow)
//         // cartItems.insertBefore(cartRow, cartItems.childNodes[2])
//         updateCartTotal();
//     }
//     function updateCartTotal(){
//         var cartItems = document.getElementsByClassName('cart-item')[0]
//         var carRows = cartItems.getElementsByClassName('row')
//         var total = 0
//         for(var i = 0 ; i < carRows.length ; i++){
//             var cartRow = carRows[i];
//             var priceItem = cartRow.getElementsByClassName('cart-price')[0]
//             var price = parseFloat(priceItem.innerText.replace(" SAR", ''))
//             total = total + price;
//         }
//         document.getElementById('totalPrice').innerText = total +" SAR"
//     }
//     document.getElementsByClassName("checkout-btn")[0].addEventListener('click',checkoutClick)
//     function checkoutClick(){
//         // numCart.innerText = 0;
//         alert("Thank you for your purchase");
//         var cartItems = document.getElementsByClassName('cart-item')[0];
//         while( cartItems.hasChildNodes()){
//             cartItems.removeChild(cartItems.firstChild);
//         }
//         updateCartTotal();
//
//     }}

// end of gallery card
// end of review section
const numCart = document.getElementById("numCart");
const numAdd = document.querySelector(".number");
const form = document.getElementById("reviewID");
const textReview = document.getElementById("reviewText");
const error = document.getElementById("wrongmsgID");
$quantity=1;

let numOfItemInCart = 0, currentItem = 1;

// increment the quantity
function increment() {
    numAdd.innerText = ++currentItem;

}




// decrement the quantity until zero
function decrement() {
    if (currentItem > 0) {
        numAdd.innerText = --currentItem;
        $quantity++;
    } else
        alert("Negative Number");
}

// add the quantity to the cart
function addToCart() {
    numOfItemInCart += currentItem;
    numCart.innerHTML = numOfItemInCart;
}

// function addYourReview(){
//     reviewPart.classList.remove("hide")
// }

// Textarea char counter
function textCount() {
    document.getElementById("wordCount").innerText = document.getElementById("reviewText").value.length;
}
//end of textarea char counter
// review slider
let slideIndex = 1;
showSlide(slideIndex);


function nextSlide(n){
    showSlide(slideIndex += n);
}
function currentSlide(n){
    showSlide(slideIndex = n);
}
function showSlide(n){
    var i;
    var Slides = document.getElementsByClassName("slider");
    var Dots = document.getElementsByClassName("dot");
    if( n > Slides.length ){
        slideIndex = 1;
    }if(n < 1){
        slideIndex = Slides.length;
    }
    for(i = 0 ; i < Slides.length ; i++){
        Slides[i].style.display =  "none";
    }
    for (i = 0 ; i < Dots.length ; i++){
        Dots[i].className = Dots[i].className.replace(" slideShowActive","");
    }
    Slides[slideIndex-1].style.display = "flex";
    Dots[slideIndex-1].className += " slideShowActive";
    // setTimeout(showSlide, 10000);
    // slideIndex += 1;
}
// end of review slider

//Form submitting with handle exception
form.addEventListener('submit', (e) => {
    let wrongmsg = []
    if (textReview.value === "" || textReview.value === null) {
        $(error).show();
        wrongmsg.push("Please type your review")
        setTimeout(function () {
            $(error).hide();
        }, 3000);
    }
    if (wrongmsg.length > 0) {
        e.preventDefault();
        error.innerText = wrongmsg.join(', ');
    }
});
//end of Form submitting with handle exception

function pForm(dataForm){
    const postRequest = new XMLHttpRequest();
    postRequest.open('POST','review.php');
    let data = new FormData(dataForm);
    postRequest.send(data);
    postRequest.onreadystatechange = ()=>{
        if(postRequest.readyState===4 && postRequest.status===200){
            if(postRequest.response){
            showReview(dataForm.firstElementChild.value);
            document.getElementById("reviewID").reset();

            $("#reviewID").slideUp();
            }
        }
    }
    return false
}
function showReview(id) {
    $("#reviewID").slideUp();
    $('.slideMe').removeClass('slide-active').addClass('slide-active1');
    var y = document.getElementById("descriptionID");
    var x = document.getElementById("reviewID2");
    x.style.display = "block";
    y.style.display = "none"
    let showReviews = new XMLHttpRequest();
    showReviews.open('GET', 'review.php?id='+id, true)
    showReviews.send();
    showReviews.onreadystatechange =  ()=> {
        if (showReviews.readyState === 4 && showReviews.status === 200) {
            let reviewsResponse = JSON.parse(showReviews.response)
            // console.log(reviewsResponse.length);
            let output = (reviewsResponse.length > 0) ? "" : "<h2>No Reviews</h2>"
            let Indicators = "";
            if (reviewsResponse.length > 0) {
                reviewsResponse.forEach((review) => {
                    // ${review["image"]}
                    // ${review["reviewer_name"]}
                    // ${review["city"]} - ${review["date"]}
                    // ${review["rating"]}
                    // ${review["review"]}
                    var counter = 0;


                    Indicators += `
                                <li data-target="#demo" data-slide-to="${counter}" class="" style="background-color:  #FFAA00 !important;"></li>
                                `;
                    for (j=0 ; j < reviewsResponse.length ; j++)
                        counter++;

                    let Rating ="";
                    for (i=0 ; i<review["rating"];i++)
                        Rating+="⭐";

                    output += `
                   
                    <div class="carousel-item">
                        <div class="review-container">
                        <div class="review-item review-item-1">
                            <img src="images/projectImages/${review["image"]}"  alt="man eat burger"
                                 style="max-height: 25rem">
                        </div>
                         <div class="review-item review-item-2">
                           <h4> ${review["reviewer_name"]} </h4>
                             <h5> ${review["city"]} - ${review["date"]} ${Rating} <h5>
                             <p> ${review["review"]} </p>
                             </div>
                             </div>
                             </div>
                 `;
                });
            }
            document.querySelector('.carousel-inner').innerHTML = output;
            document.querySelector('.carousel-indicators').innerHTML = Indicators;
            document.querySelector('.carousel-inner').firstElementChild.classList.add("active");
            document.querySelector('.carousel-indicators').firstElementChild.classList.add("active");
        }
    }

}


function show_description() {
    var y = document.getElementById("descriptionID");
    var x = document.getElementById("reviewID2");

    x.style.display = "none";
    y.style.display = "block";

}

