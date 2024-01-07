<div class="section_banner">
    <div class="img">
        <img src="./assets/img/thuvien.png" alt="">
    </div>
    <h2><span>THƯ VIỆN</span></h2>
</div>

<div class="bg_color">
    <div class="section_content_width_sidebar bg_color wow fadeInUp" data-wow-delay="200ms">
        <div class="container">
            <div class="row">
                <div class="element_content_box element_content_box_color">
                    <ul class="element_breadcrumb">
                        <li><a href="https://congnghephanmem.online/"><img src="./assets/img/homapgebreadcumb.png" alt="home"></a></li>
                        <li><a href="<?php "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">Sổ tay Đoàn - Đội</a></li>
                    </ul>

                    <div class="title_file">
                        <h2>Tài liệu tham khảo</h2>
                    </div>

                    <div class="lement_file_download">
                        <?php
                            $records_per_page = 15;
                            $total_records = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `sotay`"));
                            $total_pages = ceil($total_records / $records_per_page);
                        
                            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                                $current_page = $_GET['page'];
                            } else {
                                $current_page = 1;
                            }
                        
                            if ($current_page > $total_pages) {
                                $current_page = $total_pages;
                            }
                        
                            if ($current_page < 1) {
                                $current_page = 1;
                            }
                        
                            $start_record = ($current_page - 1) * $records_per_page;
                            $sql_sotay = mysqli_query($con, "SELECT * FROM `sotay` ORDER BY `idSoTay` DESC LIMIT $start_record, $records_per_page");
                        
                            if (mysqli_num_rows($sql_sotay) > 0) {
                                $i = 1;
                                while ($row = mysqli_fetch_array($sql_sotay)) {
                                    ?>
                                    <div class="item">
                                        <span><?php echo $i++; ?></span>
                                        <p><?php echo $row['tenSoTay']; ?></p>
                                        <a href="<?php echo $row['linkDownload']; ?>" class="btn btn_file_download"></a>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "Không có dữ liệu để hiển thị";
                            }
                        
                            if ($total_pages > 1) {
                                ?>
                                <div class="pagination_clean">
                                    <ul>
                                        <?php
                                        if ($current_page > 1) {
                                            ?>
                                            <li class="">
                                                <a href="?page=<?php echo $current_page - 1; ?>" title=""> &lt; </a>
                                            </li>
                                            <?php
                                        }
                        
                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            if ($i == $current_page) {
                                                ?>
                                                <li class="active-pagination">
                                                    <a href="?page=<?php echo $i; ?>" title=""> <?php echo $i; ?> </a>
                                                </li>
                                                <?php
                                            } else {
                                                ?>
                                                <li class="">
                                                    <a href="?page=<?php echo $i; ?>" title=""> <?php echo $i; ?> </a>
                                                </li>
                                                <?php
                                            }
                                        }
                        
                                        if ($current_page < $total_pages) {
                                            ?>
                                            <li class="active-next">
                                                <a href="?page=<?php echo $current_page + 1; ?>" title=""> &gt; </a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <?php
                            }
                        ?>
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
</div>



<footer>
    <div class="section_footer_pc">
        <div class="container">
            <div class="row">
                <div class="footer">
                    <div class="img">
                        <img src="./assets/img/logo_footer.png" alt="">
                    </div>
                </div>

                <div class="footer">
                    <h3>ĐOÀN THANH NIÊN CỘNG SẢN THÀNH PHỐ HẢI PHÒNG</h3>
                    <ul>
                        <li>
                            <span><img src="./assets/img/img1.png" alt=""></span>Số 22 Trần Hưng Đạo, Hồng Bàng, Hải Phòng
                        </li>
                        <li>
                            <span><img src="./assets/img/img2.png" alt=""></span>02253.745.001
                        </li>
                        <li>
                            <span><img src="./assets/img/img3.png" alt=""></span>thanhdoanhaiphong@gmail.com
                        </li>
                    </ul>
                </div>

                <div class="footer">
                    <h3>THÔNG TIN</h3>
                    <ul>
                        <li>
                            <a href="" title="">Giới thiệu</a>
                        </li>
                        <li>
                            <a href="" title="">Tin tức</a>
                        </li>
                        <li>
                            <a href="" title="">Liên hệ</a>
                        </li>
                    </ul>
                </div>

                <div class="footer">
                    <h3>THỐNG KÊ TRUY CẬP</h3>
                    <ul>
                        <li>
                            Tổng số lượt truy cập: 123456
                        </li>
                        <li>
                            Đang truy cập: 05
                        </li>
                        <li>
                            Lượt ghé thăm trong ngày: 120
                        </li>
                    </ul>
                </div>

                <div class="footer">
                    <p>@2020 Bản quyền thuộc Đoàn TNCS Hồ Chí Minh thành phố Hải Phòng</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="icon_allpage">
    <a href="#" class="icon_backtotop" title="" style="display: block;"> <img src="./assets/img/41.png"> </a>
</div>

<script src="./assets/fancybox/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="./assets/js/wow.min.js"></script>
<script type="text/javascript" src="./assets/js/custrom-tr.js"></script>

</body>
</html>


                        