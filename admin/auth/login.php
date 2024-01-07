<?php
    require_once '../../app/config/config.php';
    include_once APPROOT . '/helpers/lib.php';
    include_once APPROOT . '/db/connect.php';

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
        if (!empty($_SESSION["user_active"])) {
            unset($_SESSION["user_active"]);
        }
        session_destroy();
    }

    $sql_category = mysqli_query($con,'SELECT * FROM menu ORDER BY idMenu DESC');
    $sql_category_top = mysqli_query($con,'SELECT * FROM `menu-top` ORDER BY idMenuTop ASC');

    $data = [
        "email" => "",
        "password" => "",
        "email_err" => "",
        "password_err" => ""
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy thông tin đăng nhập từ người dùng
        $email = $_POST['email'];
        $password = $_POST['password'];
        $data['email'] = $email;
        $data['password'] = $password;

        if (empty($email)) {
            $data["email_err"] = "Hãy nhập địa chỉ email!";
        }

        if (empty($password)) {
            $data["password_err"] = "Hãy nhập mật khẩu!";
        }

        if (!empty($email) && !empty($password)) {
            $query = "SELECT * FROM users WHERE email='{$email}'";
            $result = mysqli_query($con, $query);

            if ($result) {
                if ($row = mysqli_fetch_assoc($result)) {
                    if (password_verify($password, $row['password'])) {
                        // Create user session
                        $_SESSION["user_id"] = $row['id'];
                        $_SESSION["user_email"] = $row['email'];
                        $_SESSION["user_name"] = $row['firstname'] . " " . $row['lastname'];
                        $_SESSION["user_role"] = $row['role'];
                        $_SESSION["user_active"] = $row['is_active'];

                        redirect("admin/dashboard");
                    } else {
                        $data["password_err"] = "Mật khẩu không chính xác!";
                    }
                } else {
                    $data["email_err"] = "Địa chỉ email không chính xác!";
                }
            } else {
                $data["email_err"] = "Người dùng không tồn tại!";
            }
        }
    }

?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-body mt-5 mb-5">
                    <h2>Đăng nhập</h2>
                    <?php flash("register_success"); ?>
                    <hr>
                    <form action="" method="post">
                        <div class="form-group">
                        <label for="email">Địa chỉ Email<span class="text-danger font-weight-bold">*</span></label>
                        <div class="bo4">
                            <input type="email" name="email" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg<?php echo (!empty($data["email_err"])) ? " is-invalid" : ""; ?>" value="<?php echo $data["email"]; ?>" placeholder="Địa chỉ Email">
                        </div>
                        <span class="text-danger small"><?php echo $data["email_err"]; ?></span>
                        </div>

                        <div class="form-group">
                        <label for="password">Mật khẩu<span class="text-danger font-weight-bold">*</span></label>
                        <div class="bo4">
                            <input type="password" name="password" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg<?php echo (!empty($data["password_err"])) ? " is-invalid" : ""; ?>" value="<?php echo $data["password"]; ?>" placeholder="Mật khẩu">
                        </div>
                        <span class="text-danger small"><?php echo $data["password_err"]; ?></span>
                        </div>

                        <div class="row">
                        <div class="col">
                            <input type="submit" value="Đăng nhập" class="btn bg1 btn-block text-light hov1 bo-rad-23" style="background-color: dimgrey;">
                        </div>
                        <div class="col">
                            <a href="./register.php" class="btn btn-light btn-block hov1 bo-rad-23">Bạn chưa có tài khoản? Đăng ký</a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
