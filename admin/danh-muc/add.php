<?php
	require_once '../../app/config/config.php';
	include_once '../include/top.php';

	if(isset($_POST['add'])) {
		$cate_name = $_POST['cate_name'];
		$cate_url = $_POST['cate_url'];
		$description = $_POST['description'];
		
		$sql = "insert into `categories`(cate_name, cate_url, description) 
			values('$cate_name', '$cate_url', '$description')";
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
												<label for="validationCustom01" class="form-label">Tên danh mục</label>
												<input type="text" class="form-control" name="cate_name" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Đường dẫn tới danh mục</label>
												<input type="text" class="form-control" name="cate_url" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-12">
											<div class="item">
												<label for="validationCustom01" class="form-label">Mô tả danh mục</label>
												<input type="text" class="form-control" name="description" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="item">
											<button class="btn btn-primary" name="add" type="submit">Thêm danh mục</button>
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
