<?php
    include_once('../db/connect.php');
    include_once('../../app/helpers/lib.php');

    if (!isLoggedIn()) {
        redirect('admin/auth/login.php');
    }

    if (!isActive()) {
        redirect('admin/auth/request_accept.php');
    }

    $sql_category = mysqli_query($con,'SELECT * FROM menu ORDER BY idMenu DESC');
    $sql_category_top = mysqli_query($con,'SELECT * FROM `menu-top` ORDER BY idMenuTop ASC');
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">

    <!-- Title -->
    <title>Trang Quản Trị - Đoàn Thanh niên Đại học Vinh</title>

    <!-- Styles -->
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
    
    <link href="<?php echo URLROOT; ?>/admin/assets/css/styles.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/neptune.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/neptune.png" />

    <!-- Styles -->
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
    <script src="https://cdn.tiny.cloud/1/a84sd1jpm8ck57u07cjoibdewbv445yu0mbeud56rr1t2gsz/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Theme Styles -->
    <link href="<?php echo URLROOT; ?>/admin/assets/css/main.min.css" rel="stylesheet">
    <link href="<?php echo URLROOT; ?>/admin/assets/css/custom.css" rel="stylesheet">

    <!-- Theme Logo -->
    <link rel="icon" type="image/ico" href="<?php echo URLROOT; ?>/assets/img/logo/logo_icon.png">
</head>
</style>
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });
    let propertyDataTable = {
        info: false,
        processing: true,
        language: {
            sLengthMenu: "Hiển thị _MENU_ trên một trang",
            paginate: {
                next: ">>",
                previous: "<<"
            },
            zeroRecords: "Không có dữ liệu hiển thị",
            loadingRecords: "Vui lòng đợi",
            sSearch: "Tìm kiếm",
        },
    }
</script>
<style>
    input[type="file"] {
        display: none;
    }

    .custom-upload-button {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin: 0; /* Bỏ margin mặc định của button */
        display: inline-block; /* Chuyển button thành block-inline element */
        line-height: 1; /* Đặt line-height bằng 1 để căn giữa chữ */
        text-align: center; /* Canh giữa chữ trong button */
    }

    .custom-upload-button:hover {
        background-color: #3e8e41;
    }

    #preview {
        margin-top: 8px;
        margin-bottom: 8px;
        margin-left: 0px;
        margin-right: auto;
        display: block;
        width: 650px;
        height: 300px;
        object-fit: cover; /* giữ tỷ lệ khung hình */
        border-radius: 3%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        border-color: beige;
    }

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
                                    <a href="<?php echo URLROOT . '/' . $row_category_danhmuc['slug']; ?>">
                                        <?php echo $row_category_danhmuc['title']; ?>
                                    </a>
                                </li>
                                <?php } 
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="app align-content-stretch d-flex flex-wrap">
        <?php
            include('menu.php');
        ?>
