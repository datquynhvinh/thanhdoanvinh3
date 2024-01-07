<?php
    require_once '../../app/config/config.php';
    include_once APPROOT . '/helpers/lib.php';
    include_once APPROOT . '/db/connect.php';

    $sql_category = mysqli_query($con,'SELECT * FROM menu ORDER BY idMenu DESC');
    $sql_category_top = mysqli_query($con,'SELECT * FROM `menu-top` ORDER BY idMenuTop ASC');
?>

<!DOCTYPE html>
<html lang="en">

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

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/animate.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/slick/slick-theme.css">
    <script src="<?php echo URLROOT; ?>/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo URLROOT; ?>/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo URLROOT; ?>/assets/slick/slick.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500&family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="<?php echo URLROOT; ?>/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URLROOT; ?>/admin/assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?php echo URLROOT; ?>/admin/assets/plugins/pace/pace.css" rel="stylesheet">
    <link href="<?php echo URLROOT; ?>/admin/assets/plugins/highlight/styles/github-gist.css" rel="stylesheet">
    <link href="<?php echo URLROOT; ?>/admin/assets/plugins/datatables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    

    <!-- Theme Styles -->
    <link href="<?php echo URLROOT; ?>/admin/assets/css/main.min.css" rel="stylesheet">
    <link href="<?php echo URLROOT; ?>/admin/assets/css/custom.css" rel="stylesheet">

    <!-- Theme Logo -->
    <link rel="icon" type="image/ico" href="<?php echo URLROOT; ?>/assets/img/logo/logo_icon.png">
</head>
<style>
    .user-greeting {
        font-size: 17px;
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .user-greeting:hover .user-options {
        display: block;
    }

    .user-name {
        font-weight: bold;
        color: #333;
    }

    .user-options {
        position: absolute;
        top: 100%;
        right: 0;
        display: none;
        background-color: #f2f2f2;
        padding: 5px 0;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .user-options a {
        display: block;
        padding: 5px 10px;
        color: #333;
        text-decoration: none;
        position: relative; /* thêm dòng này để có thể set z-index cho các option */
        z-index: 1; /* set z-index cho các option */
    }

    .user-options a:hover {
        background-color: #ddd;
    }

    .logout {
        position: absolute;
        top: 100%;
        right: 0;
        display: none;
        z-index: 2; /* set z-index khác với change-password */
    }

    .change-password {
        position: absolute;
        top: 100%;
        right: 0;
        display: none;
        z-index: 3; /* set z-index khác với logout */
    }

    .user-greeting:hover .logout,
    .user-greeting:hover .change-password {
        display: block;
    }
</style>
<body>
<div class="section_header">
        <div class="header_pc">
            <div class="header_page">
                <div class="container">
                    <div class="row">
                        <ul class="menu_top" style="width: unset;">
                        <?php 
                            $sql_idmenutop = mysqli_query($con,'SELECT * FROM `menu-top` ORDER BY idMenuTop ASC');
                            while($sql_idmenutop = mysqli_fetch_array($sql_category_top)){ ?>
                                <li>
                                    <a class="text-uppercase" href="<?php echo URLROOT . '/' . $sql_idmenutop['slug']; ?>.php">
                                            <?php echo $sql_idmenutop['title']; ?>
                                    </a>
                                </li>
                            <?php } 
                        ?>
                        </ul>

                        <ul class="icon_headertop" style="width: unset;">
                            <?php if (isLoggedIn()) { ?>
                                <div class="user-greeting">
                                    Xin chào, <span class="user-name"><?php echo $_SESSION["user_name"]; ?></span>
                                    <div class="user-options">
                                        <a class="change-password" href="<?php echo URLROOT ?>/admin/auth/change_password.php">Đổi mật khẩu</a>
                                        <a class="logout" href="<?php echo URLROOT ?>/admin/auth/login.php">Đăng xuất</a>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <li><a href="" title=""><img src="<?php echo URLROOT; ?>/assets/img/icon1.png" alt=""></a></li>
                                <li><a href="" title=""><img src="<?php echo URLROOT; ?>/assets/img/icon2.png" alt=""></a></li>
                                <li><a href="" title=""><img src="<?php echo URLROOT; ?>/assets/img/icon3.png" alt=""></a></li>
                                <li><a href="" title=""><img src="<?php echo URLROOT; ?>/assets/img/icon4.png" alt=""></a></li>
                                <li><a href="" title=""><img src="<?php echo URLROOT; ?>/assets/img/icon5.png" alt=""></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="header_page">
                <div class="container">
                    <div class="row">
                        <div class="element_bar_menu">
                            <a href="<?php echo URLROOT ?>" title="">
                                <img src="<?php echo URLROOT; ?>/assets/img/logo.png" alt="">
                            </a>
                            <div class="icon_bar">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <span><img src="<?php echo URLROOT; ?>/assets/img/bgheader.png" alt=""></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header_page">
                <div class="container">
                    <div class="row">
                        <ul class="main_menu main_menu_mobi">
                            <ul class="icon_headertop">
                                <li><a href="" title=""><img src="<?php echo URLROOT; ?>/assets/img/icon1.png" alt=""></a></li>
                                <li><a href="" title=""><img src="<?php echo URLROOT; ?>/assets/img/icon2.png" alt=""></a></li>
                                <li><a href="" title=""><img src="<?php echo URLROOT; ?>/assets/img/icon3.png" alt=""></a></li>
                                <li><a href="" title=""><img src="<?php echo URLROOT; ?>/assets/img/icon4.png" alt=""></a></li>
                                <li><a href="" title=""><img src="<?php echo URLROOT; ?>/assets/img/icon5.png" alt=""></a></li>
                            </ul>
                            <li><a href="<?php echo URLROOT ?>" title=""><img src="<?php echo URLROOT; ?>/assets/img/home.png" alt=""></a></li>
                            <?php 
                                $sql_category_danhmuc = mysqli_query($con,'SELECT * FROM menu ORDER BY idMenu ASC');
                                while($row_category_danhmuc = mysqli_fetch_array($sql_category_danhmuc)){ ?>
                                <li class="hightline">
                                    <a href="<?php echo URLROOT . '/' . $row_category_danhmuc['slug']; ?>.php">
                                        <?php echo $row_category_danhmuc['title']; ?>
                                    </a>
                                </li>
                                <?php } 
                            ?>
                            <li>
                                <a href="" title=""><img src="<?php echo URLROOT; ?>/assets/img/search.png" alt=""></a>
                                <div class="mega_menu search_header">
                                    <form class="form_search">
                                        <input type="text" name="">
                                        <a href="" class="btn btn_search" title=""><img src="<?php echo URLROOT; ?>/assets/img/search.png" alt=""></a>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>