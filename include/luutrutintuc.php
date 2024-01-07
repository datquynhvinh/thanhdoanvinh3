<?php
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $perPage = 10;
    $offset = ($page - 1) * $perPage;
    $sql_news = "SELECT * FROM news ORDER BY id DESC LIMIT $offset, $perPage";
    $slug = $_GET['slug'];
    
    $sql_category = "SELECT * FROM categories WHERE cate_url = '$slug'";
    $result_category = mysqli_query($con, $sql_category);
    $category = mysqli_fetch_assoc($result_category);
    
    if ($category) {
        $category_id = $category['id'];
        $category_name = $category['cate_name'];
    
        $sql_news = "SELECT * FROM news WHERE category_id = $category_id ORDER BY id DESC";
        $result_news = mysqli_query($con, $sql_news);
?>
<div class="section_banner">
    <div class="img">
        <img src="./assets/img/moingay.png" alt="">
    </div>
    <h2><span><?php echo $category_name; ?></span></h2>
</div>

<div class="section_content_width_sidebar section_page_7 wow fadeInUp" data-wow-delay="200ms">
    <div class="container">
        <div class="row">
            <div class="element_content_box">
                <ul class="element_breadcrumb">
                    <li><a href="<?php echo URLROOT ?>"><img src="./assets/img/homapgebreadcumb.png" alt="home"></a></li>
                    <li><a href="<?php echo URLROOT . '/luu-tru-tin-tuc.php?slug=' . $category['cate_url']; ?>"><?php echo $category_name; ?></a></li>
                </ul>

                <div class="list_new_item">
                    <?php
                        if (mysqli_num_rows($result_news) > 0) {
                            while ($news = mysqli_fetch_assoc($result_news)) {
                                ?>
                                <div class="news_item">
                                    <a href="<?php echo URLROOT . '/' . $news['url']; ?>"><img src="<?php echo URLROOT . TIN_TUC_UPLOAD_DIR . $news['image']; ?>" alt=""></a>
                                    <div class="content">
                                        <h2><a href="<?php echo URLROOT .  '/' . $news['url']; ?>"><?php echo $news['title']; ?></a></h2>
                                        <?php
                                            $content = $news['content'];
                                            $words = explode(' ', $content);
                                            $limitedWords = array_slice($words, 0, 50);
                                            $limitedContent = implode(' ', $limitedWords);
                                            if (count($words) > 50) {
                                                $limitedContent .= '...';
                                            }
                                            $limitedContent = strip_tags($limitedContent);
                                        ?>
                                        <p><?php echo $limitedContent; ?></p>
                                        <p><a href="<?php echo URLROOT . '/luu-tru-tin-tuc.php?slug=' . $category['cate_url']; ?>"><?php echo $category_name; ?></a></p>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo 'Không có bài viết trong danh mục này.';
                        }
                    } else {
                        echo 'Danh mục không tồn tại.';
                    }
                ?>
                    <div class="pagination_clean">
                        <ul>
                            <?php
                            $totalNews = mysqli_num_rows($result_news);
                            $totalPages = ceil($totalNews / 10); // Số trang cần tạo, mỗi trang có 10 bài viết
                    
                            for ($i = 1; $i <= $totalPages; $i++) {
                                $activeClass = ($i == 1) ? 'active-pagination' : '';
                                echo '<li class="' . $activeClass . '"><a href="?slug=' . $slug . '&page=' . $i . '" title="">' . $i . '</a></li>';
                            }
                            ?>
                            <li class="active-next"> <a href="" title=""> <img src="./assets/img/pagination-icon.png" alt=""> </a> </li>
                        </ul>
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