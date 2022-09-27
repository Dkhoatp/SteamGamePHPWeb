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
        <title>Home</title>
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

                    </div>

                </div>
            </div>




            <div class="content row">
                <div class="col-md-1"></div>
                <div class="col-md-10" style=" margin-top: 50px">
                    <span  style="font-size: 30px;">Steam là địa chỉ hàng đầu để thưởng thức, thảo luận và sáng tạo trò chơi.</span>
                    <div id="about_greeting">
                        <div class="steam_logo" style=" margin-top: 50px"><img src="https://cdn.akamai.steamstatic.com/store//about/logo_steam.svg" alt="The logo for Steam" width="300px"></div>
                        <div class="about_subtitle"style=" margin-top: 50px">Steam is the ultimate destination for playing, discussing,
                            and creating games.</div>


                        <div class="about_install_wrapper">
                            <div class="about_install win "style=" margin-top: 50px">
                                <a href="https://cdn.akamai.steamstatic.com/client/installer/SteamSetup.exe" class="about_install_steam_link">Install Steam</a>
                            </div>
                            <div class="installer_list" style="margin-top: 50px">
                                <div class="available_platforms">
                                    Also available on:
                                </div>
                                <div style="margin-top: 50px;">
                                    <a class="platform_icon" href="#" style=" margin-left: 50px; margin-right: 50px">
                                        <img src="https://cdn.akamai.steamstatic.com/store/about/icon-macos.svg" width="150px">

                                    </a>  <a class="platform_icon" href="#" style=" margin-left: 50px; margin-right: 50px">
                                        <img src="https://cdn.akamai.steamstatic.com/store/about/icon-steamos.svg" width="140px">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-1"></div>
            </div>
            <div class="row" style="background-color: #1A293A;color: white;">
                <div class="col-md-1"></div>
                <div class="col-md-10" style=" margin-top: 50px">
                    <?php
                    $url = "https://kotaku.com/rss";
                    $invalidurl = false;
                    if (@simplexml_load_file($url)) {
                        $feeds = simplexml_load_file($url);
                    }
                    $i = 0;
                    if (!empty($feeds)) {
                        $site = $feeds->channel->title;
                        $sitelink = $feeds->channel->link;
                        echo "<h2>" . $site . "</h2>";
                        foreach ($feeds->channel->item as $item) {
                            $link = $item->link;
                            $postDate = $item->pubDate;
                            $pubDate = date('D, d M Y', strtotime($postDate));
                            $str = $item->description;
                            $sl = strpos($str, 'width') - strpos($str, '"https');
                            ?>                                      
                            <a href="<?php echo $link ?>" class="plain">
                                <div class="box box-vertical box-text-bottom box-blog-post has-hover">
                                    <img width="438" height="400" src="<?php echo substr($str, strpos($str, '"https') + 1, $sl - 3) ?>"/>  	
                                    <div class="box-text text-left" >
                                        <div class="box-text-inner blog-post-inner">
                                            <h5 class="post-title is-large "><?php echo $item->title; ?></h5>
                                            <div class="post-meta is-small op-8"><?php echo $pubDate; ?></div>					<div class="is-divider"></div>
                                            <p class="from_the_blog_excerpt "><?php echo substr($str, strpos($str, '>') + 1) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <br>
                            <?php
                        }
                    }
                    ?> 
                </div>

                <div class="col-md-1"></div>
            </div




        </div>        <footer class=" text-center text-white" style="background-color: #171A21;">
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