<?php
	require_once '../../app/config/config.php';
	include_once '../include/top.php';

	if(isset($_POST['add'])) {
		$kyhieu = $_POST['kyhieu'];
		$ngaycapnhat = $_POST['ngaycapnhat'];
		$trichyeu = $_POST['trichyeu'];
		
		$fileName = null;
		$fileUpload = null;
		if (isset($_FILES["vanban"])) {
			$targetDir = '../../assets/vanban/upload/';
			if (!is_dir($targetDir)) {
				mkdir($targetDir, 0777, true);
			}
			$fileName = $_FILES["vanban"]["name"];
			$ext = pathinfo(basename($fileName), PATHINFO_EXTENSION);
			$fileUpload = time() . '.' . $ext;
			$targetFile = $targetDir . $fileUpload;
			move_uploaded_file($_FILES["vanban"]["tmp_name"], $targetFile);
		}

		$sql = "insert into `vanban`(kyhieu, ngaycapnhat, trichyeu, taixuong, tenfile) 
			values('$kyhieu', '$ngaycapnhat', '$trichyeu', '$fileUpload', '$fileName')";
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
								<h2 class="p-3">Thêm văn bản mới</h2>
									<form class="row needs-validation" novalidate method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
										<div class="col-md-12">
											<div class="item">
												<label for="validationCustom01" class="form-label">Trích yếu</label>
												<input type="text" class="form-control" name="trichyeu" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-3">
											<div class="item">
												<label for="validationCustom01" class="form-label">Ngày cập nhật</label>
												<input type="date" class="form-control" name="ngaycapnhat" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-3">
											<div class="item">
												<label for="validationCustom01" class="form-label">Ký hiệu</label>
												<input type="text" class="form-control" name="kyhieu" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Chọn file:</label>
												<input type="file" name="vanban" id="file" class="form-control" required onchange="updateFileName()" accept=".doc, .docx, .pdf">
												<div class="form-group">
													<input id="uploadButton" class="custom-upload-button upload-word" name="uploadButton" value="Tải lên" onclick="document.getElementById('file').click()">
												</div>
												<span style="color: red;" id="errorMessage"></span>
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

		var fileInput = document.getElementById('file');
		var errorMessage = document.getElementById('errorMessage');

		if (fileInput.files.length === 0) {
			errorMessage.textContent = 'Vui lòng chọn một file.';
			console.log(errorMessage.textContent);
			return false;
		}

		var allowedExtensions = ['.doc', '.docx', '.pdf'];
		var fileExtension = fileInput.files[0].name.split('.').pop().toLowerCase();

		if (allowedExtensions.indexOf('.' + fileExtension) === -1) {
			errorMessage.textContent = 'Chỉ được tải lên các file Word (.doc, .docx) hoặc PDF (.pdf).';
			console.log(errorMessage.textContent);
			return false;
		}

		// Nếu các điều kiện đều đúng, cho phép form submit
		errorMessage.textContent = ''; // Xóa thông báo lỗi nếu có
		return true;
	}


	function updateFileName() {
		var fileInput = document.getElementById('file');
		var buttonUpload = document.getElementById('uploadButton');

		if (fileInput.files.length > 0) {
			buttonUpload.value = fileInput.files[0].name;
		} else {
			buttonUpload.value = 'Tải lên';
		}
	}
</script>
