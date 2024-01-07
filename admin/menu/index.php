<?php
	require_once '../../app/config/config.php';
    include_once('../include/top.php');
   
?>
<?php
    if(isset($_POST['delete'])) {
        $id = $_GET['id'];
        if($id != null) {
            $sql = "delete from `menu` where idMenu = $id";
            $qr = mysqli_query($con, $sql);
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
                                <div class="card-header">
                                    <a class="btn btn-primary" href="add.php" role="button"><i class="fas fa-plus"></i>Thêm menu</a>
                                </div>
                                <div class="card-body">
                                    <table id="datatable1" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên menu</th>
                                                <th>URL</th>
                                                <th>Vị trí</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i = 1; 
                                            $sql = mysqli_query($con,'SELECT * FROM `menu` ORDER BY idMenu ASC');
                                            while($row = mysqli_fetch_array($sql)){?>
                                            <tr>
                                                <td><?php echo $i++ ?></td>
                                                <td class="admin_new_title"><?php echo $row['title'] ?></td>
                                                <td class="admin_new_content"><?php echo $row['slug'] ?></td>
                                                <td class="admin_new_content"><?php echo $row['idMenu'] ?></td>
                                                <td>
                                                    <a class="admin_icon_detail" href="<?php echo URLROOT . '/' . $row['slug'] ?>" target="_blank"><i class="fas fa-eye"></i></a>
                                                    <a class="admin_icon_edit" href="edit.php?id=<?php echo $row['idMenu'] ?>"><i class="fas fa-pen"></i></a>
                                                    <button type="button" class="admin_icon_delete" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_id = <?php echo $row['idMenu'] ?>"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php } ?>
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
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa bài viết</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Bạn chắc chắn muốn xóa bài viết này!
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
        
        function handleDelete () {
            deleteForm.action = `index.php?id=${delete_id}`
            document.querySelector('#delete-submit-form').click()
        }

        $(document).ready(function() {
            $('#datatable1').DataTable({
                ...propertyDataTable,
            });
        });
    </script>

<?php 
    include_once('../include/bottom.php');
?>