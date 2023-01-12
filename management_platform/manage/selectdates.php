<?php
session_start();
    if($_SERVER['REQUEST_METHOD']=="POST"){

        $_SESSION['TakeDate'] = $_POST['TakeDate'];
        $_SESSION['DiliveredDate'] = $_POST['DiliveredDate'];
        // echo $_SESSION['TakeDate'];
        // echo $_SESSION['DiliveredDate'];
    }
    header("location:./startproduce.php");
?>