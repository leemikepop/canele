<?php
    include_once("./menu_utilities.php");
    include_once("../page_utilities.php");
    getClosedDates($conn);
?>

<!DOCTYPE html>
<html lang="Zh-Hant">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="MingFeng,Li" />
        <title>休息日期</title>
        
        <!-- DatePicker -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"> -->
        <!-- <link rel="stylesheet" href="../../css/bootstrap-datepicker.css"> -->
        
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/sunny/jquery-ui.css">
        <link rel="stylesheet" href="../../Multiple-Dates-Picker-for-jQuery-UI-latest/jquery-ui.multidatespicker.css">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css"> -->
        
        <!-- Favicon-->
        <!-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> -->
        
        <!-- Bootstrap icons-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"/>
        <!-- <link href="bootstrap-3.0.0/dist/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../css/styles.css" rel="stylesheet" />
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <!-- <script src="../../js/scripts.js"></script>         -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
        <script
        src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
        integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0="
        crossorigin="anonymous"></script>
        <script src="../../Multiple-Dates-Picker-for-jQuery-UI-latest/jquery-ui.multidatespicker.js"></script>
        
        
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> -->
        <!-- <script src="../../js/bootstrap-datepicker.js"></script> -->
        <!-- <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script> -->
        <!-- <script src="https://cdn.bootcss.com/moment.js/2.18.1/moment-with-locales.min.js"></script> -->
        <script>
        function validateNewMealForm(){
            if(document.forms["NewMeal"]["MealName"].value.length==0){
                return false;
            }
            if(document.forms["NewMeal"]["Price"].value.length==0){
                return false;
            }
        }

        </script>
        
    </head>
    <body>
        <!-- Navigation-->
        <?php
            show_nav();
        ?>
        <!-- Header-->
        <header class="bg-pink py-1">
            <div class="container px-1 px-lg-1 my-1">
                <div class="text-center text-white">
                    <h4 class="display-6 fw-bolder">修改營業/休息日期</h4>
                </div>
            </div>
        </header>
        <!-- Section Calander-->
        <section class="container-sm border border-2 rounded-3 py-5 my-5">
            <form class="row g-3" method="post" action="./edit_dates.php">
                <label for="Title" class="col-form-label"><h4 class="fw-bold">選擇休息日期<h4></label>
                <div name="CloseDates" class="form-control align-middle datepicker" >
                    <input type="text" class="col-12" name="SelectedDates" data-provide="datepicker" id="myDatepicker" data-date-format="yyyy-mm-dd">
                </div>
                <button type="submit" class="btn btn-primary mx-1 modifybtn">修改</button>
            </form>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-pink">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; 可露露甜品工作坊 2023</p></div>
        </footer>
        <script> 
        $(document).ready(function () {
            var Cdates = $("#closedDates").text();
            var CdatesArr = Cdates.split(";");
            $('.datepicker').multiDatesPicker({
                dateFormat: "yy-mm-dd",
                minDate: -60,
                separator:";",
                altField: '#myDatepicker',
            });
            $('.datepicker').multiDatesPicker('addDates', CdatesArr);
        });
        </script>
        
        
        
    </body>
</html>
