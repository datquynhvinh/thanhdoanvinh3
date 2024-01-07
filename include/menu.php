<?php 
    require_once 'app/config/config.php';
    $sql_category = mysqli_query($con,'SELECT * FROM menu ORDER BY idMenu DESC');
    $sql_category_top = mysqli_query($con,'SELECT * FROM `menu-top` ORDER BY idMenuTop ASC');
?>
<!DOCTYPE html>
<html lang="vi">

<head>

    <title><?php echo SITENAME ?></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link rel="stylesheet" type="text/css" href="./assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/animate.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="./assets/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./assets/slick/slick-theme.css">
    <script src="./assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="./assets/slick/slick.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500&family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    <link rel="icon" type="image/ico" href="<?php echo URLROOT; ?>/assets/img/logo/logo_icon.png">
</head>
<body>
<div class="section_header">
    <div class="header_pc">
        <div class="header_page">
            <div class="container">
                <div class="row">
                    <ul class="menu_top">
					<?php 
                        $sql_idmenutop = mysqli_query($con,'SELECT * FROM `menu-top` ORDER BY idMenuTop ASC');
                        while($sql_idmenutop = mysqli_fetch_array($sql_category_top)){ ?>
                            <li>
                                <a class="text-uppercase" href="<?php echo $sql_idmenutop['slug']; ?>.php">
                                        <?php echo $sql_idmenutop['title']; ?>
                                </a>
                            </li>
                        <?php } 
					?>
                    </ul>

                    <ul class="icon_headertop">
                        <li><a href="" title=""><img src="./assets/img/icon1.png" alt=""></a></li>
                        <li><a href="" title=""><img src="./assets/img/icon2.png" alt=""></a></li>
                        <li><a href="" title=""><img src="./assets/img/icon3.png" alt=""></a></li>
                        <li><a href="" title=""><img src="./assets/img/icon4.png" alt=""></a></li>
                        <li><a href="" title=""><img src="./assets/img/icon5.png" alt=""></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="header_page">
            <div class="container">
                <div class="row">
                    <div class="element_bar_menu">
                        <a href="<?php echo URLROOT ?>" title="">
                            <img src="./assets/img/logo.png" alt="">
                        </a>
                        <div class="icon_bar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <span><img src="./assets/img/bgheader.png" alt=""></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="header_page">
            <div class="container">
                <div class="row">
                    <ul class="main_menu main_menu_mobi">
                        <ul class="icon_headertop">
                            <li><a href="" title=""><img src="./assets/img/icon1.png" alt=""></a></li>
                            <li><a href="" title=""><img src="./assets/img/icon2.png" alt=""></a></li>
                            <li><a href="" title=""><img src="./assets/img/icon3.png" alt=""></a></li>
                            <li><a href="" title=""><img src="./assets/img/icon4.png" alt=""></a></li>
                            <li><a href="" title=""><img src="./assets/img/icon5.png" alt=""></a></li>
                        </ul>
                        <li><a href="<?php echo URLROOT ?>" title=""><img src="./assets/img/home.png" alt=""></a></li>
                        <?php 
                            $sql_category_danhmuc = mysqli_query($con,'SELECT * FROM menu ORDER BY idMenu ASC');
                            while($row_category_danhmuc = mysqli_fetch_array($sql_category_danhmuc)){ ?>
                            <li class="hightline">
                                <a href="<?php echo $row_category_danhmuc['slug']; ?>">
                                    <?php echo $row_category_danhmuc['title']; ?>
                                </a>
                            </li>
                            <?php } 
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header_page">
            <div class="container">
                <div class="row">
                    <div class="cicrle">
                        <span></span>
                    </div>
                    <div class="post_marquee">
                        <marquee>
                            <?php 
                                $sql_post = mysqli_query($con,'SELECT * FROM `news` ORDER BY id ASC LIMIT 3');
                                while($row = mysqli_fetch_array($sql_post)){ ?>
                                        <a href="<?php echo URLROOT . '/' . $row['url'] ?> "><?php echo $row['title'] ?> </a>
                                <?php } 
                            ?>
                        </marquee>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>