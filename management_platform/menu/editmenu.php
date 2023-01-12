<?php
    include_once("./menu_utilities.php");
    include_once("../page_utilities.php");
?>

<!DOCTYPE html>
<html lang="Zh-Hant">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="MingFeng,Li" />
        <title>修改餐點</title>
        
        <!-- DatePicker -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css"> -->
        
        <!-- Favicon-->
        <!-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> -->
        
        <!-- Bootstrap icons-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"/>        
        <!-- <link href="bootstrap-3.0.0/dist/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../css/styles.css" rel="stylesheet" />
        <!-- Core theme JS-->
        <!-- <script src="../../js/scripts.js"></script>         -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
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
                    <h4 class="display-6 fw-bolder">修改餐點</h4>
                </div>
            </div>
        </header>
        <!-- Section add meal-->
        <section class="container-sm border border-2 rounded-3 py-5 my-5">
            <form class="row g-3" name="NewMeal" method="post" action="add_meal.php" onSubmit="return validateNewMealForm();" enctype="multipart/form-data">
            <div class="col-12">
                <label for="Title" class="col-form-label"><h4 class="fw-bold">新增餐點<h4></label>
            </div>
            <div class="col-12">
                <label for="inputMealName" class="col-form-label">餐點名稱</label>
                <input type="text" name="MealName" class="form-control" id="inputMealName" placeholder="原味可麗露">
            </div>
            <div class="col-12">
                <label for="inputPrice" class="col-form-label">售價</label>
                <input type="text" name="Price" pattern="[1-9][0-9]*" class="form-control" id="inputPrice" placeholder="65">
            </div>
            <div class="col-12">
                <label for="inputNote" class="col-form-label">說明</label>
                <input type="text" name="Note" class="form-control" id="inputNote" placeholder="本產品含有可可脂">
            </div>
            <div class="col-md-6">
                <label for="inputStartDate" class="form-label">開始販售日期</label>
                <input type="text" name="StartDate" class="form-control datepicker inputStartDate" data-provide="datepicker-inline" id="" data-date-format="yyyy-mm-dd">
            </div>
            <div class="col-md-6">
                <label for="inputExpiryDate" class="form-label">結束販售日期</label>
                <input type="text" name="ExpiryDate" class="form-control datepicker inputExpiryDate" data-provide="datepicker-inline" id="" data-date-format="yyyy-mm-dd">
            </div>
            <div class="mb-3">
                <label for="inputFormFile" class="form-label">上傳圖片</label>
                <input class="form-control" name="ImgFile" type="file" accept="image/*" id="inputFormFile">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">新增</button>
                <button type="reset" class="btn btn-secondary">清除</button>
            </div>
            </form>
        </section>
        <!-- Section show Meal-->
        <section class="container-sm border border-2 rounded-3 py-5 my-5">
            <?php
                showMenu($conn);
            ?>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-pink">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; 可露露甜品工作坊 2023</p></div>
        </footer>
        <script> 
            $(document).ready(function () {
                /*New Meal datepicker*/
                $(function() {
                    $( ".inputStartDate" ).change( function() {
                        $('.inputExpiryDate').datepicker("setStartDate",  $(".inputStartDate").val());
                    });
                    $( ".inputExpiryDate" ).change( function() {
                        $('.inputStartDate').datepicker("setEndDate",  $(".inputExpiryDate").val());
                    });
                });
                /*Modify Button*/
                $(".modifybtn").click(function(e){                
                    var classid = $(this).data('formclass');
                    $(this).hide();
                    $("."+classid).removeAttr("hidden");
                    var hasClicked = false;
                    var imginputid = '#img'.concat(classid);
                    $(imginputid).click(function(){
                        if(!hasClicked){
                            $(imginputid).html('<input name="ImgFile" type="file" accept="image/*" id="inputFormFile">');
                        }
                        hasClicked = true;
                    });
                    var nameinputid = '#name'.concat(classid);
                    var priceinputid = '#price'.concat(classid);
                    var noteinputid = '#note'.concat(classid);
                    var sdateinputid = '#sdate'.concat(classid);
                    var edateinputid = '#edate'.concat(classid);
                    $(nameinputid).html('<input name="MealName" type="text" value='+$(nameinputid).text()+'>');
                    $(priceinputid).html('<input name="Price" type="text" pattern="[1-9][0-9]*" value='+$(priceinputid).text()+'>');
                    $(noteinputid).html('<input class="col-8 py-3" name="Note" type="text" value='+$(noteinputid).text()+'>');
                    $(sdateinputid).html('<input name="StartDate" type="text" value='+$(sdateinputid).text()+' id="start'+classid+'" data-provide="datepicker-inline" data-date-format="yyyy-mm-dd">');
                    $(edateinputid).html('<input name="ExpiryDate" type="text" value='+$(edateinputid).text()+' id="expiry'+classid+'" data-provide="datepicker-inline" data-date-format="yyyy-mm-dd">');
                    var startdateid = '#start'.concat(classid);
                    var expirydateid = '#expiry'.concat(classid);
                    $(function() {
                        $(expirydateid).datepicker({});
                        $(startdateid).datepicker({});
                        $(startdateid).change( function() {
                            $(expirydateid).datepicker("setStartDate",  $(startdateid).val());
                        });
                        $(expirydateid).change( function() {
                            $(startdateid).datepicker("setEndDate",  $(expirydateid).val());
                        });
                    });
                });
                /*Before submit deletion */
                $(".btn-danger").click(function(){
                    if(confirm("確認要刪除這項餐點嗎？刪除後無法復原！")==true){
                        return true;
                    }else{
                        return false;
                    }
                });
            });

        </script>
        
        
        
    </body>
</html>
