<?php
    session_start();
    $conn=require_once("../auth/config.php");
    $Ssn = $_SESSION['Ssn'];
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $MealId = $_POST['MealId'];
        if(isset($MealId)){
            $sql=sprintf("DELETE FROM %s WHERE %s","`menu`","MealId='$MealId'");
            if(mysqli_query($conn,$sql)){
                echo "<script>alert('已刪除$MealId');window.location.href='./editmenu.php';</script>"; 
            }else{
                echo "<script>alert('Ooops!失敗！');window.location.href='./editmenu.php';</script>"; 
            }
        }
    }
?>