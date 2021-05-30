<?php

$data = array_merge($_POST,$_FILES);
require_once "php/meal_db.php";
require_once 'func.php';
function cleanUp($c){
    return array_map('e',$c);
}
$db = new Meal_db();

if ($_SERVER['REQUEST_METHOD']=='GET'){
    $review = $db->getMealReviews($_GET['id']);
    $review = array_map('cleanUp',$review);
    echo json_encode($review);
}else{
    echo json_encode($db->addMealReview($data));
}
