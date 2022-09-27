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
        <?php
        if (isset($_GET['action']) && $_GET['action'] == "remove") {
            foreach ($_SESSION["cart"] as $key => $value) {
                if ($_GET["id"] == $key)
                    unset($_SESSION["cart"][$key]);
                if (empty($_SESSION["cart"]))
                    unset($_SESSION["cart"]);
            }
        }
        ?>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="Description" content="Enter your description here" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="./assets/css/index.css">
        <title>Cart</title>
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
                                                while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                <li><a class="dropdown-item"
                                                       href="type.php?type=<?php echo str_replace(" ", "", $row['Name']) ?>"><?php echo $row['Name'] ?></a>
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
            <div class="content row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-danger">
                                <th>ID</th>
                                <th >Ảnh sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th >Số lượng</th>
                                <th >Giá</th>
                                <th>Tổng</th>
                                <th>Xoá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION["cart"])) {
                                $total_quantity = 0;
                                $total_price = 0;
                                ?>      
                                <?php
                                foreach ($_SESSION["cart"] as $item => $value) {
                                    if($total_quantity==0){
                                    $item_price = $value["quantity"] * $value["price"];
                                    ?>
                                    <tr class="table-primary">
                                        <td> <?php echo $item; ?></td>
                                        <td><img src="<?php echo $value["image"]; ?>" width="150px" height="150px" /></td>
                                        <td><?php echo $value["name"]; ?></td>
                                        <td style="text-align:center;"><?php echo $value["quantity"]; ?></td>
                                        <td  style="text-align:center;"><?php echo number_format($value["price"]) . " Đồng"; ?></td> 
                                        <td  style="text-align:center;"><?php echo number_format($item_price, 0) . " Đồng"; ?></td>
                                        <td style="text-align:center;"><a href="?action=remove&id=<?php echo $item; ?>" class="btnRemoveAction"><img src="./img/icon-delete.png" alt="Remove Item" width="16px" /></a></td>
                                        <?php
                                        $namegame = $value["name"];
                                        $date = (string) date("d/m/Y");
                                        ?>
                                    </tr>
                                    <?php
                                    $total_quantity += $value["quantity"];
                                    $total_price += ($value["price"] * $value["quantity"]);
                                    }
                                }
                                ?>
                                <tr class="table-secondary">
                                    <td colspan="3" align="center"><b>Tổng:</b></td>
                                    <td align="right" style="text-align: center"><b><?php echo $total_quantity; ?></b></td>  
                                    <td ></td>
                                    <td align="center" colspan="2"><strong><?php echo number_format($total_price, 0) . " Đồng"; ?></strong></td>   
                                </tr>
                                
                        </table>                
                        <?php
                    } else {
                        ?>
                        <div class="no-records">Giỏ của bạn trống trơn</div>
                        <?php
                    }
                    ?> 
                    </tbody>
                    <form method="POST" action="#">
                        <input type="submit" value="Buy" name="order" style="float: right" />
                    </form>
                </div>
                <?php
                if (isset($_POST['order'])) {
                    require_once './product.php';
                    require_once './Connett.php';
                    $call = new product("", "", "", "", "", "", "", "", "", "");
                    $name = $_SESSION["user_name"];
                    $call->insertbuy($conn, $namegame, $name, $date);
                    unset($_SESSION["cart"]);
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";     
                }
                ?>
                <div class="col-md-1"></div>
            </div>


        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
    </body>

</html>