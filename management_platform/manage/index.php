<?php
    include_once("./utilities.php");
    include_once("../page_utilities.php");
    
?>

<!DOCTYPE html>
<html lang="Zh-Hant">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="MingFeng,Li" />
        <title>首頁</title>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/sunny/jquery-ui.css">
        <link rel="stylesheet" href="../../Multiple-Dates-Picker-for-jQuery-UI-latest/jquery-ui.multidatespicker.css">
        <link href="../../css/styles.css" rel="stylesheet" />

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
        <script src="../../Multiple-Dates-Picker-for-jQuery-UI-latest/jquery-ui.multidatespicker.js"></script>
    </head>
    <body>
        <!-- Navigation-->
        <?php
            show_nav();
            getClosedDates($conn);
        ?>
        <!-- Header-->
        <header class="bg-pink py-1">
            <div class="container px-1 px-lg-1 my-1">
                <div class="text-center text-white">
                    <h4 class="display-6 fw-bolder">開始生產</h4>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="container-sm border border-2 rounded-3 py-5 my-5">
            <form class="row gx-4" method="post" action="./selectdates.php">
                <div class="col-6">
                    <span class="">預計自取日期訂單<sub>隔日</sub></span>
                    <input type="text" name="TakeDate" class="form-control" id="TakeDate">
                </div>
                <div class="col-4">
                    <span class="">預計宅配收貨日期<sub>後天或下周二</sub></span>
                    <input type="text" name="DiliveredDate" class="form-control" id="DiliveredDate">
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary mx-1 searchbtn">查詢訂單</button>
                </div>
            </form>
        </section>
        <span id="OrderSections"></span>
        <!-- Footer-->
        <footer class="py-5 bg-pink">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; 可露露甜品工作坊 2023</p></div>
        </footer>
        <script>
            $(document).ready(function () {
                var Cdates = $("#closedDates").text();
                var CdatesArr = Cdates.split(";");
                var DatesArr = [];
                for(let i = 0; i < CdatesArr.length; i++){
                    let date = new Date(CdatesArr[i]);
                    DatesArr.push(date);
                }
                var today = new Date();
                $("#TakeDate").multiDatesPicker({
                    maxPicks:1,
                    dateFormat: "yy-mm-dd",
                    addDisabledDates:DatesArr,
                });
                $("#DiliveredDate").multiDatesPicker({
                    maxPicks:1,
                    dateFormat: "yy-mm-dd",
                    addDisabledDates:DatesArr,
                });
                // $(".searchbtn").click(function(){
                //     jQuery.ajax({
                //     type: "POST",
                //     url: 'your_functions_address.php',
                //     dataType: 'json',
                //     data: {TakeDate: $("#TakeDate").val(), DiliveredDate: $("#DiliveredDate").val()},
                //     success: function (obj, textstatus) {
                //                 if( !('error' in obj) ) {
                //                     yourVariable = obj.result;
                //                 }
                //                 else {
                //                     console.log(obj.error);
                //                 }
                //     }
                //     });
                // });
            });
        </script>
    </body>
</html>
