<?php
    require_once 'app/config/config.php';
    session_start();
    include_once('app/db/connect.php');

    $tinNoiBatSql = 'SELECT news.id, news.image, news.title, news.url, categories.cate_name, categories.cate_url
                 FROM news
                 LEFT JOIN categories ON news.category_id = categories.id
                 ORDER BY news.id DESC 
                 limit 4';
    $tinNoiBatResult = mysqli_query($con, $tinNoiBatSql);
    
    $tinNoiBats = array(); // Khởi tạo mảng rỗng để lưu trữ các tin nổi bật
    
    // Lấy bài đầu tiên từ kết quả truy vấn
    $tinNoiBatMoiNhat = mysqli_fetch_array($tinNoiBatResult, MYSQLI_ASSOC);
    
    // Lặp để lấy 3 bài tiếp theo
    for ($i = 0; $i < 3; $i++) {
        $result = mysqli_fetch_array($tinNoiBatResult, MYSQLI_ASSOC);
        if ($result) {
            $tinNoiBats[] = $result;
        }
    }

    /** Lấy danh sách văn bản thành đoàn */
    $vanBanThanhDoanSQL = 'SELECT * 
    FROM vanban
    WHERE loai = ' . LOAI_VAN_BAN['thanhdoan'] . '
    ORDER BY vanban.id DESC 
    limit 4';
    $vanBanThanhDoanResult = mysqli_query($con, $vanBanThanhDoanSQL);

    /** Lấy danh sách văn bản cơ sở */
    $vanBanCoSoSQL = 'SELECT * 
    FROM vanban
    WHERE loai = ' . LOAI_VAN_BAN['coso'] . '
    ORDER BY vanban.id DESC 
    limit 4';
    $vanBanCoSoResult = mysqli_query($con, $vanBanCoSoSQL);

    if (isset($_GET['fileupload'])) {
        $fileUpload = $_GET['fileupload'];
        $filePath = __DIR__ . '/assets/vanban/' . $fileUpload;

        // Kiểm tra xem tệp tin tồn tại hay không
        if (file_exists($filePath)) {
            // Thiết lập các tiêu đề để báo cho trình duyệt biết đây là tệp tin để tải xuống
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $_GET['filename'] . '"');
            
            // Xuất nội dung của tệp tin
            readfile($filePath);
            exit;
        }
    }

    include('include/menu.php');
