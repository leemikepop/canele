<?php
    session_start();
    $conn=require_once "./config.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $Ssn=$_POST["Ssn"];
        $password=$_POST["password"];
        $password_hash=password_hash($password,PASSWORD_DEFAULT);

        $sql = sprintf("SELECT %s FROM %s WHERE %s;","*","`owner`","Ssn='$Ssn'");
        $result=mysqli_query($conn,$sql);
        
        if(mysqli_num_rows($result)==1){    
            $result =  mysqli_fetch_assoc($result);
            if($password==$result["Password"]){
                if($result['Status']=='ACTIVE'){
                    $_SESSION["loggedin"] = true;
                    $_SESSION["Ssn"] = $result["Ssn"];
                    $_SESSION["Name"] = $result["Name"];
                    $_SESSION["Position"] = $result["Position"];
                    header("location:../manage/index.php");
                }else{
                    function_alert("帳號異常，請聯繫管理員");
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