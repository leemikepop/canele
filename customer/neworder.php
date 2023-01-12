<?php
    session_start();
    $conn=require_once("./auth/config.php");
    $CustomerId = $_SESSION["CustomerId"];

    if($_SERVER["REQUEST_METHOD"] == "POST"&&isset($CustomerId)){
        // $sql = sprintf("SELECT %s FROM %s WHERE %s(SELECT %s FROM %s);","OrderId","orders","CreatedTS=","max('CreatedTS')","orders");
        $Type = $_POST["OrderForm"];
        $OrderNote = $_POST["OrderNote"];
        $sql = sprintf("INSERT INTO %s VALUES (%s)","orders(CustomerId,Type,Note)","'$CustomerId','$Type','$OrderNote'");
        if(mysqli_query($conn,$sql)){
            $OrderId = mysqli_insert_id($conn);
            if(isset($OrderId)&&isset($_SESSION["shoppingcart"])){
                $flag=false;
                foreach($_SESSION["shoppingcart"] as $key=>$value){
                    $NumIdName = "Num".$key;
                    $Num = $_POST[$NumIdName];
                    if($Num<=0){
                        continue;
                    }
                    $flag=true;
                    $sql = sprintf("INSERT INTO %s VALUES (%s);","ordermenu (`OrderId`,`MealId`,`NumOfMeal`)","'$OrderId','$key','$Num'");   
                    if(!mysqli_query($conn,$sql)){
                        mysqli_query($conn,"UPDATE `order` SET OrderStatus='FAILED' WHERE OrderId='$OrderId'");
                        mysqli_query($conn,"DELETE FROM `ordermenu` WHERE OrderId='$OrderId'");
                        echo "<script>alert('Ooops!ordermenu新增失敗！');window.location.href='./index.php';</script>";
                        break;
                    }
                }
                if(!$flag){
                    mysqli_query($conn,"UPDATE `orders` SET OrderStatus='FAILED' WHERE OrderId='$OrderId'");                   
                    echo "<script>alert('不可以新增空訂單！');window.location.href='./index.php';</script>";
                }
                unset($_SESSION['shoppingcart']);
                $Recipient = $_POST['Recipient'];
                $Phone = $_POST['Phone'];
                $Date = $_POST['Date'];
                $ShippingTime = isset($_POST['ShippingTime'])?$_POST['ShippingTime']:"";
                $ZipCode = isset($_POST['ZipCode'])?$_POST['ZipCode']:"";
                $Address = isset($_POST['Address'])?$_POST['Address']:"";
                $ShipNote = isset($_POST['ShipNote'])?$_POST['ShipNote']:"";
                $sql = sprintf("INSERT INTO %s VALUES (%s);","shipmentinfo(`OrderId`,`Recipient`,`Phone`,`Date`,`ShippingTime`,`ZipCode`,`Address`,`ShipNote`)"
                                ,"'$OrderId','$Recipient','$Phone','$Date','$ShippingTime','$ZipCode','$Address','$ShipNote'");
                if(!mysqli_query($conn,$sql)){
                    mysqli_query($conn,"UPDATE `order` SET OrderStatus='FAILED' WHERE OrderId='$OrderId'");
                    echo "<script>alert('Ooops!shipmentinfo新增失敗！');window.location.href='./index.php';</script>";
                }
                echo "<script>alert('成功新增訂單');window.location.href='./index.php';</script>";
            }else{
                echo "<script>alert('OrderId unset');window.location.href='./index.php';</script>";
            }
        }else{
            echo "<script>alert('Ooops!oder新增失敗！');window.location.href='./index.php';</script>";
        }
    }

?>