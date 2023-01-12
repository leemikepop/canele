<?php
    session_start();
    // $_SESSION["loggedin"] = true;
    // $_SESSION["Ssn"] = $result["Ssn"];
    // $_SESSION["Name"] = $result["Name"];
    // $_SESSION["Position"] = $result["Position"];
    if(!isset($_SESSION['loggedin'])){
        header("location:../auth/index.php");
    }
?>