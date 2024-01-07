<!DOCTYPE html>
<html>
<head>
    <title>Quản lý Media</title>
    <style>
        .thumbnail {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h1>Quản lý Media</h1>
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Tìm kiếm...">
        <input type="submit" value="Tìm kiếm">
    </form>

    <?php
        // Đường dẫn tuyệt đối đến thư mục chứa hình ảnh upload
        $imageDirectory = 'doan.congnghephanmem.online/assets/img/upload';

        // Tìm kiếm từ khóa
        $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

        // Lấy danh sách các tệp hình ảnh trong thư mục
        $images = glob($imageDirectory . '/*.{jpg,png,gif}', GLOB_BRACE);

        foreach ($images as $image) {
            // Lấy tên file
            $filename = basename($image);

            // Kiểm tra nếu từ khóa khớp với tên file
            if (strpos($filename, $searchKeyword) !== false) {
                echo '<img src="https://doan.congnghephanmem.online/assets/img/upload/' . $filename . '" alt="' . $filename . '" class="thumbnail">';
            }
        }
    ?>
</body>
</html>
