<?php
	require_once '../../app/config/config.php';
    include_once('../include/top.php');
   
?>
<?php
    if(isset($_POST['delete'])) {
        $id = $_GET['id'];
        if($id != null) {
            $sql = "delete from phongsu where idps=$id";
            $qr = mysqli_query($con, $sql);
        }
        
    }

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
                                    <a class="btn btn-primary" href="add.php" role="button"><i class="fas fa-plus"></i>Thêm phóng sự</a>
                                </div>
                                <div class="card-body">
                                    <table id="datatable1" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên phóng sự</th>
                                                <th>Danh mục</th>
                                                <th>Link video</th>
                                                <th>Ngày diễn ra</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                            <?php 
                                            $i = 1;
                                            $query = "SELECT phongsu.titleps, phongsu.urlvideops, phongsu.ulrthumbps, phongsu.dateps, categories.cate_name, phongsu.idps FROM phongsu JOIN categories ON phongsu.categoriesps_id = categories.id ORDER BY `dateps` DESC;";
                                            $result = mysqli_query($con, $query);
                                            
                                            if ($result) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $titleps = $row['titleps'];
                                                        $urlvideops = $row['urlvideops'];
                                                        $ulrthumbps = $row['ulrthumbps'];
                                                        $dateps = $row['dateps'];
                                                        $cate_name = $row['cate_name'];
                                                        $idps = $row['idps']; ?>
                                                        
                                                        <tbody>
                                                            <tr>
                                            		            <td><?php echo $i++ ?></td>
                                                                <td class="admin_new_title"><?php echo $titleps ?></td>
                                                                <td class="admin_new_title"><?php echo $cate_name ?></td>
                                                                <td class="admin_new_content">
                                                                    <a data-fancybox="gallery" href="<?php echo $urlvideops; ?>" target="_blank">
                                                                        <?php echo $urlvideops; ?>
                                                                    </a>
                                                                </td>
                                                                <td class="admin_new_title"><?php echo $dateps ?></td>
                                                                <td>
                                                                    <a class="admin_icon_edit" href="edit.php?id=<?php echo $idps ?>"><i class="fas fa-pen"></i></a>
                                                                    <button type="button" class="admin_icon_delete" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_id =<?php echo $idps ?>"><i class="fas fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                            <?php }
                                                } else {
                                                    echo "Không tìm thấy kết quả.";
                                                }
                                            } else {
                                                echo "Lỗi truy vấn: " . mysqli_error($con);
                                            }
                                            ?>
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