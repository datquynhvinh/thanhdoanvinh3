<?php
	require_once '../../app/config/config.php';
	include_once('../include/top.php');
	
	$id = $_GET['id'];
    $sql = "SELECT p.titleps, p.urlvideops, c.cate_name, p.categoriesps_id, p.dateps, p.ulrthumbps
          FROM phongsu p
          INNER JOIN categories c ON p.categoriesps_id = c.id
          WHERE p.idps = $id";
	$qr = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($qr);

	if(isset($_POST['add'])) {
		$titleps = $_POST['titleps'];
		$categoriesps_id = $_POST['categoriesps_id'];
		$urlvideops = $_POST['urlvideops'];
		$dateps = $_POST['dateps'];
		$fileName = '';

		$targetDir = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/upload/';
		if (!is_dir($targetDir)) {
			mkdir($targetDir, 0777, true);
		}

		if ($_FILES['ulrthumbps']['size'] !== 0) {
			$ext = pathinfo(basename($_FILES["ulrthumbps"]["name"]), PATHINFO_EXTENSION);
			$fileName = time() . '.' . $ext;
			$targetFile = $targetDir . $fileName;
			move_uploaded_file($_FILES["ulrthumbps"]["tmp_name"], $targetFile);
		}

		if ($_FILES['ulrthumbps']['size'] !== 0) {
			$sql = "update phongsu set titleps ='$titleps', categoriesps_id ='$categoriesps_id', urlvideops = '$urlvideops', dateps = '$dateps', ulrthumbps = '$fileName' where idps = $id";
		} else {
			$sql = "update phongsu set titleps ='$titleps', categoriesps_id ='$categoriesps_id', urlvideops = '$urlvideops', dateps = '$dateps' where idps = $id";
		}
		$qr = mysqli_query($con, $sql);
		
		if ($qr) {
			$oldImage = $targetDir . $row["ulrthumbps"];
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
									<h2 class"p-3">Chỉnh sửa phóng sự</h2>
									<form class="row needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
										<div class="col-md-6">
										    <div class="item">
												<label for="validationCustom01" class="form-label">Tiêu đề</label>
												<input value="<?php echo $row['titleps'] ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="titleps" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										<div class="col-md-6">
										    <div class="item">
												<label for="validationCustom01" class="form-label">Link video</label>
												<input value="<?php echo $row['urlvideops'] ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="urlvideops" required>
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
														$cate = "SELECT * FROM categories";
														$key = mysqli_query($con, $cate);
														while($row_2 = mysqli_fetch_assoc($key)) {
														$selected = ($row_2['id'] == $category_id) ? "selected" : "";
														echo '<option value="'.$row_2["id"].'" '.$selected.'>'.$row_2["cate_name"].'</option>';
													} ?>
												</select>
											</div>
										</div>
											
										<div class="col-md-6">
											<div class="item">
											<label for="validationCustom01" class="form-label">Ngày diễn ra</label>
											<input value="<?php echo $row['dateps'] ?>" type="date" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="dateps" required>
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
    												<img id="preview" src="<?php echo URLROOT . TIN_TUC_UPLOAD_DIR . $row["ulrthumbps"] ?>" alt="Ảnh xem trước">
    											</div>
    										</div>
										</div>
											
										<div class="col-12">
											<div class="item">
											<button class="btn btn-primary" name="add" type="submit">Cập nhật</button>
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
	</script>
 