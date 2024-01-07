<?php
	session_start();
    require_once 'app/config/config.php';
	include_once('app/db/connect.php');
	
	$user_query = "SELECT * FROM users WHERE id = '1'";
    $user_result = mysqli_query($connection, $user_query);
    $user = mysqli_fetch_array($user_result);
	
    // lấy giá trị url từ đường dẫn truy cập vào trang
    $url = $_SERVER['REQUEST_URI'];
    $url_components = explode('/', $url);
    $slug = end($url_components);
    
    // truy vấn cơ sở dữ liệu để lấy bài viết có trường url tương ứng với giá trị slug
    $sql = "SELECT * FROM news WHERE url = '$slug'";
    $result = mysqli_query($con, $sql);
    
    // kiểm tra kết quả truy vấn
    if (mysqli_num_rows($result) == 1) {
        // lấy dữ liệu bài viết
        $row = mysqli_fetch_assoc($result);
        $id = $row["id"];
        $title = $row["title"];
        $img = URLROOT . TIN_TUC_UPLOAD_DIR .$row["image"];
        $content = $row["content"];
        $category_id = $row["category_id"];
        $author_id = $row["author_id"];
        $updated_at = $row["updated_at"];
        $date = date('d/m/Y', strtotime($updated_at));
    } else {
        // không tìm thấy bài viết
        echo "Không tìm thấy bài viết";
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title?></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta name="description" content="">
    <meta name="keywords" content="">
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500&family=Roboto:wght@300;500&display=swap" rel="stylesheet">    
</head>
<body>

<div class="section_header">
    <div class="header_pc">
        <?php
	        include('include/menu.php');
	   ?>
    </div>
<div class="section_breadcrumb">
    <div class="container container_width">
        <div class="row">
            <ul class="element_breadcrumb">
                <li><img src="./assets/img/homapgebreadcumb.png" alt=""></li>
                <li><a href="/tin-tuc.php" title="">Tin tức</a></li>
                <li><a href="<?php "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>"><?php echo $title?></a></li>
            </ul>
        </div>
    </div>
</div>

<div class="section_content_width_sidebar page_news_3 wow fadeInUp" data-wow-delay="200ms">
    <div class="container">
        <div class="row">
            <div class="element_content_box">
                <h2 class="title_post"><?php echo $title ?></h2>
                <div class="date_print">
                    <p><img src="./assets/img/lock.png" alt=""><span><?php echo $date ?></span></p>
                    <?php
                        if ($_SESSION["user_role"] === 'admin') { ?>
                        <p style="margin-left: 10px"><a href="<?php echo URLROOT; ?>/admin/tin-tuc/edit.php?id=<?php echo $id; ?>"><i class="fas fa-edit"></i>Sửa bài viết</a></p>
                    <?php } ?>
                </div>
               <div class="details">
                    <?php echo $content ?>
               </div>
            </div>

            <div class="sidebar_box wow fadeInUp" data-wow-delay="200ms">
                <div class="element_title">
                    <div class="title">
                        <span><img src="./assets/img/saovang.png" alt=""></span>
                        <h2><a href="" title="">LIÊN KẾT</a></h2>
                    </div>
                </div>

                <div class="img_sideber">
                    <a href="" title=""><img src="./assets/img/sb1.png" alt=""></a>
                </div>
                <div class="img_sideber">
                    <a href="" title=""><img src="./assets/img/sb2.png" alt=""></a>
                </div>
                <div class="img_sideber">
                    <a href="" title=""><img src="./assets/img/sb3.png" alt=""></a>
                </div>
                <div class="img_sideber">
                    <a href="" title=""><img src="./assets/img/sb4.png" alt=""></a>
                </div>
                <div class="img_sideber">
                    <a href="" title=""><img src="./assets/img/sb5.png" alt=""></a>
                </div>
                <div class="img_sideber">
                    <a href="" title=""><img src="./assets/img/sb6.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
</body>
</html>

                        