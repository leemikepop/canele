<?php
    session_start();
    $conn=require_once("../auth/config.php");
    $CustomerId = $_SESSION["CustomerId"];

    if($_SERVER["REQUEST_METHOD"] == "POST"&&isset($CustomerId)){
        // $sql = sprintf("SELECT %s FROM %s WHERE %s(SELECT %s FROM %s);","OrderId","orders","CreatedTS=","max('CreatedTS')","orders");
        $Type = $_SESSION["OrderForm"];
        $OrderNote = $_SESSION["OrderNote"];
        $sql = sprintf("INSERT INTO %s VALUES (%s)","order(`CustomerId`,`Type`,`Note`)","'$CustomerId','$Type','$OrderNote'");
        
        foreach($_SESSION["shoppingcart"] as $key=>$value){
            
        }

    }

?>