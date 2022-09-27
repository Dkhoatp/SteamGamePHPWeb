<!DOCTYPE html>
<html lang="en">

    <head>
        <?php
        session_start();
        if (!isset($_SESSION["user_name"])) {
            unset($_SESSION["user_name"]);
            echo "<script>alert('please log in');</script>";
            echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
        }
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="Description" content="Enter your description here" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="./assets/css/index.css">
        <link rel="stylesheet" href="ajax-pagination/css/style.css">
        <title>Manage Customer</title>
        <script language="javascript" src="assets/js/admin.js"></script>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row header">
                <div class="col-md-1"></div>
                <div class="row col-md-10">
                    <img src="./img/logo_steam.svg" alt="" class="col-md-3 logo">
                    <div class="col-md-9 nav">
                        <a href="./manage_customer.php" class="nav_conent">
                            <p>Manager Customer</p>
                        </a>
                        <a href="./manage_product.php" class="nav_conent">
                            <p>Manager Product</p>
                        </a>
                        <a href="./manage_Type.php" class="nav_conent">
                            <p>Manager Type</p>
                        </a>
                        <a href="manage_order.php" class="nav_conent">
                            <p>order</p>
                        </a>
                        <img src="https://templates.scriptsbundle.com/opportunities-v3/rtl-demo/images/admin.jpg" alt=""
                             height="80px" width="80px" style="margin-right: 2%;">
                        <a href="#" class="nav_conent">
                            <p>ADMIN</p>
                        </a>
                        <a href="index.php?user=dangxuat" class="nav_conent" style="display:<?php echo $dangxuat ?>">
                            <p>Logout</p>
                        </a>
                        <?php
                        if (!empty($_GET['user'])) {
                            if ($_REQUEST["user"]and $_REQUEST['user'] != "") {
                                unset($_SESSION["user_name"]);
                                echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            <div class="content row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="form-group">
                        <h1 class="fas fa-h1" style="color: white; padding-top: 20px">Manage Order</h1>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <?php
                            $color = array("table-danger", "table-primary", "table-secondary", "table-success", "table-warning", "table-info", "table-light", "table-danger");
                            require_once './product.php';
                            require_once './Connett.php';
                            $call = new product("", "", "", "", "", "", "", "", "", "");
                            $i = 1;
                            $result = $call->showallbuy($conn);
                            ?>
                        </thead>
                        <tbody>
                        <div id="main">
                            <div id="header">
                                <h3 style="color: white; padding-top: 20px; margin-bottom: 30px">List of Customer Details</h3>
                            </div>

                            <div id="table-data">
                            </div>
                        </div>
                        <script type="text/javascript" src="ajax-pagination/js/jquery.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                function loadTable(page) {
                                    $.ajax({
                                        url: "ajax-pagination/ajax-pagination.php",
                                        type: "POST",
                                        data: {page_no: page},
                                        success: function (data) {
                                            $("#table-data").html(data);
                                        }
                                    });
                                }
                                loadTable();

                                //Pagination Code
                                $(document).on("click", "#pagination a", function (e) {
                                    e.preventDefault();
                                    var page_id = $(this).attr("id");

                                    loadTable(page_id);
                                })
                            });
                        </script>
                        </tbody>
                    </table>
                     
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>

</html>