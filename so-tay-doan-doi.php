<?php
	session_start();
	include_once('db/connect.php');
	include('include/menu.php');
 ?>
<div class="section_header">
    <div class="header_pc">
        <?php
	        include('include/sotaydoanhoidang.php');
	   ?>
    </div>
</div>
<?php include('include/footer.php'); ?>
</body>
</html>