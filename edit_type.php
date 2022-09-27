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
    <title>Create Type</title>
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
                <h1 class="fas fa-h1" style="margin: 25% 0% 2% 0%; ">Create Type</h1>
                <section>
                    <?php
                        require_once './product.php';
                        require_once './Connett.php';
                        $call = new product("", "", "", "", "", "", "", "", "", "");
                        $result = $call->seach($conn);
                        ?>
                    <form action="#" method="post" class="create">
                        <div class="form">
                            <?php
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                            <label for="">
                                Id Type
                            </label>
                            <input type="number" name="type_id" class="alert-dark form-control" pattern="" readonly=""
                                value="<?php echo $row['Type_ID'] ?>">
                        </div>
                        <div class="form">
                            <label for="">
                                Name Type
                            </label>
                            <input type="text" name="type" class="alert-dark form-control" required max="80" step="10"
                                min="0" title="Please enter a event sales" value="<?php echo $row['Name'] ?>" require>
                        </div>
                        <input type="submit" name="submit" value="Update Type" class="btn-primary btn btn-rounded">
                        <?php }?>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <?php
            if (isset($_POST["submit"])) {
                require_once './Connett.php';
                require_once './product.php';
                $type_id = $_POST["type_id"];
                $type = $_POST["type"];
                $call = new product("", "", "", "", "", "", "", "", "", "");
                $call->edittype($conn,$type);
                echo "<script>alert('Update success');</script>";
                echo "<meta http-equiv=\"refresh\" content=\"0;URL=manage_Type.php\">";
            }
            ?>
    <div class="col-md-4"></div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>

</html>