<?php
	require_once '../../app/config/config.php';
	include_once('../include/top.php');
	
	$id = $_GET['id'];
	$sql = "SELECT * FROM users WHERE id = $id";
	$qr = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($qr);

	if(isset($_POST['update'])) {
		$firstName = $_POST['firstname'];
		$lastName = $_POST['lastname'];
		$phone = $_POST['phone'];
		$gender = $_POST['gender'];
		$isActive = $_POST['is_active'];
		$address = $_POST['address'];
		$role = $_POST['role'];

		$sql = "update users set firstname ='$firstName', lastname = '$lastName', phone = '$phone', gender = '$gender', is_active = '$isActive', address = '$address', role = '$role' where id = $id";
		$qr = mysqli_query($con, $sql);
		if ($qr) {
			$oldImage = $targetDir . $row["image"];
			if (file_exists($oldImage)) {
				unlink($oldImage);
			}

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
								<h2 class="p-3">Chỉnh sửa người dùng</h2>
									<form class="row needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Họ</label>
												<input value="<?php echo $row['firstname'] ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="firstname" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Tên</label>
												<input value="<?php echo $row['lastname'] ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="lastname" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Số điện thoại</label>
												<input value="<?php echo $row['phone'] ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="phone" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Email</label>
												<input value="<?php echo $row['email'] ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="email" required disabled>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="item">
												<label for="validationCustom01" class="form-label">Giới tính</label>
												<select class="form-select" name="gender">
													<option value="Nam" <?php echo ($row['gender'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
													<option value="Nữ" <?php echo ($row['gender'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="item">
												<label for="validationCustom01" class="form-label">Chức vụ</label>
												<select class="form-select" name="role">
													<option value="admin" <?php echo ($row['role'] == 'admin') ? 'selected' : '' ?>>Quản trị viên</option>
													<option value="member" <?php echo ($row['role'] == 'member') ? 'selected' : '' ?>>Thành viên</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="item">
												<label for="validationCustom01" class="form-label">Trạng thái</label>
												<select class="form-select" name="is_active">
													<option value="1" <?php echo ($row['is_active'] == '1') ? 'selected' : '' ?>>Kích hoạt</option>
													<option value="0" <?php echo ($row['is_active'] == '0') ? 'selected' : '' ?>>Chưa kích hoạt</option>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="item">
												<label for="validationCustom01" class="form-label">Địa chỉ</label>
												<input value="<?php echo $row['address'] ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="address" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="item">
											<button class="btn btn-primary" name="update" type="submit">Sửa</button>
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
 