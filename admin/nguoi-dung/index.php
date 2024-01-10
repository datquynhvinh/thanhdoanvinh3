<?php
	require_once '../../app/config/config.php';
    include_once('../include/top.php');

    if (!isAdmin()) {
        redirect('admin/menu');
    }
?>
<?php
    if(isset($_POST['delete'])) {
        $id = $_GET['id'];
        if($id != null) {
            $sql = "delete from users where id=$id";
            $qr = mysqli_query($con, $sql);
        } 
    }

    $userResult = mysqli_query($con,'SELECT * FROM users ORDER BY id ASC');
 ?>
    <div class="app-container">
        <div class="search">
            <form>
                <input class="form-control" type="text" placeholder="Type here..." aria-label="Search">
            </form>
            <a href="#" class="toggle-search"><i class="material-icons">close</i></a>
        </div>
        <div class="app-content">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <a class="btn btn-primary" href="add.php" role="button"><i class="fas fa-plus"></i>Thêm người dùng  </a>
                                </div>
                                <div class="card-body">
                                    <table id="datatable1" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Họ</th>
                                                <th>Tên</th>
                                                <th>Số điện thoại</th>
                                                <th>Email</th>
                                                <th>Giới tính</th>
                                                <th>Địa chỉ</th>
                                                <th>Chức vụ</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1; 
                                                while ($row = mysqli_fetch_array($userResult)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td class="admin_new_title"><?php echo $row['firstname'] ?></td>
                                                    <td class="admin_new_content"><?php echo $row['lastname'] ?></td>
                                                    <td class="admin_new_content"><?php echo $row['phone'] ?></td>
                                                    <td class="admin_new_content"><?php echo $row['email'] ?></td>
                                                    <td class="admin_new_content"><?php echo $row['gender'] ?></td>
                                                    <td class="admin_new_content"><?php echo $row['address'] ?></td>
                                                    <td class="admin_new_content"><?php echo $row['role'] == 'admin' ? 'Quản trị viên' : 'Thành viên' ?></td>
                                                    <td>
                                                        <a class="admin_icon_edit" href="edit.php?id=<?php echo $row['id'] ?>"><i class="fas fa-pen"></i></a>
                                                        <?php if ($_SESSION['user_id'] != $row['id']) { ?>
                                                            <button type="button" class="admin_icon_delete" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="setDeleteId(<?php echo $row['id'] ?>)"><i class="fas fa-trash"></i></button>
                                                        <?php } ?>
                                                        </td>
                                                </tr>
                                            <?php
                                                $i++; }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="5" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <div>
                    <b><h1 class="modal-title fs-5" id="exampleModalLabel">Xóa người dùng</h1></b>
                    <h5>Bạn chắc chắn muốn xóa người dùng này!</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" id="delete_id_input" name="delete_id_input">
                <label for="type_delete">Bạn có muốn chuyển sở hữu nội dung cho người khác không?</label>
                <div>
                    <input type="radio" name="type_delete" value="delete_all" checked> <span class="small">Xóa tất cả nội dung</span><br>
                    <div>
                        <input type="radio" name="type_delete" value="give_content" >
                        <span class="small">Chuyển quyền sở hữu cho</span>
                        <?php 
                            $targetUser = '1';
                            $otherUserResult = mysqli_query($con, "SELECT * FROM users WHERE id != $targetUser ORDER BY id ASC");
                            $otherUsers = mysqli_fetch_all($otherUserResult, MYSQLI_ASSOC);
                        ?>
                        <select class="" name="role">
                            <?php
                                foreach ($otherUsers as $ortherUser) {
                            ?>
                                <option value="<?php echo $ortherUser['id'] ?>"><?php echo $ortherUser['firstname'] . ' ' . $ortherUser['lastname'] ?>
                            <?php
                                }
                            ?>
                        </select>
                    </div>

                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger" onclick="handleDelete()">Xóa</button>
              </div>
            </div>
          </div>
        </div>
    </div>

    <form action="" method="POST" id="delete-form">
        <button type="submit" name='delete' id="delete-submit-form"></button>
    </form>
    <script>
        var deleteForm = document.forms['delete-form']
        
        function setDeleteId(id) {
            delete_id = id;
            document.getElementById('delete_id_input').value = id;
        }

        function handleDelete () {
            deleteForm.action = `index.php?id=${delete_id}`
            document.querySelector('#delete-submit-form').click()
           
        }

        $(document).ready(function() {
            $('#datatable1').DataTable({
                ...propertyDataTable,
                columnDefs: [{
                    orderable: false,
                    targets: -1,
                }],
            });
        });
    </script>

<?php 
    include_once('../include/bottom.php');
?>