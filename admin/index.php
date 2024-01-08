<?php
    require_once '../app/config/config.php';
    include_once APPROOT . '/helpers/lib.php';
    include_once APPROOT . '/db/connect.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: auth/login.php");
        exit();
    }

    redirect('admin/menu');
    exit();
?>
