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
        <?php
        require_once './product.php';
        require_once './Connett.php';
        $call = new product("", "", "", "", "", "", "", "", "", "");
        $i = 1;
        $result = $call->showsanpham($conn);
        $s = 'none';
        $r = $result->fetch_assoc();
        ?>

        <title><?php echo $r['name'] ?></title>
        <link rel="stylesheet" href="./assets/css/home.css">
        <script language="javascript" src="assets/js/admin.js"></script>
        <link rel="stylesheet" href="./assets/css/sanpham.css">
    </head>

    <body class="content">
        <div class="container-fluid ">
            <div class="row header">
                <div class="col-md-1"></div>
                <div class="row col-md-11">
                    <img src="./img/logo_steam.svg" alt="" class="col-md-3 logo">
                    <div class="col-md-9 nav">
                        <a href="index.php" class="nav_conent">
                            <p>Home</p>
                        </a>
                        <nav class="navbar navbar-expand-lg navbar nav_sl">
                            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle " href="#" id="navbarDarkDropdownMenuLink"
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
                                                $rs = $call->showalltype($conn);
                                                while ($roww = $rs->fetch_assoc()) {
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
                        <a href="about.php" class="nav_conent">
                            <p>About</p>
                        </a>

                        <img src="https://templates.scriptsbundle.com/opportunities-v3/rtl-demo/images/admin.jpg" alt=""
                             height="80px" width="80px"
                             style="display: none; margin-right:1%;margin-left:1%;display:<?php echo $dangxuat ?>">
                        <a href="#" class="nav_conent" style="display:<?php echo $dangxuat ?>">
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
            <div class="row" >
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="left"  >
                        <?php
                        require_once './product.php';
                        require_once './Connett.php';
                        $calle = new product("", "", "", "", "", "", "", "", "", "");
                        $i = 1;
                        $id = $_GET['detal'];
                        $r = $calle->showimg($conn, $id);
                        $rowone = $r->fetch_assoc();
                        ?>
                        <img style="float: left;margin: 1%" src="<?php echo $rowone['imgURL'] ?>" width="700px" height="600px" id="main-img">
                        <p style="float: left;margin: 0% 1% 1% 1%">
                            <?php
                            $result = $calle->showimg($conn, $id);
                            $row = $result->fetch_assoc();
                            $img = $row['imgURL'];
                            while ($row = $result->fetch_assoc()) {
                                ?>
                            <img src="<?php echo $row['imgURL'] ?>" width="150px" height="100px" />
                            <?php } ?>
                        </p>
                        <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
                        <script>
                            $(() => {
                                $('p img').click(function () {
                                    let imgPath = $(this).attr('src');
                                    $('#main-img').attr('src', imgPath);
                                })
                            })
                        </script>
                    </div>
                    <?php
                    if (!function_exists('currency_format')) {

                        function currency_format($number, $suffix = ' Đồng') {
                            if (!empty($number)) {
                                return number_format($number, 0, ',', '.') . "{$suffix}";
                            }
                        }

                    }
                    ?>
                    <div class="right" style="" >
                        <?php
                        require_once './product.php';
                        require_once './Connett.php';
                        $c = new product("", "", "", "", "", "", "", "", "", "");
                        $rsl = $c->showsanpham($conn);
                        $ro = $rsl->fetch_assoc();
                        $type = $ro['type'];
                        ?>
                        <a class="conent_a" href="./index.php"><p>TRANG CHỦ </p></a><p class="conent_a"> / </p>  <a class="conent_a" href="type.php?type=<?php echo (str_replace(" ", "", $ro['type'])) ?>"><p><?php echo $ro['type'] ?></p></a>
                        <?php
                        require_once './product.php';
                        require_once './Connett.php';
                        $c = new product("", "", "", "", "", "", "", "", "", "");
                        $rsl = $c->showsanpham($conn);
                        $ro = $rsl->fetch_assoc();
                        $type = $ro['type'];
                        ?>
                        <p style="font-size: 50px;float: left;margin-top: 0%;margin-right: 20%"><?php echo $ro['name'] ?> </p>
                        <p style="font-size: 20px;float: left;margin-right: 40%">Type : <?php echo $type ?> </p><br>
                        <p style="font-size: 20px;float: left;margin-right: 40%"> Publisher : <?php echo $ro['publisher'] ?> </p>
                        <p style="font-size: 20px;float: left;margin-right: 40%"> Developers : <?php echo $ro['developers'] ?> </p>
                        <p style="font-size: 20px;float: left;margin-right: 40%"> Release Date : <?php echo $ro['releaseDate'] ?> </p>
                        <p style="font-size: 20px;float: left;margin-right: 40%">description : <?php echo $ro['description'] ?> </p><br>
                        <p style="font-size: 20px;float: left;margin-right: 40%">Price : <?php echo currency_format($ro['price']) ?> </p>
                        <?php
                        require_once './buy.php';
                        $asx = new buy("", "", "", "");
                        $usname = "";
                        if(isset($_SESSION["user_name"])){
                            $usname = $_SESSION["user_name"];
                        }
                        $gameID = $ro['name'];
                        $resault = $asx->ownGame($conn, $usname, $gameID);
                        if (is_null($resault->fetch_assoc())) {
                            echo '<p style="font-size: 50px;float: left;margin-top: 0%;margin-right: 40%"><a href="login.php" style="display:' . $dangnhap . '"><input type="submit" value="MUA HÀNG" style="margin-top: 50px" /></a></p>';
                            echo '<p style="font-size: 50px;float: left;margin-top: 0%;margin-right: 40%"><a href="sanpham.php?action=add&detal=' . $ro['gameID'] . '"style="display:' . $dangxuat . '"><input type="submit" value="MUA HÀNG" /></a></p>';
                        } else { 
                            echo '<p style="font-size: 50px;float: left;margin-top: 0%;margin-right: 40%"><a href="#"style="display:' . $dangxuat . '"><input style="padding: 0px 48px;" type="submit" value="OWNED" /></a></p>';
                        }
                        ?>
                    </div>
                    <div class="col-md-1">
                        <?php
                        if (isset($_GET['action']) && $_GET['action'] == "add") {
                            $id = intval($_GET['detal']);
                            if (isset($_SESSION['cart'][$id])) {
                                
                            } else {
                                if (isset($ro['gameID'])) {
                                    $_SESSION['cart'][$ro['gameID']] = array("name" => $ro['name'], "quantity" => 1, "price" => $ro['price'], "image" => $img);
                                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=Giohang.php\">";
                                } else {
                                    $message = "This product id is invalid!";
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="row"  >
            <div class="col-md-1"></div>
            <div class="col-md-10" >
                <iframe height="600px" width="70%"  
                        src="https://www.youtube.com/embed/<?php echo $ro['URLvideo']; ?>">
                </iframe>


            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" >
                <p style="font-size: 50px;float: left;margin-top: 5%;margin-right: 60%"> Product for Type </p>
                <?php
                require_once './product.php';
                require_once './Connett.php';
                $calls = new product("", "", "", "", "", "", "", "", "", "");
                $i = 1;
                $results = $calls->showall($conn);
                ?>
                <?php
                while ($rows = $results->fetch_assoc()) {
                    if (($rows['status'] == "true") && $rows['type'] == $type) {
                        ?>
                        <div class="product">
                            <a href="./sanpham.php?detal=<?php echo $rows['gameID'] ?>">
                                <div style="height: 80%; width: 100%;">
                                    <?php
                                    $rs = $calls->showimg($conn, $rows['gameID']);
                                    $rowws = $rs->fetch_assoc();
                                    ?>
                                    <td><img src="<?php echo $rowws['imgURL']; ?>" alt="" height="100%" width="100%"> </td>
                                </div>

                            </a>
                            <div style="height: 20%; width: 100%;background-image: linear-gradient(black, blue);">
                                <h3><?php echo $rows['name']; ?></h3>
                                <h4 style="font-size: 15px;"><?php echo currency_format($rows['price']); ?></h4>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
            <div class="col-md-1"></div>
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
        </footer>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
    </body>

</html>