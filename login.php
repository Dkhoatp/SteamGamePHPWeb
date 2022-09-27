<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="Description" content="Enter your description here" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="./assets/css/index.css">
        <link rel="stylesheet" href="./assets/css/creteform.css">
        <script src=""></script>
        <title>Login</title>
    </head>

    <body>
        <?php
        session_start();
        $k = "";
        if (isset($_POST['submit'])) {
            $us = $_POST['us'];
            $pw = $_POST['pw'];
            require_once './Connett.php';
            require_once './customer.php';
            $Caller = new customer("", "", $us, $pw);
            $user = $Caller->login($conn);
            if ($user->fetch_assoc() > 0) {
                if (!empty($_POST['check'])) {
                    setcookie('member_login', $us, time() + 60 * 60 * 1);
                    setcookie('member_pwd', $pw, time() + 60 * 60 * 1);
                } else {
                    if (isset($_COOKIE['member_login'])) {
                        setcookie('member_login', '');
                    }
                    if (isset($_COOKIE['member_pwd'])) {
                        setcookie('member_pwd', '');
                    }
                }
                $_SESSION['user_name'] = $us;
                $_SESSION['id'] = $row['username'];
                $_SESSION['last_login'] = time();
                if ($us == 'Admin') {
                    header('location:manage_product.php');
                } else {
                    header('location:index.php');
                }
            } else {
                $k = "true";
            }
        }
        ?>
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
                        <a href="regiter.php" class="nav_conent">
                            <p>Register</p>
                        </a>

                    </div>

                </div>
                <div class="col-md-1">
                </div>
            </div>
            <div class="content row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h1 class="fas fa-h1" style="margin: 25% 0% 2% 0%; ">Login</h1>
                    <section>
                        <form action="#" method="post" class="create">
                            <div class="form">
                                <label for="">
                                    Username
                                </label>
                                <input type="text" name="us" class="alert-dark form-control" 
                                       title="Please enter a id type"value="<?php
                                       if (isset($_COOKIE['member_login'])) {
                                           echo $_COOKIE['member_login'];
                                       }
                                       ?>">
                            </div>
                            <div class="form">
                                <label for="">
                                    Password
                                </label>
                                <input type="password" name="pw" class="alert-dark form-control" required max="80" value="<?php
                                       if (isset($_COOKIE['member_pwd'])) {
                                           echo $_COOKIE['member_pwd'];
                                       }
                                       ?>">
                            </div>
                            <label><input type="checkbox" name="check" <?php if (isset($_COOKIE['member_login'])) { ?> checked <?php } ?>> Nhớ Đăng Nhập</label>
                            <input type="submit" name="submit" value="Login" class="btn-primary btn btn-rounded">

                        </form>
                    </section>
                    <?php
                    if ($k == "true") {
                        echo "<script>alert('Đăng nhập không thành công');</script>";
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