<?php
    require_once '../../app/config/config.php';
    include_once APPROOT . '/helpers/lib.php';
    include_once APPROOT . '/db/connect.php';

    // Import UI
    include_once '../include/auth_ui.php';

    if (!isLoggedIn()) {
        redirect('admin/auth/login.php');
    }
?>
    <section class="bg-title-page p-t-50 p-b-40 flex-col-c-m">
    </br>
    <h1 style="text-align: center;">Xin lỗi vì sự bất tiện này!</h1>
    <h4 style="text-align: center;">
        Bạn đã đăng ký tài khoản thành công, vui lòng liên hệ quản trị viên để kích hoạt tài khoản.
    </h4>
  </section>