<?php
    function logout_button(){
        echo "<button class='btn btn-outline-dark' onclick='location.href=".'"../auth/logout.php"'."';>";
        echo "&emsp;<i class='bi-box-arrow-right'></i>";
        echo "&emsp;Logout";
        echo "</button>"; 
    }
    function show_nav(){
        echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
        echo '<div class="container px-4 px-lg-5">';
            echo '<a class="navbar-brand" href="#!">CANELE生產管理平台</a>';
            echo '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>';
            echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
                echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">';

                    echo '<li class="nav-item dropdown">';
                        echo '<!-- <a class="nav-link active" aria-current="page" href="./index.php">生產管理</a> -->';
                        echo '<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">生產管理</a>';
                        echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                        echo '<li><a class="dropdown-item" href="../manage/index.php">開始生產</a></li>';      
                        echo '<!-- <li><hr class="dropdown-divider" /></li> -->';
                        echo '<li><a class="dropdown-item" href="./produce.php">加工製造</a></li>';
                        echo '<li><a class="dropdown-item" href="#!">宅配出貨</a></li>';
                        echo '</ul>';
                    echo '</li>';

                    echo '<li class="nav-item dropdown">';
                        echo '<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">訂單管理</a>';
                        echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                        echo '<li><a class="dropdown-item" href="#!">所有訂單</a></li>';
                        echo '<!-- <li><hr class="dropdown-divider" /></li> -->';
                        echo '<li><a class="dropdown-item" href="#!">自取訂單</a></li>';
                        echo '<li><a class="dropdown-item" href="#!">宅配訂單</a></li>';
                        echo '</ul>';
                    echo '</li>';

                    echo '<li class="nav-item dropdown">';
                        echo '<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">菜單維護</a>';
                        echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                        echo '<li><a class="dropdown-item" id="editmenu" href="../menu/editmenu.php">修改餐點</a></li>';
                        echo '<!-- <li><hr class="dropdown-divider" /></li> -->';
                        echo '<li><a class="dropdown-item" id="editcalander" href="../menu/editcalander.php">休息日期</a></li>';
                        echo '</ul>';
                    echo '</li>';

                    echo '<li class="nav-item dropdown">';
                        echo '<a class="nav-link" href="#!">財務管理</a>';
                    echo '</li>';

                    echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="#!">顧客資料維護</a>';
                    echo '</li>';
                echo '</ul>';
                logout_button();
            echo '</div>';
        echo '</div>';
        echo '</nav>';
}
?>