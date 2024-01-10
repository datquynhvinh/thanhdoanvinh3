<?php
	require_once '../../app/config/config.php';
	include_once('../include/top.php');

	// Check for post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
			"firstname" => trim($_POST["firstname"]),
			"lastname" => trim($_POST["lastname"]),
			"email" => strtolower(trim($_POST["email"])),
			"password" => trim($_POST["password"]),
			"confirm_password" => trim($_POST["confirm_password"]),
			"gender" => trim($_POST["gender"]),
			"phone" => trim($_POST["phone"]),
			"address" => trim($_POST["address"]),
			"role" => trim($_POST["role"]),
			"is_active" => trim($_POST["is_active"]),
			"firstname_err" => "",  
			"lastname_err" => "",  
			"email_err" => "",  
			"password_err" => "",  
			"confirm_password_err" => "",  
			"phone_err" => "",  
			"address_err" => "",  
		];

        // Check if no error occured
        $validated = true;

        // pattern
        $emailPattern = '/^[a-z0-9]{6,64}@[a-z0-9]{1,2}[a-z0-9\.]{1,127}(\.[a-z]{2,4})$/i';
        $namePattern = '/^[^0-9\[\]`!@#$%^&*()_+\\{}|;\':\",.\/<>?]*$/';
        $addressPattern = "/[^0-9\[\]`!@#$%^&*()_+\\{}|;\':\",.\/<>?]*$/";
        $phonePattern = "/^0[1-9][0-9]{8}$/";

        // Validate email
        if (empty($data["email"])) {
            $data["email_err"] = "Hãy nhập địa chỉ email";
            $validated = false;
        } elseif (!empty($data['email'])) {
            $email = $data['email'];
            $query = "SELECT * FROM users WHERE email='{$email}'";
            $result = mysqli_query($con, $query);
            if (mysqli_fetch_assoc($result)) {
                $data["email_err"] = "Email đã tồn tại";
                $validated = false;
            }
        } else {
            if (!preg_match($emailPattern, $data["email"])) {
                $data["email_err"] = "Email không hợp lệ";
                $validated = false;
            }
        }

        // Validate name
        if (empty($data["firstname"])) {
            $data["firstname_err"] = "Hãy nhập họ";
            $validated = false;
        } else {
            if (!preg_match($namePattern, $data["firstname"])) {
                $data["firstname_err"] = "Họ không được chứa ký tự đặc biệt hoặc chữ số";
                $validated = false;
            }
        }

        if (empty($data["lastname"])) {
            $data["lastname_err"] = "Hãy nhập tên";
            $validated = false;
        } else {
            if (!preg_match($namePattern, $data["lastname"])) {
                $data["lastname_err"] = "Tên không được chứa ký tự đặc biệt hoặc chữ số";
                $validated = false;
            }
        }

        // Validate password
        if (empty($data["password"])) {
            $data["password_err"] = "Xin vui lòng nhập mật khẩu";
            $validated = false;
        } elseif (strlen($data["password"]) < 6) {
            $data["password_err"] = "Mật khẩu phải có ít nhất 6 ký tự";
            $validated = false;
        }

        // Validate confirm_password
        if (empty($data["confirm_password"])) {
            $data["confirm_password_err"] = "Vui lòng nhập lại mật khẩu của bạn";
            $validated = false;
        } elseif ($data["password"] != $data["confirm_password"]) {
            $data["confirm_password_err"] = "Mật khẩu không khớp";
            $validated = false;
        }

        // Validate phone
        if (empty($data["phone"])) {
            $data["phone_err"] = "Vui lòng nhập số điện thoại của bạn";
            $validated = false;
        } else {
            if (!preg_match($phonePattern, $data["phone"])) {
                $data["phone_err"] = "Số điện thoại không hợp lệ";
                $validated = false;
            }
        }

        // Validate address
        if (empty($data["address"])) {
            $data["address_err"] = "Vui lòng nhập địa chỉ của bạn";
            $validated = false;
        } else {
            if (!preg_match($addressPattern, $data["address"])) {
                $data["address_err"] = "Địa chỉ không hợp lệ";
                $validated = false;
            }
        }

        // Make sure no error occured
        if ($validated) {
            // Hash password
            $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);

            // Register user
            $sqlInsert = "INSERT INTO users(firstname, lastname, email, password, gender, phone, address, role, is_active) 
                VALUES('" . $data['firstname'] . "', '" . $data['lastname'] . "', '" . $data['email'] . "', '"
                . $data['password'] . "', '" . $data['gender'] . "', '" . $data['phone'] . "', '" . $data['address'] . "', '" . $data['role'] . "', '" . $data['is_active'] . "')";
            $insertResult = mysqli_query($con, $sqlInsert);

            if ($insertResult) {
                redirect("admin/nguoi-dung/");
            } else {
                die("Có lỗi xảy ra, vui lòng thử lại!");
            }
        }
    } else {
        // Init data
        $data = [
			"firstname" => "",
			"lastname" => "",
			"email" => "",
			"password" => "",
			"confirm_password" => "",
			"gender" => "Nam",
			"phone" => "",
			"address" => "",
			"role" => "member",
			"is_active" => "1",
			"firstname_err" => "",  
			"lastname_err" => "",  
			"email_err" => "",  
			"password_err" => "",  
			"confirm_password_err" => "",  
			"phone_err" => "",  
			"address_err" => "",  
		];
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
								<h2 class="p-3">Thêm người dùng</h2>
									<form class="row needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Họ<span class="text-danger small font-weight-bold">*</span></label>
												<input placeholder="Họ" value="<?php echo $data['firstname']; ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="firstname" required>
												<span class="text-danger small"><?php echo $data["firstname_err"]; ?></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Tên<span class="text-danger small font-weight-bold">*</span></label>
												<input placeholder="Tên" value="<?php echo $data['lastname']; ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="lastname" required>
												<span class="text-danger small"><?php echo $data["lastname_err"]; ?></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Số điện thoại<span class="text-danger small font-weight-bold">*</span></label>
												<input placeholder="Số điện thoại" value="<?php echo $data['phone']; ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="phone" required>
												<span class="text-danger small"><?php echo $data["phone_err"]; ?></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Email<span class="text-danger small font-weight-bold">*</span></label>
												<input placeholder="Email" value="<?php echo $data['email']; ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="email" required>
												<span class="text-danger small"><?php echo $data["email_err"]; ?></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Mật khẩu<span class="text-danger small font-weight-bold">*</span></label>
												<input placeholder="Mật khẩu" value="<?php echo $data['password']; ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="password" required>
												<span class="text-danger small"><?php echo $data["password_err"]; ?></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Nhập lại mật khẩu<span class="text-danger small font-weight-bold">*</span></label>
												<input placeholder="Nhập lại mật khẩu" value="<?php echo $data['confirm_password']; ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="confirm_password" required>
												<span class="text-danger small"><?php echo $data["confirm_password_err"]; ?></span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="item">
												<label for="validationCustom01" class="form-label">Giới tính</label>
												<select class="form-select" name="gender">
													<option value="Nam" <?php echo ($data["gender"] == "Nam") ? "selected" : ""; ?>>Nam</option>
													<option value="Nữ" <?php echo ($data["gender"] == "Nữ") ? "selected" : ""; ?>>Nữ</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="item">
												<label for="validationCustom01" class="form-label">Chức vụ</label>
												<select class="form-select" name="role">
													<option value="admin"  <?php echo ($data["role"] == "admin") ? "selected" : ""; ?>>Quản trị viên</option>
													<option value="member" <?php echo ($data["role"] == "member") ? "selected" : ""; ?>>Thành viên</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="item">
												<label for="validationCustom01" class="form-label">Trạng thái</label>
												<select class="form-select" name="is_active">
													<option value="1" selected>Kích hoạt</option>
													<option value="0">Chưa kích hoạt</option>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="item">
												<label for="validationCustom01" class="form-label">Địa chỉ<span class="text-danger small font-weight-bold">*</span></label>
												<input placeholder="Địa chỉ" value="<?php echo $data['address']; ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="address" required>
												<span class="text-danger small"><?php echo $data["address_err"]; ?></span>
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
</script>
 