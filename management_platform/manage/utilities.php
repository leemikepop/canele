<?php
    session_start();
    $conn = require_once("../auth/config.php");
    // $_SESSION["loggedin"] = true;
    // $_SESSION["Ssn"] = $result["Ssn"];
    // $_SESSION["Name"] = $result["Name"];
    // $_SESSION["Position"] = $result["Position"];
    if(!isset($_SESSION['loggedin'])){
        header("location:../auth/index.php");
    }

    function getClosedDates($conn){
        $currentDate = date("Y-m-d", strtotime('-14 day'));
        $sql = sprintf("SELECT %s FROM %s WHERE %s;","Date","closeddate","Date>='$currentDate' AND Closed='1'");
        $result = mysqli_query($conn,$sql);
        $Cdates = "";
        while($row = mysqli_fetch_assoc($result)){
            if(empty($Cdates)){
                $Cdates = $Cdates.'"'.$row['Date'].'"';
            }else{
                $Cdates = $Cdates.';"'.$row['Date'].'"';
            }
        }
        echo '<div id="closedDates" hidden>'.$Cdates.'</div>';
    }

    function showTakeOrders($conn,$TakeDate){
        /*Self take orders*/
        $sql = sprintf("SELECT %s FROM %s WHERE %s;","*","shipmentinfo","Date='$TakeDate'");
        $result = mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $OrderId = $row['OrderId'];
            $Recipient = $row['Recipient'];
            $Phone = $row['Phone'];
            $Date = $row['Date'];
            $sql = sprintf("SELECT %s FROM %s WHERE %s;","*","orders","OrderId='$OrderId' AND Type='A' AND OrderStatus='NEW'");
            $Result = mysqli_query($conn,$sql);
            while($r=mysqli_fetch_assoc($Result)){
                $CustomerId = $r['CustomerId'];
                $getCustomerName = mysqli_query($conn,"SELECT `CustomerName` FROM `customer` WHERE CustomerId='$CustomerId'");
                $CustomerName = mysqli_fetch_assoc($getCustomerName)['CustomerName'];
                $OrderNote = $r['Note'];
                $OrderStatus = $r['OrderStatus'];
                $PayStatus = $r['PayStatus'];
                $CreatedTS = $r['CreatedTS'];
                $AcceptedTS = $r['AcceptedTS'];
                $DeliverdTS = $r['DeliverdTS'];
                $CompletedTS =$r['CompletedTS'];
                echo '<section class="container-sm border border-2 rounded-3 py-5 my-5">';
                echo '<form class="row g-3 editform" name="'.$OrderId.'" method="post">';
                echo '<input type="hidden" name="OrderId" value="'.$OrderId.'">';
                echo '<table class="table text-center mb-5">';  
                    echo '<thead>';
                        echo '<tr>';
                            echo '<th scope="col">訂單編號</th>';
                            echo '<th scope="col">訂單類型</th>';
                            echo '<th scope="col">顧客編號</th>';
                            echo '<th scope="col">訂單狀態</th>';
                            echo '<th scope="col">付款狀態</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                        echo '<tr>';
                            echo '<td>'.$OrderId.'</td>';
                            echo '<td style="color: red">自取</td>';
                            echo '<td>'.$CustomerId.'</td>';
                            echo '<td style="color: red">'.$OrderStatus.'</td>';
                            echo '<td style="color: red">'.$PayStatus.'</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<th scope="col">訂購人</th>';
                            echo '<th scope="col">收件人</th>';
                            echo '<th scope="col">連絡電話</th>';
                            echo '<th scope="col">取貨日期</th>';
                            echo '<th scope="row">訂單備註</th>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td>'.$CustomerName.'</td>';
                            echo '<td>'.$Recipient.'</td>';
                            echo '<td>'.$Phone.'</td>';
                            echo '<td>'.$Date.'</td>';
                            echo '<td>'.$OrderNote.'</td>'; //class="text-start"靠左
                        echo '</tr>';
                        echo '<tr>';
                            echo '<th scope="col">訂單成立</th>';
                            echo '<th scope="col">確認訂單</th>';
                            echo '<th scope="col">出貨時間</th>';
                            echo '<th scope="col">完成日期</th>';                            
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td>'.$CreatedTS.'</td>';
                            echo '<td>'.$AcceptedTS.'</td>';
                            echo '<td>'.$DeliverdTS.'</td>';
                            echo '<td>'.$CompletedTS.'</td>';                            
                        echo '</tr>';
                        echo '<tr>';
                            echo '<th scope="col">餐點品項</th>';
                            echo '<th scope="col">數量</th>';
                        echo '</tr>';
                        // $sql = sprintf("SELECT %s FROM %s WHERE %s;","MealName","menu","MealId=( SELECT `MealId` FROM `ordermenu` WHERE OrderId='$OrderId')");
                        $sql = sprintf("SELECT %s FROM %s WHERE %s;","MealId,NumOfMeal","ordermenu","OrderId='$OrderId'");
                        $getMealIdandNum = mysqli_query($conn,$sql);
                        while($rr = mysqli_fetch_assoc($getMealIdandNum)){
                            $MealId = $rr['MealId'];
                            $NumOfMeal = $rr['NumOfMeal'];
                            $sql = sprintf("SELECT %s FROM %s WHERE %s;","Name","menu","MealId='$MealId'");
                            $getMealName = mysqli_query($conn,$sql);
                            $MealName = mysqli_fetch_assoc($getMealName)['Name'];
                            echo '<tr>';
                            echo '<td>'.$MealName.'</td>';
                            echo '<td>'.$NumOfMeal.'</td>';
                        echo '</tr>';
                        }
                        echo '<tr>';
                        echo '<td><button type="submit" class="btn btn-primary mx-1" formaction="./acceptorder.php">確認訂單</button></td>';
                        echo '<td><button type="submit" class="btn btn-danger mx-1" formaction="./cancelorder.php">取消訂單</button></td>';
                        echo '</tr>';
                    echo '</tbody>';
                echo '</table>';
                echo '</form>';
                echo '</section>';
            }
        }
    }

    function showShipOrders($conn,$DiliveredDate){
        /*Ship orders*/
        $sql = sprintf("SELECT %s FROM %s WHERE %s;","*","shipmentinfo","Date='$DiliveredDate'");
        $result = mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $OrderId = $row['OrderId'];
            $Recipient = $row['Recipient'];
            $Phone = $row['Phone'];
            $Date = $row['Date'];
            $ShipNote = $row['ShipNote'];
            $sql = sprintf("SELECT %s FROM %s WHERE %s;","*","orders","OrderId='$OrderId' AND Type='B' AND OrderStatus='NEW'");
            $Result = mysqli_query($conn,$sql);
            while($r=mysqli_fetch_assoc($Result)){
                $CustomerId = $r['CustomerId'];
                $getCustomerName = mysqli_query($conn,"SELECT `CustomerName` FROM `customer` WHERE CustomerId='$CustomerId'");
                $CustomerName = mysqli_fetch_assoc($getCustomerName)['CustomerName'];
                $OrderNote = $r['Note'];
                $OrderStatus = $r['OrderStatus'];
                $PayStatus = $r['PayStatus'];
                $CreatedTS = $r['CreatedTS'];
                $AcceptedTS = $r['AcceptedTS'];
                $DeliverdTS = $r['DeliverdTS'];
                $CompletedTS =$r['CompletedTS'];
                echo '<section class="container-sm border border-2 rounded-3 py-5 my-5">';
                echo '<form class="row g-3 editform" name="'.$OrderId.'" method="post">';
                echo '<input type="hidden" name="OrderId" value="'.$OrderId.'">';
                echo '<table class="table text-center mb-5">';  
                    echo '<thead>';
                        echo '<tr>';
                            echo '<th scope="col">訂單編號</th>';
                            echo '<th scope="col">訂單類型</th>';
                            echo '<th scope="col">顧客編號</th>';
                            echo '<th scope="col">訂單狀態</th>';
                            echo '<th scope="col">付款狀態</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                        echo '<tr>';
                            echo '<td>'.$OrderId.'</td>';
                            echo '<td style="color: red">宅配</td>';
                            echo '<td>'.$CustomerId.'</td>';
                            echo '<td style="color: red">'.$OrderStatus.'</td>';
                            echo '<td style="color: red">'.$PayStatus.'</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<th scope="col">訂購人</th>';
                            echo '<th scope="col">收件人</th>';
                            echo '<th scope="col">連絡電話</th>';
                            echo '<th scope="col">希望收貨日期</th>';
                            echo '<th scope="row">訂單備註</th>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td>'.$CustomerName.'</td>';
                            echo '<td>'.$Recipient.'</td>';
                            echo '<td>'.$Phone.'</td>';
                            echo '<td>'.$Date.'</td>';
                            echo '<td>'.$OrderNote.'</td>'; //class="text-start"靠左
                        echo '</tr>';
                        echo '<tr>';
                            echo '<th scope="col">訂單成立</th>';
                            echo '<th scope="col">確認訂單</th>';
                            echo '<th scope="col">出貨時間</th>';
                            echo '<th scope="col">完成日期</th>';
                            echo '<th scope="row">宅配備註</th>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td>'.$CreatedTS.'</td>';
                            echo '<td>'.$AcceptedTS.'</td>';
                            echo '<td>'.$DeliverdTS.'</td>';
                            echo '<td>'.$CompletedTS.'</td>';
                            echo '<td>'.$ShipNote.'</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<th scope="col">餐點品項</th>';
                            echo '<th scope="col">數量</th>';
                        echo '</tr>';
                        // $sql = sprintf("SELECT %s FROM %s WHERE %s;","MealName","menu","MealId=( SELECT `MealId` FROM `ordermenu` WHERE OrderId='$OrderId')");
                        $sql = sprintf("SELECT %s FROM %s WHERE %s;","MealId,NumOfMeal","ordermenu","OrderId='$OrderId'");
                        $getMealIdandNum = mysqli_query($conn,$sql);
                        while($rr = mysqli_fetch_assoc($getMealIdandNum)){
                            $MealId = $rr['MealId'];
                            $NumOfMeal = $rr['NumOfMeal'];
                            $sql = sprintf("SELECT %s FROM %s WHERE %s;","Name","menu","MealId='$MealId'");
                            $getMealName = mysqli_query($conn,$sql);
                            $MealName = mysqli_fetch_assoc($getMealName)['Name'];
                            echo '<tr>';
                            echo '<td>'.$MealName.'</td>';
                            echo '<td>'.$NumOfMeal.'</td>';
                        echo '</tr>';
                        }
                        echo '<tr>';
                        echo '<td><button type="submit" class="btn btn-primary mx-1" formaction="./acceptorder.php">確認訂單</button></td>';
                        echo '<td><button type="submit" class="btn btn-danger mx-1" formaction="./cancelorder.php">取消訂單</button></td>';
                        echo '</tr>';
                    echo '</tbody>';
                echo '</table>';
                echo '</form>';
                echo '</section>';
            }
        }
    }
    
    function showFavorsNum($conn){
        $sql = sprintf("SELECT %s FROM %s WHERE %s;","OrderId","orders","OrderStatus='ACCEPT'");
        $result = mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $OrderId = $row['OrderId'];
            $sql = sprintf("SELECT %s FROM %s WHERE %s;","MealId,NumOfMeal","ordermenu","OrderId='$OrderId'");
            $getMealIdandNum = mysqli_query($conn,$sql);
            while($rr = mysqli_fetch_assoc($getMealIdandNum)){
                $MealId = $rr['MealId'];
                $NumOfMeal = $rr['NumOfMeal'];
                if(isset($_SESSION[$MealId])){
                    $_SESSION[$MealId] = (int)$_SESSION[$MealId] + (int)$NumOfMeal;
                }else{
                    $_SESSION[$MealId] = (int)$NumOfMeal;
                }   
            }
        }
        $sql = sprintf("SELECT %s FROM %s;","MealId,Name","menu");
        $getMeal = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($getMeal)){
            $MealId = $row['MealId'];
            $MealName = $row['Name'];
            if(isset($_SESSION[$MealId])){
                
            }
        }
        
    }

?>