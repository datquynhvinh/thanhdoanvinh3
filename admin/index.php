<?php
    require_once '../app/config/config.php';
    
    if (!isset($_SESSION['user'])) {
        header("Location: auth/login.php");
        exit();
    }

    $currentURL = $_SERVER['REQUEST_URI'];
    $loginURL = 'URLROOT . /admin/auth/login.php';

    if (strpos($currentURL, $loginURL) !== false) {
        header("Location: /dashboard/");
        exit();
    }
?>
