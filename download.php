<?php
    require_once 'app/config/config.php';

    $file_path = isset($_GET['file_path']) ? $_GET['file_path'] : '';
    $file_name = isset($_GET['file_name']) ? $_GET['file_name'] : '';

    $fullPath = dirname(__FILE__) . '/assets/vanban/' . $file_path;
    if (file_exists($fullPath)) {
        chmod($fullPath, 0644);
    
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $file_name);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fullPath));

        readfile($fullPath);
        exit;
    }
    