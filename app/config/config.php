<?php

//App Root
define('APPROOT', dirname(dirname(__FILE__)));
//URL Root
// Nhớ xóa ký tự / ở cuối
// define('URLROOT', 'http://localhost/thanhdoanvinh3/');
define('URLROOT', 'https://doan.congnghephanmem.online');
//Site Name
define('SITENAME', 'Đoàn Thanh Niên Thành Phố Vinh');
//App Version
define('APPVERSION', '0.2.0');

//Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'izfaqdfz_webdoan2');
define('DB_PASS', 'tJsh_!Ur92P[');
define('DB_NAME', 'izfaqdfz_webdoan2');
define('DB_CHARSET', 'utf8');

// define('DB_HOST', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_NAME', 'thanhdoanvinh2');
// define('DB_CHARSET', 'utf8');

define('LOAI_VAN_BAN', [
    'thanhdoan' => 1,
    'coso' => 2,
]);

define("DS", "/");
define("BASE_DIR", $_SERVER['DOCUMENT_ROOT']);
define("TIN_TUC_UPLOAD_DIR", '/assets/img/upload/');