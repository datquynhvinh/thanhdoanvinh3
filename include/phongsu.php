<div class="section_banner">
    <div class="img">
        <img src="./assets/img/phongsu.png" alt="">
    </div>
    <h2><span>Phóng sự</span></h2>
</div>

<div class="section_breadcrumb">
    <div class="container container_width">
        <div class="row">
            <ul class="element_breadcrumb">
                <li><a href="<?php echo URLROOT ?>"><img src="./assets/img/homapgebreadcumb.png" alt="home"></a></li>
                <li><a href="<?php "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">Phóng sự</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="section_content_width_sidebar wow fadeInUp" data-wow-delay="200ms">
    <div class="container">
        <div class="row">
            <div class="element_content_box">
                <div class="element_news_lagre wow fadeInUp" data-wow-delay="200ms">
                    <div class="list_grid_video">
                        <?php
                            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $records_per_page = 9;
                            $offset = ($current_page - 1) * $records_per_page;
                            
                            $query = "SELECT phongsu.*, categories.cate_name FROM phongsu
                                      INNER JOIN categories ON phongsu.categoriesps_id = categories.id
                                      ORDER BY phongsu.dateps DESC
                                      LIMIT $offset, $records_per_page";
                            $result = mysqli_query($con, $query);
                            
                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $urlthumbps = $row['ulrthumbps'];
                                        $urlvideops = $row['urlvideops'];
                                        $titleps = $row['titleps'];
                                        $cate_name = $row['cate_name'];
                                        $dateps = $row['dateps'];
                            
                                        ?>
                                        <div class="col-md-4 gird_video_item">
                                            <div class="img">
                                                <img src="<?php echo URLROOT . TIN_TUC_UPLOAD_DIR . $urlthumbps; ?>">
                                                <a data-fancybox="gallery" href="<?php echo $urlvideops; ?>">
                                                    <span>
                                                        <div class="ping ring circle">
                                                        </div>
                                                        <img src="./assets/img/149.png" alt="">
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="tex">
                                                <h3><?php echo $titleps; ?></h3>
                                                <div class="date-dervice">
                                                    <p class="category_video"><?php echo $cate_name; ?></p>
                                                    <div class="date">
                                                        <p><?php echo $dateps; ?></p>
                                                    </div>
                                                    <a data-fancybox="gallery" href="<?php echo $urlvideops; ?>">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo "Không tìm thấy kết quả.";
                                }
                            
                                $total_pages_query = "SELECT COUNT(*) AS total FROM phongsu";
                                $total_pages_result = mysqli_query($con, $total_pages_query);
                                $total_pages_row = mysqli_fetch_assoc($total_pages_result);
                                $total_pages = ceil($total_pages_row['total'] / $records_per_page); ?>
                                
                                <?php }
                                	if ($total_pages > 1) {
                                		?>
                                		<div class="pagination_clean">
                                			<ul>
                                				<?php
                                				if ($current_page > 1) {
                                					?>
                                					<li class="previous">
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
                                					<li class="next">
                                						<a href="?page=<?php echo $current_page + 1; ?>" title=""> &gt; </a>
                                					</li>
                                					<?php
                                				}
                                				?>
                                			</ul>
                                		</div>
                                		<?php
                            } else {
                                echo "Lỗi truy vấn: " . mysqli_error($con);
                            }
                         ?>
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

                        