<?php
    session_start();
    $conn = require_once("./auth/config.php");
    if(!isset($_SESSION["loggedin"])){
        header("location:./auth/index.php");
    }
    // $_SESSION["loggedin"] = true;
    // $_SESSION["CustomerId"] = $result["CustomerId"];
    // $_SESSION["CustomerName"] = $result["CustomerName"];
    // $_SESSION["Email"] = $result["Email"];
    // $_SESSION["Phone"] = $result["Phone"];

    function getClosedDates($conn){
        $currentDate = date("Y-m-d", strtotime('+2 day'));
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
    
    function getCartNum(){
        $num = 0;
        if(isset($_SESSION["shoppingcart"])){
            foreach($_SESSION["shoppingcart"] as $n){
                $num += $n;
            }
        }
        echo '<span class="badge bg-pink text-white ms-1 rounded-pill">'.$num.'</span>';
    }

    function login_logout_button(){
        if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']){
            echo "<button class='btn btn-outline-dark' onclick='location.href=".'"./auth/logout.php"'."';>";
            echo "&emsp;<i class='bi-box-arrow-right'></i>";
            echo "&emsp;Logout";
            echo "</button>";
        }else{
            echo "<button class='btn btn-outline-dark' onclick='location.href=".'"./auth/index.php"'."';>";
            echo "&emsp;<i class='bi-key-fill me-1'></i>";
            echo "&emsp;Login";
            echo "</button>";
        }
    }
    function showmenu($conn){
        $day = date("Y-m-d",strtotime("+2 day"));
        $sql = sprintf("SELECT %s FROM %s WHERE %s;","*","`menu`","StartDate<='$day' AND ExpiryDate>='$day'");
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            echo '<div class="col mb-5">';
                echo '<div class="card h-100">';
                    echo '<!-- Product image-->';
                    echo '<img class="card-img-top" src="../management_platform/menu/'.$row['ImgDir'].'" alt="..." />';
                    echo '<!-- Product details-->';
                    echo '<div class="card-body p-4">';
                        echo '<div class="text-center">';
                            echo '<!-- Product name-->';
                            echo '<h5 class="fw-bolder">'.$row['Name'].'</h5>';
                            echo '<!-- Product reviews-->';
                            echo '<div class="d-flex justify-content-center small text-warning mb-2">';
                                echo '<div class="bi-star-fill"></div>';
                                echo '<div class="bi-star-fill"></div>';
                                echo '<div class="bi-star-fill"></div>';
                                echo '<div class="bi-star-fill"></div>';
                                echo '<div class="bi-star-fill"></div>';
                            echo '</div>';
                            echo '<!-- Product price-->';
                            echo 'NT$'.$row['Price'];
                            echo '<br><sub class="fst-italic">'.$row['Note'].'</sub>';
                            echo '<p class="fst-italic pt-4">~'.$row['ExpiryDate'].'</p>';
                        echo '</div>';
                    echo '</div>';
                    echo '<!-- Product actions-->';
                    echo '<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">';
                        echo '<form method="get" action="./addtocart.php">';
                            echo '<input type="hidden" name="MealId" value="'.$row['MealId'].'">';
                            echo '<div class="text-center"><button type="submit" class="btn btn-outline-dark mt-auto">加入購物車</button></div>';
                        echo '</form>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
    }

    function showcart($conn){
        if(isset($_SESSION["shoppingcart"])){
            foreach($_SESSION["shoppingcart"] as $key=>$value){
                $sql = sprintf("SELECT %s FROM %s WHERE %s;","`Name`,`Price`,`Note`","`menu`","MealId='$key'");
                $result = mysqli_query($conn,$sql);
                $result = mysqli_fetch_assoc($result);
                echo '<div class="col-3">';
                    echo '<label for="MealName" class="col-form-label">餐點名稱</label>';
                    echo '<input type="hidden" name="MealId" value="'.$key.'">';
                    echo '<input type="text" name="MealName" class="form-control" id="MealNameid'.$key.'" value="'.$result["Name"].'" readonly>';
                echo '</div>';
                echo '<div class="col-3">';
                    echo '<label for="Note" class="col-form-label">說明</label>';
                    echo '<input type="text" name="Note" class="form-control" value="'.$result["Note"].'" readonly>';
                echo '</div>';
                echo '<div class="col-3">';
                    echo '<label for="Price" class="col-form-label">單價</label>';
                    echo '<input type="text" name="Price" class="form-control" id="Priceid'.$key.'" value="'.$result["Price"].'" readonly>';
                echo '</div>';
                echo '<div class="col-3">';
                    echo '<label for="Num" class="col-form-label">數量</label>';
                    echo '<div class="input-group">';
                        echo '<button type="button" class="btn btn-secondary mx-1 minusbtn" data-key="#Numid'.$key.'">－</button>';                    
                        echo '<input type="text" name="Num" class="form-control" id="Numid'.$key.'" pattern="[1-9][0-9]*|[0]" value="'.$value.'">';
                        echo '<button type="button" class="btn btn-secondary mx-1 plusbtn" data-key="#Numid'.$key.'">＋</button>';
                    echo '</div>';
                echo '</div>';
            }
        }
        
    }
?>