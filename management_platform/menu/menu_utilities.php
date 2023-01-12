<?php
    session_start();
    $conn = require_once("../auth/config.php");

    function showMenu($conn){
        $sql = sprintf("SELECT %s FROM %s;","*","menu");
        $result = mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $MealId = $row["MealId"];
            echo '<form class="row g-3 editform" name="'.$row["MealId"].'" method="post" enctype="multipart/form-data">';
            echo '<input type="hidden" name="MealId" value="'.$row["MealId"].'">';
            echo '<table class="table text-center mb-5">';
                echo '<thead>';
                    echo '<tr>';
                        echo '<th scope="col">餐點編號</th>';
                        echo '<th scope="col">名稱</th>';
                        echo '<th scope="col">售價</th>';
                    echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                    echo '<tr>';
                        echo '<td>'.$row["MealId"].'</td>';
                        echo '<td><span id="name'.$MealId.'">'.$row["Name"].'</span></td>';
                        echo '<td><span id="price'.$MealId.'">'.$row["Price"].'</span></td>';
                        echo '<td rowspan="2"><span id="img'.$MealId.'"><img src="'.$row['ImgDir'].'" class="rounded img-thumbnail" alt="'.$row['ImgName'].'" width="200px"></span></td>';
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
    function getClosedDates($conn){
        $currentDate = date("Y-m-d", strtotime('-60 day'));
        $sql = sprintf("SELECT %s FROM %s WHERE %s;","Date","closeddate","Date>='$currentDate' AND Closed='1'");
        $result = mysqli_query($conn,$sql);
        $Cdates = "";
        while($row = mysqli_fetch_assoc($result)){
            if(empty($Cdates)){
                $Cdates = $Cdates.$row['Date'];
            }else{
                $Cdates = $Cdates.";".$row['Date'];
            }
        }
        echo '<div id="closedDates" hidden>'.$Cdates.'</div>';
    }
?>