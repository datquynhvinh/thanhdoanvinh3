<?php
	require_once '../../app/config/config.php';
	include_once('../include/top.php');
	
	$id = $_GET['id'];
	$sql = "SELECT news.*, categories.*, users.*
			FROM news
			INNER JOIN categories ON news.category_id = categories.id
			INNER JOIN users ON news.author_id = users.id
			WHERE news.id = $id";
	$qr = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($qr);
	
	$sql_2 = "SELECT category_id, author_id FROM news WHERE id = $id";
	$result_2 = mysqli_query($con, $sql_2);
	$row_2 = mysqli_fetch_assoc($result_2);
	$category_id = $row_2['category_id'];
	$author_id = $row_2['author_id'];

	if(isset($_POST['add'])) {
		$title = $_POST['title'];
		$url = $_POST['url'];
		$danhmuc = $_POST['danhmuc'];
		$author = $_POST['author'];
		$content = $_POST['content'];
		$fileName = '';

		$targetDir = '../../assets/img/upload/';
		if (!is_dir($targetDir)) {
			mkdir($targetDir, 0777, true);
		}

		if ($_FILES['image']['size'] !== 0) {
			$ext = pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION);
			$fileName = time() . '.' . $ext;
			$targetFile = $targetDir . $fileName;
			move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
		}

		if ($_FILES['image']['size'] !== 0) {
			$sql = "update news set title ='$title', url ='$url', category_id = '$danhmuc', author_id = '$author', content = '$content', image = '$fileName' where id = $id";
		} else {
			$sql = "update news set title ='$title', url ='$url', category_id = '$danhmuc', author_id = '$author', content = '$content' where id = $id";
		}
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
									<h2 class"p-3">Chỉnh sửa tin tức</h2>
									<form class="row needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
										<div class="item">
											<div class="col-md-12">
												<label for="validationCustom01" class="form-label">Tiêu đề</label>
												<input value="<?php echo $row['title'] ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="title" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										<div class="item">
											<div class="col-md-12">
												<label for="validationCustom01" class="form-label">URL</label>
												<input value="<?php echo $row['url'] ?>" type="text" class="sizefull s-text7 p-l-22 p-r-22 form-control form-control-lg" name="url" required>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="item">
												<label for="validationCustom01" class="form-label">Danh mục</label>
												<select class="form-select" name="danhmuc">
													<?php
														$sql_3 = "SELECT * FROM categories";
														$result_3 = mysqli_query($con, $sql_3);
														while($row_3 = mysqli_fetch_assoc($result_3)) {
														$selected = ($row_3['id'] == $category_id) ? "selected" : ""; // chọn giá trị hiện tại của category_id
														echo '<option value="'.$row_3["id"].'" '.$selected.'>'.$row_3["cate_name"].'</option>';
													} ?>
												</select>
											</div>
										</div>
											
										<div class="col-md-6">
											<div class="item">
											<label for="validationCustom01" class="form-label">Tác giả</label>
											<select class="form-select" name="author">
												<?php
													$sql_3 = "SELECT * FROM users";
													$result_3 = mysqli_query($con, $sql_3);

													while($row_3 = mysqli_fetch_assoc($result_3)) {
														$selected = ($row_3['id'] == $author_id) ? "selected" : ""; // chọn giá trị hiện tại của author_id
														echo '<option value="'.$row_3["id"].'" '.$selected.'>'.$row_3["firstname"] . ' ' . $row_3["lastname"] . '</option>';
													} 
												?>
											</select>
										</div>
										</div>
										<div class="col-md-12">
											<div class="item">
											<label for="validationCustom01" class="form-label">Ảnh</label>
											<div>
												<input class="custom-upload-button" value="Chọn ảnh" onclick="document.getElementById('file-input').click()" readonly />
												<input type="file" id="file-input" onchange="previewImage(event)" name="image" />
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
												<img id="preview" src="<?php echo URLROOT . TIN_TUC_UPLOAD_DIR . $row["image"] ?>" alt="Ảnh xem trước">
											</div>
										</div>
										</div>
											
										<div class="col-md-12">
											<div class="item">
												<label for="validationCustom01" class="form-label">Nội dung</label>
												<textarea class="form-control tinymce" name="content" id="exampleFormControlTextarea1" rows="3" required=""><?php echo $row['content'] ?></textarea>
												<div class="invalid-feedback">
													Không được để trống phần này
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="item">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" name="state" id="invalidCheck">
												<label class="form-check-label" for="invalidCheck">
													Trạng thái
												</label>
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
 