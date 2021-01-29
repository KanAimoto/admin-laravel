<!-- Добавление новых продуктов -->
<?php
$page_admin = "products";

// Подключение базы данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
// Подключение header - начала админской страницы
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/header.php';

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
/* Конец запроса на добавление продуктов в базе данных */

/* Запрос на добавления новых продуктов в базу данных */
if (isset( $_POST["add_product"] )) {
	if (isset( $_POST["title"] )) {
		$sql = "INSERT INTO products (author, title, description, category_id, size, release_year, price, discounted_price, image, quantity) " .
				"VALUES ('" . $_POST["author"] . "', '" . $_POST["title"] . "', '" . $_POST["description"] . "', '" . $_POST["category_id"] . "', '" . $_POST["size"] . "', '" . $_POST["release_year"] . "', '" . $_POST["price"] . "', '" . $_POST["discounted_price"] . "', '" . $_POST["image"] . "', '" . $_POST["quantity"] . "')";
		if ($conn->query($sql)) {
			header("Location: /admin/products.php");
		} else {
			echo "Error add!";
		}
	}
}
/* Конец запроса на добавления новых продуктов в базу данных */
?>

<!-- Хлебные крошки (пройденый путь) -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/admin">Home</a></li>
	<li class="breadcrumb-item"><a href="/admin/products.php">Products</a></li>
	<li class="breadcrumb-item active" aria-current="page">Add Product</li>
  </ol>
</nav>
<!-- Конец хлебных крошек -->

<!-- Форма для добавления новых продуктов -->
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Add Product</h4>
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
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="author">Автор</label>
								<input type="text" class="form-control" name="author" placeholder="Author" value="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="title">Название</label>
								<input type="text" class="form-control" name="title" placeholder="Title" value="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="description">Описание</label>
								<textarea type="text" class="form-control" name="description" placeholder="Description" style="height: 150px;"></textarea>
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
										?>
										<option value="<?php echo $row2['id']; ?>"><?php echo $row2['cat_title']; ?></option>
									<?php
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
								<input type="text" class="form-control" name="size" placeholder="Size" value="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="release_year">Год выпуска</label>
								<input type="text" class="form-control" name="release_year" placeholder="Release year" value="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="price">Цена</label>
								<input type="text" class="form-control" name="price" placeholder="Price" value="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="discounted_price">Цена со скидкой</label>
								<input type="text" class="form-control" name="discounted_price" placeholder="Discounted price" value="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="quantity">Количество</label>
								<input type="text" class="form-control" name="quantity" placeholder="Quantity" value="">
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-warning pull-right round-remove" onclick="history.back();">Отменить</button>
					<button type="submit" class="btn btn-success pull-right round-submit" name="add_product" value="1">Сохранить изменения</button>
					<div class="clearfix"></div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Конец формы для добавления новых продуктов -->

<?php
// Подключение footer - конца админской страницы
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/footer.php';
?>

