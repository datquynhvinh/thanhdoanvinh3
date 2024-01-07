<?php
    require_once '../../app/config/config.php';
    include_once APPROOT . '/helpers/lib.php';
    include_once APPROOT . '/db/connect.php';

    // Import UI
    include_once '../include/auth_ui.php';

    // Check for logged in user
    if (!isLoggedIn()) {
        redirect("admin/auth/login.php");
    } else {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Get current logged in user
            $userId = $_SESSION["user_id"];
            $query = "SELECT * FROM users WHERE id='{$userId}'";
            $result = mysqli_query($con, $query);
            $user = mysqli_fetch_assoc($result);

            // Init data
            $data = array(
                "password" => trim($_POST["password"]),
                "new_password" => trim($_POST["new_password"]),
                "confirm_password" => trim($_POST["confirm_password"]),
                "password_err" => "",
                "new_password_err" => "",
                "confirm_password_err" => ""
            );

            // Check if no error occured
            $validated = true;

            // Validate password
            if (empty($data["password"])) {
                $data["password_err"] = "Xin vui lòng nhập mật khẩu";
                $validated = false;
            } else {
                $hashed_password = $user['password'];
                if (!password_verify($data["password"], $hashed_password)) {
                    $data["password_err"] = "Mật khẩu không đúng";
                    $validated = false;
                }
            }

            // Validate new password
            if (empty($data["new_password"])) {
                $data["new_password_err"] = "Vui lòng nhập mật khẩu mới";
                $validated = false;
            } elseif (strlen($data["new_password"]) < 6) {
                $data["new_password_err"] = "Mật khẩu phải có ít nhất 6 ký tự";
                $validated = false;
            }

            // Validate confirm_password
            if (empty($data["confirm_password"])) {
                $data["confirm_password_err"] = "Vui lòng xác nhận mật khẩu của bạn";
                $validated = false;
            } elseif ($data["new_password"] != $data["confirm_password"]) {
                $data["confirm_password_err"] = "Mật khẩu không khớp";
                $validated = false;
            } elseif (password_verify($data["password"], $hashed_password)) {
                $data["confirm_password_err"] = "Bạn đã sử dụng mật khẩu này trước đó";
                $validated = false;
            }

            // Make sure no error occured
            if ($validated) {
                // Hash password
                $data["new_password"] = password_hash($data["new_password"], PASSWORD_DEFAULT);

                // Change user's password
                $changePasswordSql = 'UPDATE users SET password = "' . $data["new_password"] . '" WHERE id = "' . $user["id"] . '";';
                $changePasswordResult = mysqli_query($con, $changePasswordSql);

                if ($changePasswordResult) {
                    flash("update_profile_success", "Mật khẩu của bạn đã được thay đổi.");
                } else {
                    flash("update_profile_failed", "Có lỗi xảy ra, vui lòng thử lại.");
                }
            }
        } else {
            // Init data
            $data = [
                "password" => "",
                "new_password" => "",
                "confirm_password" => "",
                "password_err" => "",
                "new_password_err" => "",
                "confirm_password_err" => ""
            ];
        }
    }
?>
    <div class="container">
        <div class="row mt-5 mb-5" style="display: flex; justify-content: center;">
            <div class="col-sm-6 col-md-8 col-lg-6">
                <div class="card card-body">
                    <h2 style="display: flex; justify-content: center;">Đổi mật khẩu</h2>
                    <?php flash("update_profile_success"); ?>
                    <hr>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="password">Mật khẩu hiện tại <span class="text-danger small font-weight-bold">*</span></label>
                            <div class="bo4">
                                <input type="password" name="password" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg<?php echo (!empty($data["password_err"])) ? " is-invalid" : ""; ?>" value="<?php echo $data["password"]; ?>" placeholder="Mật khẩu hiện tại">
                            </div>
                            <span class="text-danger small"><?php echo $data["password_err"]; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="new_password">Mật khẩu mới <span class="text-danger small font-weight-bold">*</span></label>
                            <div class="bo4">
                                <input type="password" name="new_password" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg<?php echo (!empty($data["new_password_err"])) ? " is-invalid" : ""; ?>" value="<?php echo $data["new_password"]; ?>" placeholder="Mật khẩu mới">
                            </div>
                            <span class="text-danger small"><?php echo $data["new_password_err"]; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Nhập lại mật khẩu <span class="text-danger small font-weight-bold">*</span></label>
                            <div class="bo4">
                                <input type="password" name="confirm_password" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg<?php echo (!empty($data["confirm_password_err"])) ? " is-invalid" : ""; ?>" value="<?php echo $data["confirm_password"]; ?>" placeholder="Nhập lại mật khẩu">
                            </div>
                            <span class="text-danger small"><?php echo $data["confirm_password_err"]; ?></span>
                        </div>

                        <div class="row" style="justify-content: center;">
                            <div class="col-md-4 ml-auto" style="background-color: slategrey; border-radius: 16px;">
                                <input type="submit" value="Cập nhật" class="btn bg1 btn-block text-light hov1 bo-rad-23">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

