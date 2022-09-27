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
    <link rel="stylesheet" href="./assets/css/creteform_pd.css">
    <script src=""></script>
    <title>Edit product</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row header">
            <div class="col-md-1"></div>
            <div class="row col-md-10">
                <img src="./img/logo_steam.svg" alt="" class="col-md-3 logo">
                <div class="col-md-9 nav">
                    <a href="#" class="nav_conent">
                        <p>Manager Customer</p>
                    </a>
                    <a href="#" class="nav_conent">
                        <p>Manager Product</p>
                    </a>
                    <a href="#" class="nav_conent">
                        <p>Manager Event</p>
                    </a>
                    <a href="#" class="nav_conent">
                        <p>Manager Type</p>
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
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h1 class="fas fa-h1" style="margin: 3% 0% 2% 0%; ">Edit Product</h1>
                <section>
                    <form action="#" method="post" class="create" enctype="multipart/form-data">
                        <?php
                            require_once './product.php';
                            require_once './Connett.php';
                            $call = new product("", "", "", "", "", "", "", "", "", "");
                            $result = $call->seachproduct($conn);
                            $roww = $result->fetch_assoc();
                            ?>
                        <div class="form">
                            <label for="">
                                Game_id
                            </label>
                            <input type="text" class="alert-dark form-control" value="<?php echo $roww['gameID'] ?>"
                                name="game_id" required title="Please enter a Product id" readonly="">
                        </div>
                        <div class="form">
                            <label for="">
                                Type
                            </label>
                            <select name="type" style="float: right;height:38px;width:433.578px">
                                <?php
                                    require_once './product.php';
                                    require_once './Connett.php';
                                    $call = new product("", "", "", "", "", "", "", "", "", "");
                                    $result = $call->showalltype($conn);
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                <option value="<?php echo $row['Name'] ?>"><?php echo $row['Name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form">
                            <label for="">
                                Name
                            </label>
                            <input type="text" class="alert-dark form-control" name="name" required
                                title="Please enter a  Name" value="<?php echo $roww['name'] ?>">
                        </div>
                        <div class="form">
                            <label for="">
                                publisher
                            </label>
                            <input type="text" class="alert-dark form-control" name="publisher" required
                                title="Please enter a publisher" value="<?php echo $roww['publisher'] ?>">
                        </div>
                        <div class="form">
                            <label for="">
                                developers
                            </label>
                            <input type="text" name="developers" class="alert-dark form-control" required
                                title="Please enter a developers" value="<?php echo $roww['developers'] ?>">
                        </div>
                        <div class="form">
                            <label for="">
                                URL Video
                            </label>
                            <input type="text" name="video" class="alert-dark form-control" title="Please enter a Video"
                                value="<?php echo $roww['URLvideo']?>">
                        </div>
                        <div class="form">
                            <label for="">
                                price
                            </label>
                            <input type="text" name="price" class="alert-dark form-control" required
                                title="Please enter a price" value="<?php echo $roww['price']?>">
                        </div>
                        <div class="form">
                            <label for="">
                                description
                            </label>
                            <input type="text" name="description" class="alert-dark form-control" required
                                title="Please enter a description" value="<?php echo $roww['description']?>">
                        </div>
                        <input type="submit" value="Update Product" name="submit" class="btn-primary btn btn-rounded">
                    </form>
                </section>
                <?php
                    if (isset($_POST['submit'])) {
                        $id = $_POST["game_id"];
                        $name = $_POST["name"];
                        $type = $_POST["type"];
                        $publisher = $_POST["publisher"];
                        $developers = $_POST["developers"];
                        $video = $_POST["video"];
                        $price = $_POST["price"];
                        $description = $_POST["description"];
                        require_once './Connett.php';
                        require_once './product.php';
                        $caller = new product($id, $type, $name, $publisher, $developers, "", "", $video, $price, $description);
                        $caller->edit($conn);
                        echo "<script>alert('Update successfully');</script>";
                        echo "<meta http-equiv=\"refresh\" content=\"0;URL=manage_product.php\">";
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