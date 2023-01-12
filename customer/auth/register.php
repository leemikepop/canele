<?php 
$conn=require_once("./config.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $CustomerName = $_POST['CustomerName'];
    $Email=$_POST["Email"];
    $Phone=$_POST["Phone"];
    $Password=$_POST["Password"];
    //檢查帳號是否重複
    $check = sprintf("SELECT %s FROM %s WHERE %s;","`Email`,`Phone`","`customer`","Email='$Email' OR Phone='$Phone'");
    $result = mysqli_query($conn,$check);
    if(mysqli_num_rows($result)==0){
        $sql=sprintf("INSERT INTO %s VALUES %s;","customer(CustomerName,Email,Phone,Password)","('$CustomerName','$Email','$Phone','$Password')");
        if(mysqli_query($conn, $sql)){
            echo "註冊成功!3秒後將自動跳轉頁面<br>";
            echo "<a href='../index.php'>未成功跳轉頁面請點擊此</a>";
            header("refresh:1;url=../index.php");
            exit;
        }else{
            echo "Error creating table: " . mysqli_error($conn);
        }
    }else{
        echo "該信箱或電話號碼已有人使用!<br>3秒後將自動跳轉頁面<br>";
        echo "<a href='./register.html'>未成功跳轉頁面請點擊此</a>";
        //header('HTTP/1.0 302 Found');
        header("refresh:1;url=./register.html",true);
        exit;
    }
}
mysqli_close($conn);
?>