?>
<div class="section_hot_news wow fadeInUp" data-wow-delay="200ms">
    <div class="container">
        <div class="row">
            <div class="element_hot_news">
                <div class="item">
                    <div class="box_item">
                        <a href="<?php echo $tinNoiBatMoiNhat['url'] ?>">
                            <img src="<?php echo !empty($tinNoiBatMoiNhat['image']) ? URLROOT . TIN_TUC_UPLOAD_DIR . $tinNoiBatMoiNhat['image'] : '' ?>">
                        </a>
                        <div class="content">
                            <h2><a href="<?php echo $tinNoiBatMoiNhat['url'] ?>"><?php echo !empty($tinNoiBatMoiNhat['title']) ? $tinNoiBatMoiNhat['title'] : '' ?></a></h2>
                            <p><a href="<?php echo $tinNoiBatMoiNhat['cate_url'] ?>"><?php echo !empty($tinNoiBatMoiNhat['cate_name']) ? $tinNoiBatMoiNhat['cate_name'] : '' ?></a></p>
                        </div>
                    </div>
                </div>
            
                <div class="item">
                    <?php foreach($tinNoiBats as $tinNoiBat) { ?>
                        <div class="box_item">
                            <a href="<?php echo $tinNoiBat['url'] ?>"><img src="<?php echo !empty($tinNoiBat['image']) ? URLROOT . TIN_TUC_UPLOAD_DIR . $tinNoiBat['image'] : '' ?>" alt=""></a>
                            <div class="content">
                                <h2><a href="<?php echo $tinNoiBat['url'] ?>"><?php echo !empty($tinNoiBat['title']) ? $tinNoiBat['title'] : '' ?></a></h2>
                                <p><a href="<?php echo $tinNoiBat['cate_url'] ?>"><?php echo !empty($tinNoiBat['cate_name']) ? $tinNoiBat['cate_name'] : '' ?></a></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section_list_news wow fadeInUp" data-wow-delay="200ms">
    <div class="container">
        <div class="row">
            <div class="element_news_large">
                <div class="element_title">
                    <div class="title">
                        <span><img src="./assets/img/saovang.png" alt=""></span>
                        <h2><a href="">Mỗi tuần 1 câu chuyện</a></h2>
                    </div>

                    <div class="choose_seemore">
                        <a href="" class="btn btn_seeall">Xem tất cả</a>
                    </div>
                </div>

                <div class="box_list_new">
                    <div class="news_item">
                        <a href="" title=""><img src="./assets/img/news56.png" alt=""></a>
                        <div class="content">
                            <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                            <p><a href="" title="">Tin chính trị - xã hội</a></p>
                        </div>
                    </div>

                    <div class="news_item">
                        <a href="" title=""><img src="./assets/img/news6.png" alt=""></a>
                        <div class="content">
                            <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                            <p><a href="" title="">Tin chính trị - xã hội</a></p>
                        </div>
                    </div>

                    <div class="news_item">
                        <a href="" title=""><img src="./assets/img/news7.png" alt=""></a>
                        <div class="content">
                            <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                            <p><a href="" title="">Tin chính trị - xã hội</a></p>
                        </div>
                    </div>

                    <div class="news_item">
                        <a href="" title=""><img src="./assets/img/news8.png" alt=""></a>
                        <div class="content">
                            <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                            <p><a href="" title="">Tin chính trị - xã hội</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="element_news_more">
                <div class="element_title">
                    <div class="title">
                        <span><img src="./assets/img/saovang.png" alt=""></span>
                        <h2><a href="" title="">TIN TỨC MỚI NHẤT</a></h2>
                    </div>
                </div>

                <div class="box_list_new_scroll">
                    <div class="news_item">
                        <a href="" title=""><img src="./assets/img/news56.png" alt=""></a>
                        <div class="content">
                            <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                        </div>
                    </div>

                    <div class="news_item">
                        <a href="" title=""><img src="./assets/img/news6.png" alt=""></a>
                        <div class="content">
                            <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                        </div>
                    </div>

                    <div class="news_item">
                        <a href="" title=""><img src="./assets/img/news7.png" alt=""></a>
                        <div class="content">
                            <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                        </div>
                    </div>

                    <div class="news_item">
                        <a href="" title=""><img src="./assets/img/news8.png" alt=""></a>
                        <div class="content">
                            <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                        </div>
                    </div>

                    <div class="news_item">
                        <a href="" title=""><img src="./assets/img/news7.png" alt=""></a>
                        <div class="content">
                            <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                        </div>
                    </div>

                    <div class="news_item">
                        <a href="" title=""><img src="./assets/img/news8.png" alt=""></a>
                        <div class="content">
                            <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="section_content_width_sidebar wow fadeInUp" data-wow-delay="200ms">
    <div class="container">
        <div class="row">
            <div class="element_content_box">
                <div class="img_content">
                    <img src="./assets/img/img_content.png" alt="">
                </div>

                <div class="element_news_large wow fadeInUp" data-wow-delay="200ms">
                    <div class="element_title">
                        <div class="title">
                            <span><img src="./assets/img/saovang.png" alt=""></span>
                            <h2><a href="" title="">CHUYÊN MỤC</a></h2>
                        </div>

                        <div class="choose_seemore">
                            <span>
                                <select>
                                    <option>Lựa chọn chuyên mục</option>
                                    <option>chuyên mục 1</option>
                                    <option>chuyên mục 2</option>
                                </select>
                            </span>

                            <a href="" class="btn btn_seeall">Xem tất cả</a>
                        </div>
                    </div>

                    <div class="box_list_new">
                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news56.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>

                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news6.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>

                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news7.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>

                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news8.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="element_news_large wow fadeInUp" data-wow-delay="200ms">
                    <div class="element_title">
                        <div class="title">
                            <span><img src="./assets/img/thanhnienvn.png" alt=""></span>
                            <h2><a href="" title="">HỘI LIÊN HIỆP THANH NIÊN VIỆT NAM THÀNH PHỐ</a></h2>
                        </div>

                        <div class="choose_seemore">
                            <a href="" class="btn btn_seeall">Xem tất cả</a>
                        </div>
                    </div>

                    <div class="box_list_new">
                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news9.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>

                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news6.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>

                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news7.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>

                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news8.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="element_news_large wow fadeInUp" data-wow-delay="200ms">
                    <div class="element_title">
                        <div class="title">
                            <span><img src="./assets/img/sinhvienvn.png" alt=""></span>
                            <h2><a href="" title="">HỘI SINH VIÊN VIỆT NAM THÀNH PHỐ</a></h2>
                        </div>

                        <div class="choose_seemore">
                            <a href="" class="btn btn_seeall">Xem tất cả</a>
                        </div>
                    </div>

                    <div class="box_list_new">
                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news10.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>

                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news6.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>

                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news7.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>

                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news8.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="element_news_large wow fadeInUp" data-wow-delay="200ms">
                    <div class="element_title">
                        <div class="title">
                            <span><img src="./assets/img/hoidongdoi.png" alt=""></span>
                            <h2><a href="" title="">HỘI ĐỒNG ĐỘI THÀNH PHỐ</a></h2>
                        </div>

                        <div class="choose_seemore">
                            <a href="" class="btn btn_seeall">Xem tất cả</a>
                        </div>
                    </div>

                    <div class="box_list_new">
                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news11.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>

                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news6.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>

                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news7.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>

                        <div class="news_item">
                            <a href="" title=""><img src="./assets/img/news8.png" alt=""></a>
                            <div class="content">
                                <h2><a href="" title="">Lễ trao tặng huân chương lao động hạng nhất cung văn hóa thiếu nhi thành phố</a></h2>
                                <p><a href="" title="">Tin chính trị - xã hội</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="element_news_large wow fadeInUp" data-wow-delay="200ms">
                    <div class="element_title">
                        <div class="title">
                            <span><img src="./assets/img/saovang.png" alt=""></span>
                            <h2><a href="" title="">VĂN BẢN</a></h2>
                        </div>

                        <div class="choose_seemore">
                            <a href= <?php echo URLROOT . "/van-ban-doan-hoi-dang.php" ?> class="btn btn_seeall">Xem tất cả</a>
                        </div>
                    </div>

                    <div class="element_content_tab">
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <table>
                                    <tr>
                                        <th>Số/Ký hiệu</th>
                                        <th>Ngày cập nhật</th>
                                        <th>Trích yếu</th>
                                    </tr>
                                    <?php
                                    // Lấy dữ liệu từ database
                                    $sql_query = "SELECT * FROM `vanban` ORDER BY `idvanban` DESC LIMIT 5";
                                    $result = mysqli_query($con, $sql_query);
                                
                                    // Hiển thị dữ liệu từ database
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['kyhieu']; ?></td>
                                            <td><?php echo $row['ngaycapnhat']; ?></td>
                                            <td>
                                                <p><?php echo $row['trichyeu']; ?></p>
                                                <a onclick="downloadFile('<?php echo $row['taixuong'];  ?>', '<?php echo $row['tenfile'];  ?>')" class="btn btn_download"></a>
                                            </td>
                                        </tr>
                                        <?php
                                    } ?>
                                </table>
                            </div>
                        </div>
                    </div>
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
</body>
<?php include('include/footer.php') ?>
</html>
<script>
    function downloadFile(fileUpload, fileName) {
        console.log(fileName);
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'index.php?fileupload=' + fileUpload + '&filename=' + fileName, true);
        xhr.responseType = 'blob';

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Tạo một đối tượng Blob từ dữ liệu nhận được
                var blob = new Blob([xhr.response], { type: 'application/octet-stream' });

                // Tạo một URL từ Blob và tạo một a element để tải xuống
                var downloadURL = window.URL.createObjectURL(blob);
                var link = document.createElement('a');
                link.href = downloadURL;
                link.download = 'tenfile.doc';

                // Thêm link vào trang và kích hoạt click để tải xuống
                document.body.appendChild(link);
                link.click();

                // Xóa link sau khi đã sử dụng
                document.body.removeChild(link);
            }
        };

        xhr.send();
    }
</script>

                        