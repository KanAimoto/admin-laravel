<!-- Продукты (admin) -->

<?php
	$page_admin = "products";

	// Подключение базы данных
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
	// Подключение header - начала админской страницы
	include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/header.php';

	/*Код для выполнения пагинации*/

		// Количество результатов отображаемых на странице
		$results_per_page = 10;

		$sql = "SELECT * FROM products";
		$result = $conn->query($sql);
		$number_of_results = mysqli_num_rows($result);

		// Необходимое количество страниц (ceil - округление в большую сторону)
		$number_of_pages = ceil($number_of_results / $results_per_page);

		if (!isset($_GET['page'])) {
			$page_number = 1;
			// Отдельная переменная '$page_number_now' для правильной работы кнопок "Вперед" и "Назад"
			$page_number_now = 1;
		} else {
			$page_number = $_GET['page'];
			// Отдельная переменная '$page_number_now' для правильной работы кнопок "Вперед" и "Назад"
			$page_number_now = $_GET['page'];
		}

		// С какого результата начинать отображение следующих результатов
		$this_page_first_result = ($page_number - 1) * $results_per_page;

	/*Конец кода для выполнения пагинации*/
?>

<!-- Хлебные крошки (пройденый путь) -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/admin">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Products</li>
  </ol>
</nav>
<!-- Конец хлебных крошек -->


<!-- <div class="content-container">
	<div class="container"> -->
		<div class="row">
			<div class="col-md-12">
				<div class="main-content">
					<div class="row pt-5 pb-5">
						<div class="col-md-12">
							<div class="separator separator-align-center separator-width-100">
								<span class="separator-left">
									<span class="separator-line"></span>
								</span>
								<h4>Все книги:</h4>
								<span class="separator-right">
									<span class="separator-line"></span>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<?php
									$sql = "SELECT * FROM products LIMIT " . $this_page_first_result . "," . $results_per_page;
									$result = $conn->query($sql);

									while ($row = mysqli_fetch_assoc($result)) {
										$sql = "SELECT cat_title FROM categories WHERE id=" . $row['category_id'];
										$resultat = $conn->query($sql);
										$genres = mysqli_fetch_assoc($resultat);
										?>
										<div class="col-md-12 col-sm-12">
											<div class="team-member team-member-right">
												<div class="col-md-6 col-sm-6 entry-image">
													<div class="single-product-images">
														<div class="single-product-images-slider">
															<div class="caroufredsel product-images-slider" data-height="variable" data-visible="1" data-responsive="1" data-infinite="1">
																<span class="circle-price">
																	<?php 
																	if ($row["discounted_price"]==0) {
																		echo $row['price'];
																	} else {
																		echo $row['discounted_price'];
																	}
																	?>	
																	&#8372;
																</span>
																<div class="caroufredsel-wrap">
																	<ul class="caroufredsel-items">
																		<li class="caroufredsel-item">
																			<a href="<?php echo $row['image'] ?>" data-rel="magnific-popup" title="product-11" target="_blank">
																				<img width="700" height="550" src="<?php echo $row['image'] ?>" alt="product-11" title="product-11"/>
																			</a>
																		</li>
																	</ul>
																	<a href="#" class="caroufredsel-prev"></a>
																	<a href="#" class="caroufredsel-next"></a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="member-info">
													<div class="member-info-wrap">
														<div class="member-name">
															<a href="/shop-detail.php?id=<?php echo $row['id']?>" target="_blank">
																<h4><?php echo $row['title'] ?></h4>
															</a>
														</div>
														<div class="member-job"><?php echo $row['author']; ?></div>
														<div class="member-desc"><?php echo $genres['cat_title']; ?></div>
														<div class="member-desc"><?php echo $row['description']; ?></div>
														<div class="member-meta">
															<a class="edit-btn" href="/admin/modules/products/edit_products.php?id=<?php echo $row['id']; ?>" title="" target="">Редактировать</a>
															<a href="#" class="delete-btn" onclick="deleteBook(<?php echo $row['id']; ?>)" title="" target="">Удалить</a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php
									}
								?>
								
								
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="product-pagination text-center">
								<nav>
									<ul class="pagination">
										<?php
											// Устанавливаем условие кликабельности кнопки "Предидущая страница"
											if ($page_number_now > 1) {
												?>
												<li>
													<a href="/admin/products.php?page=<?php echo $page_number_now - 1; ?>" style="user-select: none;" aria-label="Previous">
														<span aria-hidden="true">&laquo;</span>
													</a>
												</li>
												<?php
											} else {
												?>
												<li>
													<a href="#" style="user-select: none; pointer-events: none; cursor: default; color: #999;" aria-label="Previous">
														<span aria-hidden="true">&laquo;</span>
													</a>
												</li>
												<?php
											}

											// Если не указан $_GET['page'], то
											if (!isset($_GET['page'])) {
												?>
												<!-- отображаем активной первую страницу, и -->
												<li class="active">
													<a href="/admin/products.php?page=1" style="user-select: none;">1</a>
												</li>
												<?php
												// устанавливаем цыкл, который отобразит необходимое количество страниц, начиная со 2
												for ($page_number=2; $page_number <= $number_of_pages; $page_number++) {
													?>
													<li>
														<a href="/admin/products.php?page=<?php echo $page_number; ?>" style="user-select: none;"><?php echo $page_number; ?></a>
													</li>
													<?php
												}
											// Если указан $_GET['page'], то
											} else {
												// устанавливаем цыкл, который отобразит необходимое количество страниц
												for ($page_number=1; $page_number <= $number_of_pages; $page_number++) {
													?>
													<!-- Задаем в 'class' условия становления страницы активной -->
													<li class="<?php if ($page_number == $_GET['page']) { echo 'active'; } ?>">
														<a href="/admin/products.php?page=<?php echo $page_number; ?>" style="user-select: none;"><?php echo $page_number; ?></a>
													</li>
													<?php
												}
											}

											// Устанавливаем условие кликабельности кнопки "Следующая страница"
											if ($page_number_now < $number_of_pages) {
												?>
												<li>
													<a href="/admin/products.php?page=<?php echo $page_number_now + 1; ?>" style="user-select: none;" aria-label="Next">
														<span aria-hidden="true">&raquo;</span>
													</a>
												</li>
												<?php
											} else {
												?>
												<li>
													<a href="#" style="user-select: none; pointer-events: none; cursor: default; color: #999;" aria-label="Next">
														<span aria-hidden="true">&raquo;</span>
													</a>
												</li>
												<?php
											}
										?>
									</ul>
								</nav>
							</div>
						</div>
					</div> <!-- /.row -->
				</div> <!-- /.main-content -->
			</div> <!-- /.col-md-12 -->
		</div> <!-- /.row -->
	<!-- </div>
</div> -->

<?php
// Подключение footer - конца админской страницы
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/footer.php';
?>