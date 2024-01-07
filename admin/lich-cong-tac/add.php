<?php
	require_once '../../app/config/config.php';
	include_once '../include/top.php';

	if(isset($_POST['add'])) {
		$ngay = $_POST['ngay'];
		$gio = $_POST['gio'];
		$noidung = $_POST['noidung'];
		$diadiem = $_POST['diadiem'];
		$taixuong = $_POST['taixuong'];
		
		$sql = "insert into `lich-cong-tac`(ngay, gio, noidung, diadiem, taixuong) 
			values('$ngay', '$gio', '$noidung', '$diadiem', '$taixuong')";
		$qr = mysqli_query($con, $sql);

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
								<h2 class="p-3">Thêm lịch công tác</h2>
									<form class="row needs-validation" novalidate method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Nội dung</label>
												<input type="text" class="form-control" name="noidung" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Địa điểm</label>
												<input type="text" class="form-control" name="diadiem" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-3">
											<div class="item">
												<label for="validationCustom01" class="form-label">Ngày</label>
												<input type="date" class="form-control" name="ngay" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-3">
											<div class="item">
												<label for="validationCustom01" class="form-label">Giờ</label>
												<input type="time" class="form-control" name="gio" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Liên kết tải xuống</label>
												<input type="text" class="form-control" name="taixuong" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="item">
											<button class="btn btn-primary" name="add" type="submit">Thêm</button>
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

	function validateForm() {
		var file = document.getElementById("file-input").files[0];
		if (!file) {
			alert("Vui lòng chọn ảnh");
			return false;
		}

		var img = new Image();
		img.src = window.URL.createObjectURL(file);
		img.onload = function() {
			if (this.width === 0 || this.height === 0) {
				alert("Ảnh không hợp lệ");
				return false;
			}
			// Ảnh hợp lệ, submit form
			return true;
		};
	}

	// ẩn thẻ <img> khi không có ảnh được chọn
	document.getElementById('preview').style.display = 'none';
</script>
