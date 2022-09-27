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
    <title>Manage Customer</title>
    <script language="javascript" src="assets/js/admin.js"></script>
</head>
<?php
    session_start();
    if (!isset($_SESSION["user_name"]) ) {
        unset($_SESSION["user_name"]);
        echo "<script>alert('please log in');</script>";
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
    } 
    ?>
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
                                                        if ($_REQUEST["user"] and $_REQUEST['user'] != "") {
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
                    <h1 class="fas fa-h1">Manage Customer</h1>
                    <form action="" method="post">
                        <input type="submit" class="btn btn-primary " name="timkiem" value="search">
                        <input type="search" name="seach" id="" class="seach" placeholder="search">
                    </form>
                </div>
                <?php
                    $color = array("table-danger", "table-primary", "table-secondary", "table-success", "table-warning", "table-info", "table-light", "table-danger");
                    if (isset($_POST['timkiem'])) {
                        require_once './customer.php';
                        require_once './Connett.php';
                        $call = new customer("", "", "", "");
                        $i = 0;
                        $seach = $_POST['seach'];
                        $result = $call->showallseachname($conn, $seach);
                        $s = 'block';
                    } else {
                        require_once './customer.php';
                        require_once './Connett.php';
                        $call = new customer("", "", "", "");
                        $i = 0;
                        $result = $call->showallcustomer($conn);
                        $s = 'none';
                    }
                    ?>
                <table class="table table-hover">
                    <thead>
                        <tr class="table-danger">
                            <th>#</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                if ($row['status'] == "true" && $row['type'] != "Admin") {
                                    $i++;
                                    $n = $i % 7;
                                    ?>
                        <tr class="<?php echo $color[$n]; ?>">
                            <th scope="row"><?php echo $i-1 ?></th>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['type'] ?></td>
                            <th><?php echo $row['username'] ?></th>
                            <td><?php echo $row['password'] ?></td>
                            <td><a href="edit_customer.php?edit=<?php echo $row['email']; ?>"><img
                                        src="./img/icons8-edit.svg" alt="" style="height: 40px;width: 40px;"></a>
                            </td>
                            <td><a href="manage_customer.php?delete=<?php echo $row['username']; ?>"><img
                                        src="./img/icons8-delete.svg" alt="" style="height: 40px;width: 40px;"></a></td>
                        </tr>
                        <?php
                                }
                            }
                            ?>
                    </tbody>
                    <?php
                        if (!empty($_GET['delete'])) {
                            if ($_REQUEST["delete"]and $_REQUEST['delete'] != "") {
                                require_once './customer.php';
                                require_once './Connett.php';
                                $call = new customer("", "", "", "");
                                $call->delete($conn);
                                echo "<script>alert('Delete successfully');</script>";
                                echo "<meta http-equiv=\"refresh\" content=\"0;URL=manage_customer.php\">";
                            }
                        }
                        ?>
                </table>
                <a href="./create_cutomer.php"><img src="img/plus.png" alt=""
                        style="height: 50px;width: 50px; float: right; margin-right: 15px;"></a>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>

</html>