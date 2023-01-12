<?php
    session_start();
    $conn = require_once("../auth/config.php");
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $OrderId = $_POST['OrderId'];
        $sql = sprintf("UPDATE %s SET %s WHERE %s;","orders","OrderStatus='CANCELLED'","OrderId='$OrderId'");
        if(mysqli_query($conn,$sql)){
            echo "<script>alert('已取消訂單');window.location.href='./startproduce.php';</script>"; 
        }else{
            echo "<script>alert('錯誤');window.location.href='./startproduce.php';</script>"; 
        }
    }
    echo "<script>window.location.href='./startproduce.php';</script>"; 
?>