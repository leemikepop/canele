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
        <title>加工製造</title>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/sunny/jquery-ui.css">
        <!-- <link rel="stylesheet" href="../../Multiple-Dates-Picker-for-jQuery-UI-latest/jquery-ui.multidatespicker.css"> -->
        <link href="../../css/styles.css" rel="stylesheet" />

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
        <!-- <script src="../../Multiple-Dates-Picker-for-jQuery-UI-latest/jquery-ui.multidatespicker.js"></script> -->
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
                    <h4 class="display-6 fw-bolder">加工製造</h4>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="container-sm border border-2 rounded-3 py-5 my-5">
            <table class="table text-center mb-5">
            <thead>
                <tr>
                    <th scope="col">口味名稱</th>
                    <th scope="col">數量</th>
                </tr>
            </thead>
            <?php
                showFavorsNum($conn);
            ?>
            </table>
        </section>
        <span id="OrderSections"></span>
        <!-- Footer-->
        <footer class="py-5 bg-pink">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; 可露露甜品工作坊 2023</p></div>
        </footer>
        <script>
            $(document).ready(function () {

            });
        </script>
    </body>
</html>
