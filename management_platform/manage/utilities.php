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

    function showOrders($conn,$TakeDate,$DiliveredDate){
        $sql = sprintf("SELECT %s FROM %s WHERE %s;","*","shipmentinfo","Date='$TakeDate'");
        $result = mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $OrderId = $row['OrderId'];
            $sql = sprintf("SELECT %s FROM %s WHERE %s;","*","orders","OrderId='$OrderId' AND Type='A'");
            $Result = mysqli_query($conn,$sql);
            while($r=mysqli_fetch_assoc($Result)){
                $CustomerId = $r['CustomerId'];
                $OrderNote = $r['Note'];
                $OrderStatus = $r['OrderStatus'];
                $PayStatus = $r['PayStatus'];
                $CreatedTS = $r['CreatedTS'];
                $AcceptedTS = $r['AcceptedTS'];
                $DeliverdTS = $r['DeliverdTS'];
                $CompletedTS =$r['CompletedTS'];
                echo '<form class="row g-3 editform" name="'.$OrderId.'" method="post" enctype="multipart/form-data">';
                echo '<input type="hidden" name="OrderId" value="'.$OrderId.'">';
                echo '<table class="table text-center mb-5">';  
                    echo '<thead>';
                        echo '<tr>';
                            echo '<th scope="col">訂單編號</th>';
                            echo '<th scope="col">顧客編號</th>';
                            echo '<th scope="col">訂單狀態</th>';
                            echo '<th scope="col">付款狀態</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                        echo '<tr>';
                            echo '<td>'.$OrderId.'</td>';
                            echo '<td>'.$CustomerId.'</td>';
                            echo '<td style="color: red;>'.$OrderStatus.'</td>';
                            echo '<td>'.$OrderStatus.'</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<th scope="row">說明</th>';
                            echo '<td colspan="3" class="text-start"><span id="note'.$MealId.'">'.$row["Note"].'</span></td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<th scope="col">開始販售日期</th>';
                            echo '<th scope="col">結束販售日期</th>';
                            echo '<th scope="col">新增時戳</th>';
                            echo '<th scope="col">更新時戳</th>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td><span id="sdate'.$MealId.'">'.$row["StartDate"].'</span></td>';
                            echo '<td><span id="edate'.$MealId.'">'.$row["ExpiryDate"].'</span></td>';
                            echo '<td>'.$row["CreatedTS"].'</td>';
                            echo '<td>'.$row["UpdatedTS"].'</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td><button type="button" class="btn btn-primary mx-1 modifybtn" data-formclass="'.$MealId.'">修改</button><button type="submit" class="btn btn-primary mx-1 '.$MealId.'" formaction="./update_meal.php" hidden>確定</button><button type="submit" class="btn btn-danger mx-1" formaction="./delete_meal.php" onsubmit>刪除</button></td>';
                        //<button type="button" class="btn btn-primary mx-1 '.$MealId.'" hidden>取消</button>
                        echo '</tr>';
                    echo '</tbody>';
                echo '</table>';
                echo '</form>';
            }
            
        }
    }
?>