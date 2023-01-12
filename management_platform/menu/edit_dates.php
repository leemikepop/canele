<?php

    /*TODO 刪除原本的圖片*/
    session_start();
    $conn=require_once("../auth/config.php");
    $Ssn = $_SESSION['Ssn'];
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $SelectedDates = $_POST['SelectedDates'];
        $SDatesArr = explode(";",$SelectedDates);
        $currentDate = date("Y-m-d");
        $sql = sprintf("SELECT %s FROM %s WHERE %s;","Date","closeddate","Date>$currentDate AND Closed='1'");
        $result = mysqli_query($conn,$sql);
        $CdatesArr = [];
        while($row = mysqli_fetch_assoc($result)){
            array_push($CdatesArr,$row['Date']);
        }
        $ClosedtoOpened = array_diff($CdatesArr,$SDatesArr);
        foreach($ClosedtoOpened as $date){
            $sql=sprintf("UPDATE %s SET %s WHERE %s;","`closeddate`","Closed='0'","Date='$date'");
            if(!mysqli_query($conn,$sql)){
                echo "<script>alert('Ooops!C2O更新失敗！');</script>";
            }
        }
        $OpenedtoClosed = array_diff($SDatesArr,$CdatesArr);
        foreach($OpenedtoClosed as $date){
            $sql = sprintf("SELECT %s FROM %s WHERE %s;","*","closeddate","Date='$date'");
            $r = mysqli_query($conn,$sql);
            if(mysqli_num_rows($r)==0){
                $sql=sprintf("INSERT INTO %s VALUES %s;","closeddate(`Date`,`Closed`)","('$date','1')");
                mysqli_query($conn,$sql);
            }else{
                $sql=sprintf("UPDATE %s SET %s WHERE %s;","`closeddate`","Closed='1'","Date='$date' AND Closed='0'");
                if(!mysqli_query($conn,$sql)){
                    echo "<script>alert('Ooops!O2C更新失敗！');</script>";
                }
            }
        }
        echo "<script>alert('更新成功！');window.location.href='./editcalander.php';</script>";
    }else{
        echo "<script>window.location.href='./editcalander.php';</script>";
    }
?>