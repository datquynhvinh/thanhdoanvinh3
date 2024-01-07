<?php
	require_once '../../app/config/config.php';
	include_once('../include/top.php');
	
	$id = $_GET['id'];
	$sql = "SELECT * FROM `categories`
	        WHERE id = $id";
	$qr = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($qr);

	if(isset($_POST['add'])) {
		$cate_name = $_POST['cate_name'];
		$cate_url = $_POST['cate_url'];
		$description = $_POST['description'];
		
		$sql_update = "update `categories` set cate_name ='$cate_name', cate_url = '$cate_url', description = '$description' where id = $id";
		$qr = mysqli_query($con, $sql_update);

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
									<h2 class"p-3">Chỉnh sửa danh mục</h2>
									<form class="row needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Tên danh mục</label>
												<input value="<?php echo $row['cate_name'] ?>" type="text" class="form-control" name="cate_name" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Đường dẫn tới danh mục</label>
												<input value="<?php echo $row['cate_url'] ?>" type="text" class="form-control" name="cate_url" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										
										<div class="col-md-12">
											<div class="item">
												<label for="validationCustom01" class="form-label">Mô tả danh mục</label>
												<input value="<?php echo $row['description'] ?>" type="text" class="form-control" name="description" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="item">
											    <button class="btn btn-primary" name="add" type="submit">Sửa</button>
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
 