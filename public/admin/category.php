<!-- Категории (admin) -->

<?php
	$page_admin = "categories";

	// Подключение базы данных
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
	// Подключение header - начала админской страницы
	include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/header.php';
?>

<!-- Хлебные крошки (пройденый путь) -->
<nav aria-label="breadcrumb breadcrumb-background">
  <ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/admin">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Categories</li>
  </ol>
</nav>
<!-- Конец хлебных крошек -->

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body table-full-width table-responsive">
				<div class="inthis" style="user-select: none;">

					<?php
					$i = 0;
					$sql_tags = $conn->query("SELECT * FROM tag");
					$col_tags = mysqli_num_rows($sql_tags);
					for ($i=0; $i < $col_tags; $i++) { 
						$row_tags = mysqli_fetch_assoc($sql_tags);
						?>
						<div class="tag">
							<a href="#">#<?php echo $row_tags["tag"]?></a>
						</div>
						<?php
					}
					?>
					<div class="black-line"></div>

						<script type="text/javascript">
							function addTag() {
								console.log("Функция работает!");
							}
						</script>

					<div class="inthis">
						<div class="buttons-tags add-tag" style="user-select: none;">Добавить тег</div>
						<div class="buttons-tags edit-tags" style="user-select: none;">Редактировать тег</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body table-full-width table-responsive">
				<div class="four_columns inthis">

					<?php
					$i = 0;
					$sql = $conn->query("SELECT * FROM categories");
					$col = mysqli_num_rows($sql);
					while($row = mysqli_fetch_assoc($sql)) { 
						$sql_tags = $conn->query("SELECT * FROM tag WHERE tag_category_id=". $row["id"]);
						?>
						<div class="alphabet-card">
							<p class="main-letter"><?php echo $row["cat_title"]?></p>
							<ul>
								<?php 
								while($row_tags = mysqli_fetch_assoc($sql_tags)) {
									?>
									<li>
										<a href="#">
											<?php echo $row_tags["tag"]?>	
										</a>	
									</li>
								<?php
								}
								?>	
							</ul>
						</div>
						<?php
					}
					?>
				</div>
					<div class="inthis">
						<div class="buttons-tags add-tag" style="margin: 15px 0">Добавить категорию</div>
						<div class="buttons-tags edit-tags">Редактировать категорию</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	// Подключение footer - конца админской страницы
	include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/footer.php';
?>