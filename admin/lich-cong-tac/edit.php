<?php
	require_once '../../app/config/config.php';
	include_once('../include/top.php');
	
	$id = $_GET['id'];
	$sql = "SELECT * FROM `lich-cong-tac`
	        WHERE id = $id";
	$qr = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($qr);

	if(isset($_POST['add'])) {
		$ngay = $_POST['ngay'];
		$gio = $_POST['gio'];
		$noidung = $_POST['noidung'];
		$diadiem = $_POST['diadiem'];
		$taixuong = $_POST['taixuong'];
		
		$sql_update = "update `lich-cong-tac` set ngay ='$ngay', gio = '$gio', noidung = '$noidung', diadiem = '$diadiem', taixuong = '$taixuong' where id = $id";
		$qr = mysqli_query($con, $sql_update);

		if ($qr) {
            echo "<script>window.location.href='index.php';</script>";
            exit;
        }
	}

?>
    <div class="app-container">
        <div class="app-content">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
									<h2 class"p-3">Chỉnh sửa tin tức</h2>
									<form class="row needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Nội dung</label>
												<input value="<?php echo $row['noidung'] ?>" type="text" class="form-control" name="noidung" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Địa điểm</label>
												<input value="<?php echo $row['diadiem'] ?>" type="text" class="form-control" name="diadiem" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-3">
											<div class="item">
												<label for="validationCustom01" class="form-label">Ngày</label>
												<input value="<?php echo $row['ngay'] ?>" type="date" class="form-control" name="ngay" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
                                        <div class="col-md-3">
                                            <div class="item">
                                                <label for="validationCustom01" class="form-label">Giờ</label>
                                                <?php
                                                    $php_time = $row['gio'];
                                                    $datetime = new DateTime($php_time);
                                                    $html_time = $datetime->format('H:i');
                                                ?>
                                                <input value="<?php echo $html_time ?>" type="time" class="form-control" name="gio" required>
                                                <div class="invalid-feedback">
                                                    Không được để trống phần này
                                                </div>
                                            </div>
                                        </div>
										
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Liên kết tải xuống</label>
												<input value="<?php echo $row['taixuong'] ?>" type="text" class="form-control" name="taixuong" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="item">
											    <button class="btn btn-primary" name="add" type="submit">Sửa</button>
											</div>
										</div>
									</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <script>
    	// Example starter JavaScript for disabling form submissions if there are invalid fields
		(() => {
		  'use strict'

		  // Fetch all the forms we want to apply custom Bootstrap validation styles to
		  const forms = document.querySelectorAll('.needs-validation')

		  // Loop over them and prevent submission
		  Array.from(forms).forEach(form => {
		    form.addEventListener('submit', event => {
		      if (!form.checkValidity()) {
		        event.preventDefault()
		        event.stopPropagation()
		      }
		      form.classList.add('was-validated')
		    }, false)
		  })
		})()
		
	</script>
 