<?php
	session_start();
	require_once 'app/config/config.php';
	include_once('app/db/connect.php');
	include('include/menu.php');
 ?>

<div class="section_header">
    <div class="header_pc">
        <?php
	        include('include/vanban.php');
	   ?>
    </div>
</div>
<?php include('include/footer.php'); ?>
</body>
</html>