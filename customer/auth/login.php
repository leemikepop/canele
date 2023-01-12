<?php
    session_start();
    $conn=require_once "./config.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $userName=$_POST["userName"];
        $password=$_POST["password"];
        $password_hash=password_hash($password,PASSWORD_DEFAULT);

        $sql = sprintf("SELECT %s FROM %s WHERE %s;","*","`customer`","Email='$userName' OR Phone='$userName'");
        $result=mysqli_query($conn,$sql);
        
        if(mysqli_num_rows($result)==1){    
            $result =  mysqli_fetch_assoc($result);
            if($password==$result["Password"]){
                if($result['Status']=='ACTIVE'){
                    $_SESSION["loggedin"] = true;
                    $_SESSION["CustomerId"] = $result["CustomerId"];
                    $_SESSION["CustomerName"] = $result["CustomerName"];
                    $_SESSION["Email"] = $result["Email"];
                    $_SESSION["Phone"] = $result["Phone"];
                    header("location:../index.php");
                }else{
                    function_alert("帳戶凍結中，請聯繫客服");
                }
            }
        }else{
                function_alert("帳號或密碼錯誤"); 
        }
    }else{
        function_alert("Something wrong"); 
    }

    mysqli_close($link);

    function function_alert($message) {        
        // Display the alert box  
        echo "<script>alert('$message');
        window.location.href='./index.php';
        </script>"; 
        return false;
    }
?>