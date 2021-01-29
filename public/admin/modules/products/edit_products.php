<!-- Редактирование продуктов -->

<?php
	$page_admin = "products";

	// Подключение базы данных
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
	// Подключение header - начала админской страницы
	include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/header.php';

	/* Запрос на изменение продуктов в базе данных */
	$sql = "SELECT * FROM products WHERE id=" . $_GET["id"];
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	$sql = "SELECT cat_title FROM categories WHERE id=" . $row['category_id'];
	$resultat = $conn->query($sql);
	$genres = mysqli_fetch_assoc($resultat);

	if(isset($_FILES['slk'])) {

		$errors = array();

		$file_name = $_FILES['slk']['name'];
		$file_size = $_FILES['slk']['size'];
		$file_tmp = $_FILES['slk']['tmp_name'];
		$file_type = $_FILES['slk']['type'];
		$file_core = explode('.', $_FILES['slk']['name'] );
		$file = end($file_core);
		$file_ext = strtolower($file);

		$expensions = array("jpeg", "jpg", "png", "pdf");

		
		if($file_size >2097152) {
			$errors = "Файл повинен бути не більше 2 мегабата";
		}
		if(empty($errors) == true) {
			move_uploaded_file($file_tmp, "../../../images/product/".$file_name);
		} else {
			print $errors;
		}
	}


	if (isset( $_POST["edit_product"] )) {
		if (isset( $_POST["title"] )) {			
			$sql = "UPDATE products SET author='" . $_POST["author"] . "', title='" . $_POST["title"] . "', description='" . $_POST["description"] . "', category_id='" . $_POST["category_id"] . "', size='" . $_POST["size"] . "', release_year='" . $_POST["release_year"] . "', price='" . $_POST["price"] . "', discounted_price='" . $_POST["discounted_price"] . "', image='" . $_POST["image"] . "' WHERE products.id=" . $_GET["id"]; // date=CURRENT_TIMESTAMP

			if ($conn->query($sql)) {
				header("Location: /admin/products.php");
			} else {
				echo "Error edit!";
			}
		}
	}
	/* Конец запроса на изменение продуктов в базе данных */

?>

<!-- Хлебные крошки (пройденый путь) -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/admin">Home</a></li>
	<li class="breadcrumb-item"><a href="/admin/products.php">Products</a></li>
	<li class="breadcrumb-item active" aria-current="page">Edit Product</li>
  </ol>
</nav>
<!-- Конец хлебных крошек -->

<!-- Форма для редактирования продуктов -->
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Редактирование книги</h4>
			</div>
			<div class="card-body">
				<label>Новая обложка</label>
				<form  method="POST" enctype="multipart/form-data">
					<input type="file" name="slk">
					<input class="btn btn-success round-submit download-btn" type="submit" value="Загрузить файл">
					<?php
						if (isset($_FILES['slk'])) {
							?>
							<a href="../../../images/product/<?php echo $_FILES['slk']['name'];?>" data-rel="magnific-popup" title="<?php echo $_FILES['slk']['name'];?>" target="_blank">
								<img class="new-img" src="../../../images/product/<?php echo $_FILES['slk']['name'];?>" alt="<?php echo $_FILES['slk']['name'];?>" title="<?php echo $_FILES['slk']['name'];?>"/>
								<p class="illusion"><?php echo $_FILES['slk']['name'];?></p>
							</a>
							
							<?php
						}
					?>
					
				</form>
				<form method="POST">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="author">Автор</label>
								<input type="text" class="form-control" name="author" placeholder="Author" value="<?php echo $row['author']; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="title">Название</label>
								<input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $row['title']; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="description">Описание</label>
								<textarea type="text" class="form-control" name="description" placeholder="Description" style="height: 150px;"><?php echo $row['description']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="category_id">Жанр</label>
								<select name="category_id">
									<?php
									$sql = "SELECT * FROM categories";
									$result = $conn->query($sql);
									while ($row2 = mysqli_fetch_assoc($result)) {
										if ($row2['id'] != $row['category_id']) {
											?>
											<option value="<?php echo $row2['id']; ?>"><?php echo $row2['cat_title']; ?></option>;
											<?php
										} else {
											?>
											<option value="<?php echo $row2['id']; ?>" selected><?php echo $row2['cat_title']; ?></option>;
											<?php
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="size">Количество страниц</label>
								<input type="text" class="form-control" name="size" placeholder="Size" value="<?php echo $row['size']; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="release_year">Год выпуска</label>
								<input type="text" class="form-control" name="release_year" placeholder="Release year" value="<?php echo $row['release_year']; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="price">Цена</label>
								<input type="text" class="form-control" name="price" placeholder="Price" value="<?php echo $row['price']; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="discounted_price">Цена со скидкой</label>
								<input type="text" class="form-control" name="discounted_price" placeholder="Discounted price" value="<?php echo $row['discounted_price']; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="image">Текущая обложка</label>
								</br>
								<a href="<?php echo $row['image'] ?>" data-rel="magnific-popup" title="product-11" target="_blank">
									<img width="300" src="<?php echo $row['image'] ?>" alt="product-11" title="product-11"/>
								</a>
								<?php 
								if (isset($_FILES['slk'])) {
								?>
									<input type="hidden" name="image" value="../../../images/product/<?php echo $_FILES['slk']['name'];?>">
								<?php
								}
								?>
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-warning pull-right round-remove" onclick="history.back();">Отменить</button>
					<button type="submit" class="btn btn-success pull-right round-submit" name="edit_product" value="1">Сохранить изменения</button>
					<div class="clearfix"></div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Конец формы для редактирования продуктов -->

<?php
// Подключение footer - конца админской страницы
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/footer.php';
?>