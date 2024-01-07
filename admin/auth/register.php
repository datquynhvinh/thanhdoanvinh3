<?php
    require_once '../../app/config/config.php';
    require_once '../../app/helpers/lib.php';
    include_once '../db/connect.php';

    // Import UI
    include_once '../include/auth_ui.php';

    // Logout if enter url
    if (isLoggedIn()) {
        if (!empty($_SESSION["user_id"])) {
            unset($_SESSION["user_id"]);
        }
        if (!empty($_SESSION["user_email"])) {
            unset($_SESSION["user_email"]);
        }
        if (!empty($_SESSION["user_name"])) {
            unset($_SESSION["user_name"]);
        }
        if (!empty($_SESSION["user_role"])) {
            unset($_SESSION["user_role"]);
        }
        session_destroy();
    }

    // Check for post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = array(
        "firstname" => trim($_POST["firstname"]),
        "lastname" => trim($_POST["lastname"]),
        "email" => strtolower(trim($_POST["email"])),
        "password" => trim($_POST["password"]),
        "confirm_password" => trim($_POST["confirm_password"]),
        "gender" => trim($_POST["gender"]),
        "phone" => trim($_POST["phone"]),
        "address" => trim($_POST["address"]),
        "firstname_err" => "",
        "lastname_err" => "",
        "email_err" => "",
        "password_err" => "",
        "confirm_password_err" => "",
        "gender_err" => "",
        "phone_err" => "",
        "address_err" => ""
        );

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
            $sqlInsert = "INSERT INTO users(firstname, lastname, email, password, gender, phone, address) 
                VALUES('" . $data['firstname'] . "', '" . $data['lastname'] . "', '" . $data['email'] . "', '"
                . $data['password'] . "', '" . $data['gender'] . "', '" . $data['phone'] . "', '" . $data['address'] . "')";
            $insertResult = mysqli_query($con, $sqlInsert);

            if ($insertResult) {
                flash("register_success", "Đăng ký thành công.");
                redirect("admin/auth/login.php");
            } else {
                die("Có lỗi xảy ra, vui lòng thử lại!");
            }
        }
    } else {
        // Init data
        $data = array(
        "firstname" => "",
        "lastname" => "",
        "email" => "",
        "password" => "",
        "confirm_password" => "",
        "gender" => "Nam",
        "phone" => "",
        "address" => "",
        "firstname_err" => "",
        "lastname_err" => "",
        "email_err" => "",
        "password_err" => "",
        "confirm_password_err" => "",
        "gender_err" => "",
        "phone_err" => "",
        "address_err" => ""
        );
    }
?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-body mt-5 mb-5">
                <h2>Đăng ký</h2>
                <hr>
                <form action="" method="post">
                    <div class="row">
                    <div class="form-group col">
                        <label for="firstname">Họ <span class="text-danger small font-weight-bold">*</span></label>
                        <div class="bo4">
                        <input type="text" name="firstname" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg<?php echo (!empty($data["firstname_err"])) ? " is-invalid" : ""; ?>" value="<?php echo $data["firstname"]; ?>" placeholder="Họ">
                        </div>
                        <span class="text-danger small"><?php echo $data["firstname_err"]; ?></span>
                    </div>

                    <div class="form-group col">
                        <label for="lastname">Tên <span class="text-danger small font-weight-bold">*</span></label>
                        <div class="bo4">
                        <input type="text" name="lastname" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg<?php echo (!empty($data["lastname_err"])) ? " is-invalid" : ""; ?>" value="<?php echo $data["lastname"]; ?>" placeholder="Tên">
                        </div>
                        <span class="text-danger small"><?php echo $data["lastname_err"]; ?></span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label for="email">Địa chỉ Email <span class="text-danger small font-weight-bold">*</span></label>
                    <div class="bo4">
                        <input type="email" name="email" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg<?php echo (!empty($data["email_err"])) ? " is-invalid" : ""; ?>" value="<?php echo $data["email"]; ?>" placeholder="Địa chỉ Email">
                    </div>
                    <span class="text-danger small"><?php echo $data["email_err"]; ?></span>
                    </div>

                    <div class="form-group">
                    <label for="password">Mật khẩu <span class="text-danger small font-weight-bold">*</span></label>
                    <div class="bo4">
                        <input type="password" name="password" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg<?php echo (!empty($data["password_err"])) ? " is-invalid" : ""; ?>" value="<?php echo $data["password"]; ?>" placeholder="Mật khẩu">
                    </div>
                    <span class="text-danger small"><?php echo $data["password_err"]; ?></span>
                    </div>

                    <div class="form-group">
                    <label for="confirm_password">Nhập lại mật khẩu <span class="text-danger small font-weight-bold">*</span></label>
                    <div class="bo4">
                        <input type="password" name="confirm_password" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg<?php echo (!empty($data["confirm_password_err"])) ? " is-invalid" : ""; ?>" value="<?php echo $data["confirm_password"]; ?>" placeholder="Nhập lại mật khẩu">
                    </div>
                    <span class="text-danger small"><?php echo $data["confirm_password_err"]; ?></span>
                    </div>

                    <div class="form-group">
                    <label for="gender">Giới tính </label>
                    <div>
                        <input type="radio" name="gender" value="Nam" <?php echo ($data["gender"] == "Nam")? "checked" : ""; ?>> <span class="small">Nam</span><br>
                        <input type="radio" name="gender" value="Nữ" <?php echo ($data["gender"] == "Nữ")? "checked" : ""; ?>> <span class="small">Nữ</span>
                    </div>
                    <span class="text-danger small"><?php echo $data["gender_err"]; ?></span>
                    </div>

                    <div class="form-group">
                    <label for="phone">Số điện thoại <span class="text-danger small font-weight-bold">*</span></label>
                    <div class="bo4">
                        <input type="text" name="phone" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg<?php echo (!empty($data["phone_err"])) ? " is-invalid" : ""; ?>" value="<?php echo $data["phone"]; ?>" placeholder="Số điện thoại">
                    </div>
                    <span class="text-danger small"><?php echo $data["phone_err"]; ?></span>
                    </div>

                    <div class="form-group">
                    <label for="address">Địa chỉ <span class="text-danger small font-weight-bold">*</span></label>
                    <div class="bo4">
                        <input type="text" name="address" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg<?php echo (!empty($data["address_err"])) ? " is-invalid" : ""; ?>" value="<?php echo $data["address"]; ?>" placeholder="Địa chỉ">
                    </div>
                    <span class="text-danger small"><?php echo $data["address_err"]; ?></span>
                    </div>

                    <div class="row">
                    <div class="col mb-2">
                        <input type="submit" value="Đăng ký" class="btn bg1 btn-block text-light hov1 bo-rad-23" style="background-color: dimgrey;">
                    </div>
                    <div class="col">
                        <a href="./login.php" class="btn btn-light btn-block hov1 bo-rad-23">Bạn đã có tài khoản? Đăng nhập</a>
                    </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

