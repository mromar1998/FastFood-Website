<?php

echo "HELLO";
$ids = $_POST['ids'];
if (isset($ids)) {

    setcookie("recent-bought",$ids, time() + 60 * 60 * 24* 30, "/");
    setcookie("Cart-Added", "", time() - 3600, "/");
    setcookie("PHPSESSID", "", time() - 3600, "/");
    session_destroy();
}
else{
    setcookie("recent-bought", "", time() - 3600, "/");
}
header('Location: ../index.php?');