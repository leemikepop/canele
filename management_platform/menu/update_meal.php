<?php

    /*TODO 刪除原本的圖片*/
    session_start();
    $conn=require_once("../auth/config.php");
    $Ssn = $_SESSION['Ssn'];
    if($_SERVER['REQUEST_METHOD']=="POST"&&isset($Ssn)){
        $image_file = $_FILES["ImgFile"];
        if(isset($image_file)){
            $ImgDir ="./Images/" . $image_file["name"];
            $ImgName = $image_file["name"];
            move_uploaded_file(
                // Temp image location
                $image_file["tmp_name"],
                // New image location
                __DIR__ . "/Images/" . $image_file["name"]
            );
            $MealId = $_POST['MealId'];
            $MealName = $_POST['MealName'];
            $Price = $_POST['Price'];
            $Note = $_POST['Note'];
            $StartDate = $_POST['StartDate'];
            $ExpiryDate = $_POST['ExpiryDate'];
            $sql=sprintf("UPDATE %s SET %s WHERE %s;","`menu`","Ssn='$Ssn',Name='$MealName',Price='$Price',Note='$Note',ImgName='$ImgName',ImgDir='$ImgDir',StartDate='$StartDate',ExpiryDate='$ExpiryDate'"
                ,"MealId='$MealId'");
            if(mysqli_query($conn,$sql)){
                echo "<script>alert('更新成功！');window.location.href='./editmenu.php';</script>"; 
            }else{
                echo "<script>alert('Ooops!更新失敗！');window.location.href='./editmenu.php';</script>"; 
            }
        }else{
            $MealId = $_POST['MealId'];
            $MealName = $_POST['MealName'];
            $Price = $_POST['Price'];
            $Note = $_POST['Note'];
            $StartDate = $_POST['StartDate'];
            $ExpiryDate = $_POST['ExpiryDate'];
            $sql=sprintf("UPDATE %s SET %s WHERE %s;","`menu`","Ssn='$Ssn',Name='$MealName',Price='$Price',Note='$Note',StartDate='$StartDate',ExpiryDate='$ExpiryDate'","MealId='$MealId'");
            if(mysqli_query($conn,$sql)){
                echo "<script>alert('更新成功！');window.location.href='./editmenu.php';</script>"; 
            }else{
                echo "<script>alert('Ooops!更新失敗！');window.location.href='./editmenu.php';</script>"; 
            }
        }
        
    }
?>