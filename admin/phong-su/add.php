<?php
	require_once '../../app/config/config.php';
	include_once '../include/top.php';

	if(isset($_POST['add'])) {
		$titleps = $_POST['titleps'];
		$categoriesps_id = $_POST['categoriesps_id'];
		$urlvideops = $_POST['urlvideops'];
		$dateps = $_POST['dateps'];
		$fileName = null;

		if (isset($_FILES["ulrthumbps"])) {
			$targetDir = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/tintuc/';
			if (!is_dir($targetDir)) {
				mkdir($targetDir, 0777, true);
			}

			$ext = pathinfo(basename($_FILES["ulrthumbps"]["name"]), PATHINFO_EXTENSION);
			$fileName = time() . '.' . $ext;
			$targetFile = $targetDir . $fileName;
			move_uploaded_file($_FILES["ulrthumbps"]["tmp_name"], $targetFile);
		}

		$sql = "insert into phongsu(titleps, urlvideops, dateps, ulrthumbps, categoriesps_id) 
			values('$titleps', '$urlvideops', '$dateps', '$fileName', '$categoriesps_id')";
		$qr = mysqli_query($con, $sql);

		if ($qr) {
            echo "<script>window.location.href='index.php';</script>";
            exit;
        }
	}

 ?>

<style>
	.file-label {
		display: inline-block;
		padding: 10px;
		background-color: #f0f0f0;
		border: 2px solid #ccc;
		border-radius: 4px;
		cursor: pointer;
	}
	
	.file-input {
		display: none;
	}
	
	.btn-upload {
		background-color: #4CAF50;
		border: none;
		color: white;
		padding: 12px 24px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		border-radius: 4px;
		cursor: pointer;
		margin-left: 10px;
	}
	
	.btn-upload:hover {
		background-color: #3e8e41;
	}
</style>
 <div class="app-container">
	<div class="app-content">
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<div class="card">
							<div class="card-body">
								<h2 class="p-3">Thêm phóng sự</h2>
									<form class="row needs-validation" novalidate method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Tiêu đề</label>
												<input type="text" class="form-control" name="titleps" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Link video</label>
												<input type="text" class="form-control" name="urlvideops" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Danh mục</label>
												<select class="form-select" name="categoriesps_id">
													<?php
													// Lấy danh sách các danh mục
													$sql2 = "SELECT id, cate_name FROM categories";
													$result2 = mysqli_query($con, $sql2);
												
													// Hiển thị các option
													while ($row2 = mysqli_fetch_assoc($result2)) {
														echo "<option value='".$row2['id']."'>".$row2['cate_name']."</option>";
													}
													?>
												</select>
											</div>
										</div>
										
											
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Ngày diễn ra</label>
												<input type="date" class="form-control" name="dateps" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>

										<div class="col-md-12">
											<div class="item">
												<label for="validationCustom01" class="form-label">Ảnh</label>
												<div>
													<input class="custom-upload-button" value="Chọn ảnh" onclick="document.getElementById('file-input').click()" readonly />
													<input type="file" id="file-input" onchange="previewImage(event)" name="ulrthumbps" />
													<div class="invalid-feedback">
														Không được để trống phần này
													</div>
													<img id="preview" src="#" alt="Ảnh xem trước">
												</div>
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
	
	function previewImage(event) {
		var reader = new FileReader();
		reader.onload = function(){
			var output = document.getElementById('preview');
			output.src = reader.result;
			output.style.display = 'block'; // hiển thị thẻ <img>
		};
		reader.readAsDataURL(event.target.files[0]);
	}

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
