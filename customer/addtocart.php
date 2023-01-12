<?php
    session_start();
    if(isset($_SESSION["CustomerId"])){
        if($_SERVER['REQUEST_METHOD']=="GET"){
            $MealId = $_GET['MealId'];
            if(isset($_SESSION["shoppingcart"]["$MealId"])){
                $_SESSION["shoppingcart"]["$MealId"] += 1;
            }else{
                $_SESSION["shoppingcart"]["$MealId"] = 1;
            }
        }
        header("location:./index.php");
    }else{
        header("location:./auth/index.php");
    }

?>