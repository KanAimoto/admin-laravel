<?php
	$page_admin = "orders";

	// Подключение базы данных
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
	// Подключение header - начала админской страницы
	include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/header.php';

	/*Код для выполнения пагинации*/

		// Количество результатов отображаемых на странице
		$results_per_page = 20;

		$sql = "SELECT * FROM orders";
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
	<li class="breadcrumb-item active" aria-current="page">Orders</li>
  </ol>
</nav>
<!-- Конец хлебных крошек -->


<div class="row">
	<div class="col-md-12">
		<div class="main-content">
			<div class="row pb-5">
				<div class="col-md-12">
					<div class="separator separator-align-center separator-width-100">
						<span class="separator-left">
							<span class="separator-line"></span>
						</span>
						<h4>Все заказы:</h4>
						<span class="separator-right">
							<span class="separator-line"></span>
						</span>
					</div>
				</div>
			</div>
			<div class="row">
				<?php
					$sql = "SELECT * FROM orders LIMIT 5";
					$result = $conn->query($sql);

					while ($row = mysqli_fetch_assoc($result)) {
						
						?>

						<div class="col-md-3 col-sm-6">
							<div class="team-member team-member-below">
								<a href="/admin/modules/orders/about_order.php?id=<?php echo $row['id']; ?>">
									<div class="member-avatar">
										<img src="/admin/assets/img/team/team-thumb-270x320.png" width="600" height="600" alt="member" />
										<div class="overlay"></div>
									</div>
									<div class="member-info">
										<div class="member-info-wrap">
											<div class="member-name">
												<h4><?php echo $row['name']; ?> <?php echo $row['surname']; ?></h4>
											</div>
											<div class="member-job"><?php echo $row['city']; ?>, <?php echo $row['novaposhta']; ?></div>
											<div class="member-desc">
												<?php
                                                    // Декодируем json массив
						                           $orders = json_decode($row["order_list"], true);
						                            // Перебираем весь массив
						                               for ($u = 0; $u < count($orders["orders"]); $u++) {
							                                //Создаём sql запрос, в котором получаем все данные из таблицы продуктов, в которых id равно полученному из массива
							                                $sql_ord_list = "SELECT * FROM products WHERE id=" . $orders["orders"][$u]["product_id"];
							                                //Выполняем запрос в БД
							                                $result_ord_list = $conn->query($sql_ord_list);
							                                // Создаём массив из полученных данных
							                                $orders_id = mysqli_fetch_assoc($result_ord_list);
							                                // Это сделано, чтобы текст не слипался в одну строку
							                                // Если счётчик переборки равен 1-количеству элементов из массива json, то
							                                if ($u == count($orders["orders"]) - 1) {
							                                 // Выводим только название заказаного продукта
							                                 echo $orders_id["title"] . " (" . $orders_id["author"] .")";
							                                } else {
							                                 // Иначе выводим название с запятой и пробелом
							                                 echo $orders_id["title"] . " (" . $orders_id["author"] ."), ";
							                                }
						                             	}
                                                          ?>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
						<?php
					}

				?>
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
											<a href="/admin/orders.php?page=<?php echo $page_number_now - 1; ?>" style="user-select: none;" aria-label="Previous">
												<span aria-hidden="true">&laquo;</span>
											</a>
										</li>
										<?php
									} else {
										?>
										<li>
											<a href="/admin/orders.php?page=<?php echo $page_number_now - 1; ?>" style="user-select: none; pointer-events: none; cursor: default; color: #999;" aria-label="Previous">
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
											<a href="/admin/orders.php?page=1" style="user-select: none;">1</a>
										</li>
										<?php
										// устанавливаем цыкл, который отобразит необходимое количество страниц, начиная со 2
										for ($page_number=2; $page_number <= $number_of_pages; $page_number++) {
											?>
											<li>
												<a href="/admin/orders.php?page=<?php echo $page_number; ?>" style="user-select: none;"><?php echo $page_number; ?></a>
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
												<a href="/admin/orders.php?page=<?php echo $page_number; ?>" style="user-select: none;"><?php echo $page_number; ?></a>
											</li>
											<?php
										}
									}

									// Устанавливаем условие кликабельности кнопки "Следующая страница"
									if ($page_number_now < $number_of_pages) {
										?>
										<li>
											<a href="/admin/orders.php?page=<?php echo $page_number_now + 1; ?>" style="user-select: none;" aria-label="Next">
												<span aria-hidden="true">&raquo;</span>
											</a>
										</li>
										<?php
									} else {
										?>
										<li>
											<a href="/admin/orders.php?page=<?php echo $page_number_now + 1; ?>" style="user-select: none; pointer-events: none; cursor: default; color: #999;" aria-label="Next">
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
		</div>
	</div>
</div>



<?php
	// Подключение footer - конца админской страницы
	include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/footer.php';
?>