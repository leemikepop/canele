<?php
    session_start();
    $conn=require_once("../auth/config.php");
    $Ssn = $_SESSION['Ssn'];
    if($_SERVER['REQUEST_METHOD']=="POST"){
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
        }
        $MealName = $_POST['MealName'];
        $Price = $_POST['Price'];
        $Note = $_POST['Note'];
        $StartDate = $_POST['StartDate'];
        $ExpiryDate = $_POST['ExpiryDate'];
        $sql=sprintf("INSERT INTO %s VALUES (%s);","menu(Ssn,Name,Price,Note,ImgName,ImgDir,StartDate,ExpiryDate)"
            ,"'$Ssn','$MealName',$Price,'$Note','$ImgName','$ImgDir','$StartDate','$ExpiryDate'");
        if(mysqli_query($conn,$sql)){
            echo "<script>alert('新增餐點成功！');window.location.href='./editmenu.php';</script>"; 
        }else{
            echo "<script>alert('Ooops!新增失敗！');window.location.href='./editmenu.php';</script>"; 
        }
    }
?>