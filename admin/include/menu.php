<div class="app-sidebar sidebar-custom">
    <div class="app-menu">
        <?php if (isAdmin()) { ?>
            <ul class="accordion-menu">
                <li class="sidebar-title">
                    Chức năng
                </li>
                <li>
                    <a href="<?php echo URLROOT; ?>/admin/dashboard"><i class="fas fa-grip-horizontal"></i>Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo URLROOT; ?>/admin/nguoi-dung/"><i class="fas fa-solid fa-user"></i>Quản lý người dùng</a>
                </li>
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
        <?php } ?>
        <?php if (isMember()) { ?>
            <ul class="accordion-menu">
                <li class="sidebar-title">
                    Chức năng
                </li>
                <li>
                    <a href="<?php echo URLROOT; ?>/admin/dashboard"><i class="fas fa-grip-horizontal"></i>Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo URLROOT; ?>/admin/nguoi-dung/"><i class="fas fa-solid fa-user"></i>Quản lý người dùng</a>
                </li>
            </ul>
        <?php } ?>
    </div>
</div>