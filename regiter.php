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
        <title>Create Accout</title>
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
                        <a href="login.php" class="nav_conent">
                            <p>Login</p>
                        </a>

                    </div>

                </div>
                <div class="col-md-1">
                </div>
            </div>
            <div class="content row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h1 class="fas fa-h1" style="margin: 25% 0% 2% 0%; ">Create Accout</h1>
                    <section>
                        <form action="#" method="post" class="create">
                            <div class="form">
                                <label for="">
                                    Username
                                </label>     
                                <input type="text" name="us" class="alert-dark form-control" placeholder="Khoaprt" required title="Please enter a username" attern="[A-Za-z0-9]{5,30}">           
                            </div>
                            <div class="form">
                                <label for="">
                                    Password
                                </label>     
                                <input type="password" name="pw" class="alert-dark form-control" required  placeholder="********"   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  title="Must contain at least one number and one upper and lowercase letter and at least 8 characters">           
                            </div>
                            <div class="form">
                                <label for="">
                                    Email
                                </label>     
                                <input type="email" name="email" class="alert-dark form-control"  required title="Please enter a email" placeholder="Khoa@gmail.com">           
                            </div>
                            <input type="submit" value="Create Accout" name="submit" class="btn-primary btn btn-rounded" >
                        </form> 
                    </section>
                    <?php
                    if (isset($_POST["submit"])) {
                        require_once './Connett.php';
                        require_once './customer.php';
                        $email = $_POST["email"];
                        $type = "user";
                        $us = $_POST["us"];
                        $pw = $_POST["pw"];
                        $call = new customer($email, $type, $us, $pw);
                        $call->insert($conn);
                        echo "<script>alert('Create success');</script>";
                        echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\">";
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