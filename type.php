<!DOCTYPE html>
<html lang="en">

    <head>
        <?php
        session_start();
        if (!isset($_SESSION["user_name"])) {
            $dangxuat = 'none';
            $dangnhap = 'block';
        } else {
            $dangxuat = 'block';
            $dangnhap = 'none';
        }
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="Description" content="Enter your description here" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="./assets/css/index.css">
        <title><?php echo $_GET['type'] ?></title>
        <link rel="stylesheet" href="./assets/css/home.css">
        <script language="javascript" src="assets/js/admin.js"></script>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row header">
                <div class="col-md-1"></div>
                <div class="row col-md-11">
                    <img src="./img/logo_steam.svg" alt="" class="col-md-3 logo">
                    <div class="col-md-9 nav">
                        <a href="./index.php" class="nav_conent">
                            <p>Home</p>
                        </a>
                        <nav class="navbar navbar-expand-lg navbar nav_sl">
                            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink"
                                           role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                           style="color: white;font-size: 20px">
                                            Type
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-dark"
                                            aria-labelledby="navbarDarkDropdownMenuLink">
                                                <?php
                                                require_once './product.php';
                                                require_once './Connett.php';
                                                $call = new product("", "", "", "", "", "", "", "", "", "");
                                                $result = $call->showalltype($conn);
                                                while ($roww = $result->fetch_assoc()) {
                                                    ?>
                                                <li><a class="dropdown-item"
                                                       href="type.php?type=<?php echo (str_replace(" ", "", $roww['Name'])) ?>"><?php echo $roww['Name'] ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                         <?php
                    if (!function_exists('currency_format')) {

                        function currency_format($number, $suffix = '') {
                            if (!empty($number)) {
                                return number_format($number, 0, ',', '.') . "{$suffix}";
                            }
                        }

                    }
                    ?>
                        <a href="about.php" class="nav_conent">
                            <p>About</p>
                        </a>

                        <img src="https://templates.scriptsbundle.com/opportunities-v3/rtl-demo/images/admin.jpg" alt=""
                             height="80px" width="80px"
                             style="display: none; margin-right:1%;margin-left:1%;display:<?php echo $dangxuat ?>">
                        <a href="./login.php" class="nav_conent" style="display:<?php echo $dangxuat ?>">
                            <?php echo $_SESSION["user_name"] ?>
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
                        <a href="./login.php" class="nav_conent" style="display:<?php echo $dangnhap ?>">
                            <p>Login</p>
                        </a>
                        <a href="./regiter.php" class="nav_conent" style="display:<?php echo $dangnhap ?>">
                            <p>Register</p>
                        </a>
                        <form action="" method="post" style="float:right;margin-top:2%">
                            <input type="submit" class="btn btn-primary " name="timkiem" value="search">
                            <input type="search" name="seach" id="" class="seach" placeholder="search">
                        </form>
                    </div>

                </div>

            </div>
            <?php
            if (isset($_POST['timkiem'])) {
                require_once './product.php';
                require_once './Connett.php';
                $call = new product("", "", "", "", "", "", "", "", "", "");
                $i = 1;
                $seach = $_POST['seach'];
                $result = $call->showallseachname($conn, $seach);
                $s = 'block';
            } else {
                require_once './product.php';
                require_once './Connett.php';
                $call = new product("", "", "", "", "", "", "", "", "", "");
                $i = 1;
                $result = $call->showall($conn);
                $s = 'none';
            }
            ?>
            <div class="content row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        if (($row['status'] == "true") && (str_replace(" ", "", $row['type']) == $_GET['type'])) {
                            ?>
                            <div class="product">
                                <a href="./sanpham.php?detal=<?php echo $row['gameID'] ?>">
                                    <div style="height: 80%; width: 100%;">
                                        <?php
                                        $rs = $call->showimg($conn, $row['gameID']);
                                        $roww = $rs->fetch_assoc();
                                        ?>
                                        <td><img src="<?php echo $roww['imgURL']; ?>" alt="" height="100%" width="100%"> </td>
                                    </div>

                                </a>
                                <div style="height: 20%; width: 100%;background-image: linear-gradient(black, blue);">
                                    <h3><?php echo $row['name']; ?></h3>
                                    <h4 style="font-size: 15px;"><?php echo number_format($row['price'])." Đồng"; ?></h4>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="col-md-1"></div>
            </div>

        </div>
        <footer class=" text-center text-white" style="background-color: #171A21;">
            <!-- Grid container -->
            <div class="container p-4 pb-0">
                <!-- Section: Social media -->
                <section class="mb-4">
                    <!-- Facebook -->
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998;" href="#!"
                       role="button"><i class="fab fa-facebook-f"></i></a>

                    <!-- Twitter -->
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee;" href="#!"
                       role="button"><i class="fab fa-twitter"></i></a>

                    <!-- Google -->
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39;" href="#!"
                       role="button"><i class="fab fa-google"></i></a>

                    <!-- Instagram -->
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac;" href="#!"
                       role="button"><i class="fab fa-instagram"></i></a>
                    <!-- Linkedin -->
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca;" href="#!"
                       role="button"><i class="fab fa-linkedin-in"></i></a>
                    <!-- Github -->
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #333333;" href="#!"
                       role="button"><i class="fab fa-github"></i></a>
                </section>
            </div>
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2020 Copyright:
                <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
            </div>
            <!-- Copyright -->
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
    </body>

</html>