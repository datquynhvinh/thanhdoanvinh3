<div class="section_banner">
    <div class="img">
        <img src="./assets/img/tintuc.png" alt="">
    </div>
    <h2><span>TIN TỨC</span></h2>
</div>

<div class="section_breadcrumb">
    <div class="container container_width">
        <div class="row">
            <ul class="element_breadcrumb">
                <li><a href="<?php echo URLROOT ?>"><img src="./assets/img/homapgebreadcumb.png" alt="home"></a></li>
                <li><a href="<?php "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">Tin tức</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="section_content_width_sidebar wow fadeInUp" data-wow-delay="200ms">
    <div class="container">
        <div class="row">
            <div class="element_content_box">
                <div class="element_news_lagre wow fadeInUp" data-wow-delay="200ms">
                    <div class="element_title">
                        <div class="title">
                            <span><img src="./assets/img/saovang.png" alt=""></span>
                            <h2><a href="" title="">TIN MỚI</a></h2>
                        </div>
                    </div>
                </div>

                <div class="element_news_large wow fadeInUp" data-wow-delay="200ms">
                    <div class="box_list_new">
                        <?php
                                $sql_tintuc = 
                                        "SELECT news.id, news.image, news.title, news.url, categories.cate_name, categories.cate_url, news.content 
                                        FROM news 
                                        INNER JOIN categories 
                                        ON news.category_id = categories.id
                                        ORDER BY news.id DESC
                                        LIMIT 4";
                                $result = mysqli_query($con, $sql_tintuc);

                                while($row = mysqli_fetch_assoc($result)) {?>
                                <div class="news_item">
                                    <a href="<?php echo URLROOT . '/' . $row['url']; ?>"><img src="<?php echo URLROOT . TIN_TUC_UPLOAD_DIR . $row['image']; ?>"></a>
                                    <div class="content">
                                        <h2><a href="<?php echo URLROOT . '/' . $row['url']; ?>"><?php echo $row['title'];?></a></h2>
                                        <p><a href="<?php echo URLROOT . '/luu-tru-tin-tuc.php?slug=' . $row['cate_url']; ?>"><?php echo $row['cate_name'];?></a></p>
                                    </div>
                                </div>
                            <?php
                        } ?>
                    </div>
                </div>

                <?php
                $sql_categories = "SELECT * FROM categories";
                $result_categories = $con->query($sql_categories);
                
                while ($category = $result_categories->fetch_assoc()) {
                    $category_id = $category['id'];
                    $category_name = $category['cate_name'];
                    $category_url = $category['cate_url'];
                
                    $sql_news = "SELECT news.id, news.image, news.title, news.url 
                                FROM news 
                                WHERE news.category_id = $category_id 
                                ORDER BY news.id DESC 
                                LIMIT 4";
                
                    $result_news = $con->query($sql_news);
                
                    if ($result_news->num_rows > 0) {
                        ?>
                        <div class="element_news_large wow fadeInUp" data-wow-delay="200ms">
                            <div class="element_title">
                                <div class="title">
                                    <h2><a href="<?php echo URLROOT . '/luu-tru-tin-tuc.php?slug=' . $category_url; ?>"><?php echo $category_name; ?></a></h2>
                                </div>
                                <div class="choose_seemore">
                                    <a href="<?php echo URLROOT . '/luu-tru-tin-tuc.php?slug=' . $category_url; ?>" class="btn btn_seeall">Xem tất cả</a>
                                </div>
                            </div>
                            <div class="box_list_new">
                                <?php while ($news = $result_news->fetch_assoc()) : ?>
                                    <div class="news_item">
                                        <a href="<?php echo URLROOT . '/' . $news['url']; ?>"><img src="<?php echo URLROOT . TIN_TUC_UPLOAD_DIR . $news['image']; ?>"></a>
                                        <div class="content">
                                            <h2><a href="<?php echo URLROOT . '/' . $news['url']; ?>"><?php echo $news['title']; ?></a></h2>
                                            <p><a href="<?php echo URLROOT . '/luu-tru-tin-tuc.php?slug=' . $category_url; ?>"><?php echo $category_name; ?></a></p>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="element_news_large wow fadeInUp" data-wow-delay="200ms">
                    <div class="element_title">
                        <div class="title">
                            <span><img src="./assets/img/saovang.png" alt=""></span>
                            <h2><a href="" title="">VĂN BẢN</a></h2>
                        </div>

                        <div class="choose_seemore">

                            <a href="https://congnghephanmem.online/van-ban-doan-hoi-dang.php" class="btn btn_seeall">Xem tất cả</a>
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
                                    <tr>
                                        <td>247-TB/TĐTN-BTC</td>
                                        <td>2020-09-25</td>
                                        <td>
                                            <p>Thông báo kết quả xét tuyển viên chức Cơ sở cai nghiện ma túy Gia Minh năm 2020</p>
                                            <a href="" title="" class="btn btn_download"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>247-TB/TĐTN-BTC</td>
                                        <td>2020-09-25</td>
                                        <td>
                                            <p>Thông báo kết quả xét tuyển viên chức Cơ sở cai nghiện ma túy Gia Minh năm 2020</p>
                                            <a href="" title="" class="btn btn_download"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>247-TB/TĐTN-BTC</td>
                                        <td>2020-09-25</td>
                                        <td>
                                            <p>Thông báo kết quả xét tuyển viên chức Cơ sở cai nghiện ma túy Gia Minh năm 2020</p>
                                            <a href="" title="" class="btn btn_download"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>247-TB/TĐTN-BTC</td>
                                        <td>2020-09-25</td>
                                        <td>
                                            <p>Thông báo kết quả xét tuyển viên chức Cơ sở cai nghiện ma túy Gia Minh năm 2020</p>
                                            <a href="" title="" class="btn btn_download"></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <table>
                                    <tr>
                                        <th>Số/Ký hiệu</th>
                                        <th>Ngày cập nhật</th>
                                        <th>Trích yếu</th>
                                    </tr>
                                    <tr>
                                        <td>247-TB/TĐTN-BTC</td>
                                        <td>2020-09-25</td>
                                        <td>
                                            <p>Thông báo kết quả xét tuyển viên chức Cơ sở cai nghiện ma túy Gia Minh năm 2020</p>
                                            <a href="" title="" class="btn btn_download"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>247-TB/TĐTN-BTC</td>
                                        <td>2020-09-25</td>
                                        <td>
                                            <p>Thông báo kết quả xét tuyển viên chức Cơ sở cai nghiện ma túy Gia Minh năm 2020</p>
                                            <a href="" title="" class="btn btn_download"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>247-TB/TĐTN-BTC</td>
                                        <td>2020-09-25</td>
                                        <td>
                                            <p>Thông báo kết quả xét tuyển viên chức Cơ sở cai nghiện ma túy Gia Minh năm 2020</p>
                                            <a href="" title="" class="btn btn_download"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>247-TB/TĐTN-BTC</td>
                                        <td>2020-09-25</td>
                                        <td>
                                            <p>Thông báo kết quả xét tuyển viên chức Cơ sở cai nghiện ma túy Gia Minh năm 2020</p>
                                            <a href="" title="" class="btn btn_download"></a>
                                        </td>
                                    </tr>
                                    
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