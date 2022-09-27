<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    if (!isset($_SESSION["user_name"]) ) {
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
    <link rel="stylesheet" href="./assets/css/creteform.css">
    <script src=""></script>
    <title>Update Product</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row header">
            <div class="col-md-1"></div>
            <div class="row col-md-10">
                <img src="./img/logo_steam.svg" alt="" class="col-md-3 logo">
                <div class="col-md-9 nav">
                    <a href="./manage_customer.html" class="nav_conent">
                        <p>Manager Customer</p>
                    </a>
                    <a href="./create_product.html" class="nav_conent">
                        <p>Manager Product</p>
                    </a>
                    <a href="./create_event.html" class="nav_conent">
                        <p>Manager Event</p>
                    </a>
                    <a href="./manage_order.html" class="nav_conent">
                        <p>Manager Type</p>
                    </a>
                    <img src="https://templates.scriptsbundle.com/opportunities-v3/rtl-demo/images/admin.jpg" alt=""
                        height="80px" width="80px" style="margin-right: 2%;">
                    <a href="#" class="nav_conent">
                        <p>ADMIN</p>
                    </a>
                    <a href="index.php?user=dangxuat" class="nav_conent">
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
        <?php
            require_once './customer.php';
            require_once './Connett.php';
            $call = new customer("", "", "", "");
            $results = $call->seach($conn);
            while ($roww = $results->fetch_assoc()) {
                ?>
        <div class="content row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h1 class="fas fa-h1" style="margin: 25% 0% 2% 0%; ">Update curtomer</h1>
                <section>
                    <form action="#" method="post" class="create">
                        <div class="form">
                            <label for="">
                                Username
                            </label>
                            <input type="text" name="us" class="alert-dark form-control" required
                                title="Please enter a username" value="<?php echo $roww['username']; ?>"
                                attern="[A-Za-z0-9]{5,30}">
                        </div>
                        <div class="form">
                            <label for="">
                                Password
                            </label>
                            <input type="text" name="pw" value="<?php echo $roww['password']; ?>"
                                class="alert-dark form-control" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Must contain at least one number and one upper and lowercase letter and at least 8 characters">
                        </div>
                        <div class="form">
                            <label for="">
                                Email
                            </label>
                            <input type="email" name="email" value="<?php echo $roww['email']; ?>"
                                class="alert-dark form-control " readonly="">
                        </div>
                        <input type="submit" value="Create Curtomer" name="submit" class="btn-primary btn btn-rounded">
                    </form>
                </section>
                <?php
                    }
                    ?>

                <?php
                    if (isset($_POST["submit"])) {
                        require_once './Connett.php';
                        require_once './customer.php';
                        $us = $_POST["us"];
                        $pw = $_POST["pw"];
                        $call = new customer("", "", $us, $pw);
                        $call->edit($conn);
                        echo "<script>alert('Update success');</script>";
                        echo "<meta http-equiv=\"refresh\" content=\"0;URL=manage_customer.php\">";
                    }
                    ?>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>

</html>