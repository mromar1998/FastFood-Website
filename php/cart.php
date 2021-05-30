<?php
session_start();
$getURL = $_GET["back"];
$id = $_GET["id"];
if (isset($_SESSION['cart'])){
//    if (($key = array_search($id,$_SESSION['cart']))!==false){
//        unset($_SESSION['cart'][$key]);
//    }else{
        array_push($_SESSION["cart"],$id);
//    }
}else{
    $_SESSION['cart'] = array($id);
}//time() - 3600,time() + 60 * 60 * 24* 30
setcookie("Cart-Added",implode(",",$_SESSION["cart"]),time() + 60 * 60 * 24* 30,"/");
header('Location:'.$getURL);

