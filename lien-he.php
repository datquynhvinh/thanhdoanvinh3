<?php
	session_start();
	include_once('app/db/connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Liên Hệ</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta name="description" content="">
    <meta charset="utf-8">
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
    <script>
      // Tải lại trang khi người dùng nhấn nút F5 hoặc nút tải lại trên trình duyệt
      window.addEventListener("keydown", function(event) {
        if (event.keyCode === 116) {
          event.preventDefault();
          location.reload();
        }
      });
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500&family=Roboto:wght@300;500&display=swap" rel="stylesheet">
</head>
<body>

<?php
    include('include/menu.php');
?>

<div class="section_banner">
    <div class="img">
        <img src="./assets/img/lienhe.png" alt="">
    </div>
    <h2><span>LIÊN HỆ</span></h2>
</div>

<div class="section_breadcrumb">
    <div class="container container_width">
        <div class="row">
            <ul class="element_breadcrumb">
                <li><img src="./assets/img/homapgebreadcumb.png" alt=""></li>
                <li><a href="" title="">Liên hệ</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="section_contact_form">
    <div class="container">
        <div class="row">
            <div class="contact_form">
                <h2>Gửi thư tới Thành đoàn Vinh</h2>
                <p>Nếu bạn có nhu cầu liên hệ với Thành đoàn Vinh, vui lòng điền đầy đủ thông tin theo form dưới đây. Chuyên viên hỗ trợ của chúng tôi sẽ tiếp nhận và trả lời bạn trong thời gian sớm nhất.</p>
                <form method="post" class="form_default">
                    <span>
                        <input type="text" name="name" placeholder="Họ và tên:">
                    </span>
                    <span>
                        <input type="text" name="phone" placeholder="Số điện thoại:">
                    </span>
                    <span>
                        <input type="text" name="email" placeholder="Email:">
                    </span>
                    <span>
                        <input type="text" name="address" placeholder="Địa chỉ:">
                    </span>
                    <span>
                        <textarea name="message" placeholder="Nội dung:"></textarea>
                    </span>
                    <button  type="submit" name="submit" class="btn btn_contactform">Gửi<img src="./assets/img/btncontacform.png" alt=""></button>
                    <div id="status-send-email"></div>
                </form>
            </div>
            <div class="img_contact_form">
                <img src="./assets/img/img8.png" alt="">
            </div>
        </div>
    </div>
</div>

<div class="section_map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3728.3617326376375!2d106.68104271533036!3d20.85746519897888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a7af34f5cf06f%3A0x93ff11f4d4ce49c7!2zMjIgVHLhuqduIEjGsG5nIMSQ4bqhbywgSG_DoG5nIFbEg24gVGjhu6UsIEjhu5NuZyBCw6BuZywgSOG6o2kgUGjDsm5nLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1607928693040!5m2!1sen!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>

<?php 
    include('include/footer.php');
?>
</body>
</html>

<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $message = $_POST['message'];

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.yandex.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'admin@muachungtool.com';
            $mail->Password = 'pishbltplujsayjk';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('admin@muachungtool.com', 'Mua Chung Tool');
            $mail->addAddress($email);
            $mail->addAddress('admin@muachungtool.com');

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = "$name đã gửi 1 tin nhắn";
            $mail->Body = "<p>Tên: $name</p><p>Điện thoại: $phone</p><p>Email: $email</p><p>Địa chỉ: $address</p><p>Nội dung: $message</p>";

            // Gửi email
            $mail->send();

            echo '<script type="text/javascript">
                      var button = document.querySelector("#status-send-email");
                      button.innerHTML = \'<div class="alert alert-success text-center">Email đã được gửi thành công!</div><style>.btn_contactform{display:none}</style>\';
                  </script>';
        } catch (Exception $e) {
            // Hiển thị thông báo lỗi nếu có lỗi xảy ra trong quá trình gửi email
            echo '<script type="text/javascript">
                    var button = document.querySelector("#status-send-email");
                    button.innerHTML = \'<div class="alert alert-danger text-center">Gửi email thất bại!</div><style>.btn_contactform{display:none}</style>\';
                  </script>';
        }
    }
?>