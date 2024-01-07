<?php
	require_once '../../app/config/config.php';
	include_once('../include/top.php');
	
	$id = $_GET['id'];
	$sql = "SELECT * FROM `vanban` WHERE idvanban = $id";
	$qr = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($qr);

	if(isset($_POST['add'])) {
		$kyhieu = $_POST['kyhieu'];
		$ngaycapnhat = $_POST['ngaycapnhat'];
		$trichyeu = $_POST['trichyeu'];
		$taixuong = $_POST['taixuong'];
		
		$sql_update = "update `vanban` set kyhieu ='$kyhieu', ngaycapnhat = '$ngaycapnhat', trichyeu = '$trichyeu', taixuong = '$taixuong' where idvanban = $id";
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
									<h2 class"p-3">Chỉnh sửa thông tin văn bản</h2>
									<form class="row needs-validation" novalidate method="POST" action="" enctype="multipart/form-data"><div class="col-md-12">
											<div class="item">
												<label for="validationCustom01" class="form-label">Trích yếu</label>
												<input value="<?php echo $row['trichyeu'] ?>" type="text" class="form-control" name="trichyeu" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-3">
											<div class="item">
												<label for="validationCustom01" class="form-label">Ngày cập nhật</label>
												<input value="<?php echo $row['ngaycapnhat'] ?>" type="date" class="form-control" name="ngaycapnhat" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-3">
											<div class="item">
												<label for="validationCustom01" class="form-label">Ký hiệu</label>
												<input value="<?php echo $row['kyhieu'] ?>" type="text" class="form-control" name="kyhieu" required>
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
 