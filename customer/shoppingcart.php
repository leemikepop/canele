<?php
    include_once("./utilities.php");
    getClosedDates($conn);
?>

<!DOCTYPE html>
<html lang="Zh-Hant">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="MingFeng,Li" />
        <title>首頁</title>
        <!-- Favicon-->
        <!-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> -->
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/sunny/jquery-ui.css">
        <link rel="stylesheet" href="../Multiple-Dates-Picker-for-jQuery-UI-latest/jquery-ui.multidatespicker.css">
        <!-- <link href="bootstrap-3.0.0/dist/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>

        <script
        src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
        integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0="
        crossorigin="anonymous"></script>
        <script src="../Multiple-Dates-Picker-for-jQuery-UI-latest/jquery-ui.multidatespicker.js"></script>
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">CANELE'</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="./index.php">首頁</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">關於我們</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">商品</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">所有商品</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">熱門商品</a></li>
                                <li><a class="dropdown-item" href="#!">全新商品</a></li>
                            </ul>
                        </li>
                    </ul>
                    <?php
                        login_logout_button();
                    ?>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-pink py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">可露露甜品工作坊</h1>
                    <p class="lead fw-normal text-white-50 mb-0">可麗露專賣</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="justify-content-center"><!--row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4-->
                    <form class="row gx-4" method="post" action="" onSubmit="return validateNewMealForm();">
                        <div class="col-12">
                            <label for="Title" class="col-form-label"><h4 class="fw-bold">購物車<h4></label>
                        </div>
                        <?php showcart($conn); ?>
                        <div class="col-12 py-3"></div>
                        <div class="col-4">
                            <label for="Recipient" class="form-label">收件人</label>
                            <input name="Recipient" type="text" class="form-control" id="Recipient" pattern="[1-9][0-9]{2}">
                        </div>
                        <div class="col-4">
                            <label for="Phone" class="form-label">連絡電話</label>
                            <input name="Phone" type="text" class="form-control" id="Phone">
                        </div>
                        <div class="col-4">
                            <label for="OrderForm" class="form-label">自取/宅配</label>
                            <select name="OrderForm" class="form-select" id="OrderForm">
                                <option value="A" selected>自取</option>
                                <option value="B">宅配</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="Date" class="form-label">自取/宅配收貨日期</label>
                            <input name="Date" type="text" class="form-control" id="Date" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))">
                        </div>
                        <div class="col-4">
                        <label for="ShippingTime" class="form-label">宅配時段</label>
                            <select name="ShippingTime" class="form-select" id="ShippingTime">
                                <option value="4" selected>不指定</option>
                                <option value="1">13時前</option>
                                <option value="2">14-18時</option>
                            </select>
                        </div>
                        <div class="col-4">
                            
                        </div>
                        <div class="col-2">
                            <label for="ZipCode" class="form-label">郵遞區號</label>
                            <input name="ZipCode" type="text" class="form-control" id="ZipCode" pattern="[1-9][0-9]{2}">
                        </div>
                        <div class="col-10">
                            <label for="Address" class="form-label">地址</label>
                            <input name="Address" type="text" class="form-control" id="Address">
                        </div>
                        <div class="col-12 py-5">
                            <button type="submit" class="btn btn-primary">送出訂單</button>
                            <button type="reset" class="btn btn-secondary">清除</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-pink">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; 可露露甜品工作坊 2023</p></div>
        </footer>
        
        <!-- Core theme JS-->
        <script>
            $(document).ready(function () {
                $(".plusbtn").click(function(e){
                    let numid = $(this).data('key');
                    $(numid).val(parseInt($(numid).val())+1);
                });
                $(".minusbtn").click(function(e){
                    let numid = $(this).data('key');
                    let num = parseInt($(numid).val());
                    if(num>0){
                        $(numid).val(num-1);
                    }                    
                });
                var Cdates = $("#closedDates").text();
                var CdatesArr = Cdates.split(";");
                var DatesArr = [];
                for(let i = 0; i < CdatesArr.length; i++){
                    let date = new Date(CdatesArr[i]);
                    DatesArr.push(date);
                }
                $("#Date").multiDatesPicker({
                    maxPicks:1,
                    dateFormat: "yy-mm-dd",
                    minDate: 2,
                    maxDate: 30,
                    addDisabledDates:DatesArr,
                });
                // $('#Date').multiDatesPicker('addDisabledDates', CdatesArr);
            });
        </script>
        
    </body>
</html>
