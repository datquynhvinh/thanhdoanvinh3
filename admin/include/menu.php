<div class="app-sidebar sidebar-custom">
    <div class="app-menu">
        <ul class="accordion-menu">
            <li class="sidebar-title">
                Chức năng
            </li>
            <?php if (isAdmin()) { ?>
                <li>
                    <a href="<?php echo URLROOT; ?>/admin/nguoi-dung/"><i class="fas fa-solid fa-user"></i>Quản lý người dùng</a>
                </li>
            <?php } ?>
            <li>
                <a href="<?php echo URLROOT; ?>/admin/menu/"><i class="fas fa-compass"></i>Menu</a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/admin/lich-cong-tac/"><i class="far fa-calendar"></i>Lịch công tác</a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/admin/van-ban/"><i class="far fa-file-word"></i>Văn bản Đoàn - Hội - Đảng</a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/admin/so-tay/"><i class="fas fa-bookmark"></i>Sổ tay Đoàn - Đội</a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/admin/phong-su/"><i class="fas fa-video"></i>Phóng sự</a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/admin/danh-muc/"><i class="fas fa-list"></i>Danh mục</a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/admin/tin-tuc/"><i class="far fa-newspaper"></i>Tin tức</a>
            </li>
        </ul>
    </div>
</div>