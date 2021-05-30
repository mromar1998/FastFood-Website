<?php


class Meal_db
{
    private mysqli $link;
    private $pdo;

    public function __construct()
    {
        $this->link = mysqli_connect('localhost','root','',"Meals");
    }
    /**
     * @return false|mysqli
     */
    public function getAllMeals():?array{
        $sql = "SELECT * from meal m";
        $result = mysqli_query($this->link,$sql);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
    public function getMealById($id):?array{
        $sql = "SELECT * from meal m
                where m.id = $id";
        $result = mysqli_query($this->link,$sql);
        return mysqli_fetch_array($result,MYSQLI_ASSOC);
    }
    public function getMealReviews($id){
        $sql = "SELECT r.* ,m.id from reviews r
                left join meal m on m.id = r.meal_id
                where r.meal_id = $id";
        $result = mysqli_query($this->link,$sql);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
        
    public function addMealReview($data): bool{
        if($this->uploadFile($data['image'])){
        $meal_id = $data['id'];
        date_default_timezone_set('Kuwait/Riyadh');
        $date = date('Y-m-d H:i:s');
        $reviewer_name = mysqli_real_escape_string($this->link,$data['reviewer_name']);
        $city = mysqli_real_escape_string($this->link,$data['city']);
        $rating = $data['rating'];
        $image = $data['image']['name'];
        $review = mysqli_real_escape_string($this->link,$data['review']);
        $sql = "insert into reviews (reviewer_name,city,date,rating,image,review,meal_id)
                            values ('$reviewer_name','$city','$date','$rating','$image','$review','$meal_id')";
//            $stmt = mysqli_stmt_init($this->link);
//            mysqli_stmt_prepare($stmt,$sql);
//            mysqli_stmt_bind_param($stmt,'sssdssi',$reviewer_name,$city,$date,$rating,$image,$review,$meal_id);
//            return mysqli_stmt_execute($stmt);
        if(mysqli_query($this->link,$sql)){
            return true;
        }else{
            echo "Error Excucting $sql".mysqli_error($this->link);
            return false;
        }

        }
        mysqli_close($this->link);
        }


    private function uploadFile($file): bool{
        $targetFile = "images/projectImages/".basename($file['name']);
        return move_uploaded_file($file['tmp_name'],$targetFile);
    }

    public function getRating($id):?array{
        $sql = "select meal.* ,ifnull( avg(reviews.rating),0) as average
from meal
         left join reviews
                   on $id=reviews.meal_id
group by meal_id;";
        $result = mysqli_query($this->link,$sql);
        return mysqli_fetch_array($result,MYSQLI_ASSOC);
    }
   

}