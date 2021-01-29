<!-- Больше о заказе -->

<?php
	$page_admin = "orders";

	// Подключение базы данных
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
	// Подключение header - начала админской страницы
	include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/header.php';

	$sql = "SELECT * FROM orders WHERE id=" . $_GET['id'];
	$result = $conn->query($sql);
	$row = mysqli_fetch_assoc($result);

	$basket = json_decode($row['products'], true);


	if (isset( $_POST["change"] )) {
		$sql = "UPDATE orders SET name='" . $_POST["name"] . "', surname='" . $_POST["surname"] . "', patronymic='" . $_POST["patronymic"] . "', phone='" . $_POST["phone"] . "', city='" . $_POST["city"] . "', novaposhta='" . $_POST["novaposhta"] . "', sum_total='" . $_POST["sum_total"] . "' WHERE orders.id=" . $_GET["id"]; // date=CURRENT_TIMESTAMP

		if ($conn->query($sql)) {
			header("Refresh:0");
		} else {
			echo "Error edit!";
		}
	}

?>

<!-- Хлебные крошки (пройденый путь) -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/admin">Home</a></li>
	<li class="breadcrumb-item"><a href="/admin/orders.php">Orders</a></li>
	<li class="breadcrumb-item active" aria-current="page">More about ordering</li>
  </ol>
</nav>
<!-- Конец хлебных крошек -->

<!-- Форма для редактирования катекорий -->
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<?php
					if (isset($_GET['change']) && $_GET['change'] == 1) {
						?>

						<h4>Редактирование информации о заказе:</h4>
						<form action="about_order.php?id=<?php echo $_GET['id']; ?>" method="POST">
							<b>ID заказа:</b> <?php echo $row['id']; ?><br/>
							<b>Имя заказчика:</b> <input type="text" name="name" value="<?php echo $row['name']; ?>"><br/>
							<b>Фамилия заказчика:</b> <input type="text" name="surname" value="<?php echo $row['surname']; ?>"><br/>
							<b>Отчество заказчика:</b> <input type="text" name="patronymic" value="<?php echo $row['patronymic']; ?>"><br/>
							<b>Телефон заказчика:</b> <input type="text" name="phone" value="<?php echo $row['phone']; ?>"><br/>
							<b>Город доставки заказа:</b> <input type="text" name="city" value="<?php echo $row['city']; ?>"><br/>
							<b>Отделение новой почты:</b> <input type="text" name="novaposhta" value="<?php echo $row['novaposhta']; ?>"><br/>
							<b>Общая сумма заказа:</b> <input type="text" name="sum_total" value="<?php echo $row['sum_total']; ?>"> грн<br/>
							<b>Дата создания заказа:</b> <?php echo $row['created_at']; ?><br/>
							<button type="submit" class="btn btn-success" style="border-radius: 20px; margin: 10px 0;" name="change">Сохранить изменения</button>
							<a href="about_order.php?id=<?php echo $_GET['id']; ?>" type="button" style="border-radius: 20px; margin: 10px 0;" class="btn btn-warning">Отмена</a>
						</form>
						<?php
					} else {
						?>

						<h4>Информация о заказе:</h4>
						<b>ID заказа:</b> <?php echo $row['id']; ?><br/>
						<b>Имя заказчика:</b> <?php echo $row['name']; ?><br/>
						<b>Фамилия заказчика:</b> <?php echo $row['surname']; ?><br/>
						<b>Отчество заказчика:</b> <?php echo $row['patronymic']; ?><br/>
						<b>Телефон заказчика:</b> <?php echo $row['phone']; ?><br/>
						<b>Город доставки заказа:</b> <?php echo $row['city']; ?><br/>
						<b>Отделение новой почты:</b> <?php echo $row['novaposhta']; ?><br/>
						<b>Общая сумма заказа:</b> <?php echo $row['sum_total']; ?> грн<br/>
						<b>Дата создания заказа:</b> <?php echo $row['created_at']; ?><br/>
						<a href="about_order.php?id=<?php echo $_GET['id']; ?>&change=1" type="button" style="border-radius: 20px; margin: 10px 0;" class="btn btn-primary">Редактировать информацию</a>

						<?php
					}
				?>
			</div>
		</div>
		<div class="main-content">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						
						<?php
                           
                        ?>

						<?php
 						// Декодируем json массив
                           $orders = json_decode($row["order_list"], true);
                            // Перебираем весь массив
                              //  for ($u = 0; $u < count($orders["orders"]); $u++) {
	                                
                             	// }
							for ($u = 0; $u < count($orders["orders"]); $u++) {
								
								//Создаём sql запрос, в котором получаем все данные из таблицы продуктов, в которых id равно полученному из массива
	                            $sql_ord_list = "SELECT * FROM products WHERE id=" . $orders["orders"][$u]["product_id"];
	                            //Выполняем запрос в БД
	                            $result_ord_list = $conn->query($sql_ord_list);
	                            // Создаём массив из полученных данных
	                            $orders_id = mysqli_fetch_assoc($result_ord_list);

								$sql = "SELECT cat_title FROM categories WHERE id=" . $orders_id['category_id'];
								$resultat = $conn->query($sql);
								$genres = mysqli_fetch_assoc($resultat);
								?>
								<div class="col-md-12 col-sm-12">
									<div class="team-member team-member-right">
										<div class="col-md-6 col-sm-6 entry-image">
											<div class="single-product-images">
												<div class="single-product-images-slider">
													<div class="caroufredsel product-images-slider" data-height="variable" data-visible="1" data-responsive="1" data-infinite="1">
														<div class="caroufredsel-wrap">
															<ul class="caroufredsel-items">
																<li class="caroufredsel-item">
																	<a href="<?php echo $orders_id['image'] ?>" data-rel="magnific-popup" title="product-11" target="_blank">
																		<img width="700" height="550" src="<?php echo $orders_id['image'] ?>" alt="product-11" title="product-11"/>
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
													<a href="/shop-detail.php?id=<?php echo $orders_id['id']?>" target="_blank">
														<h4><?php echo $orders_id['title'] ?></h4>
													</a>
												</div>
												<div class="member-job"><?php echo $orders_id['author']; ?></div>
												<div class="member-desc">Количество экземпляров: <?php echo $orders["orders"][$u]["count"]; ?></div>
												<div class="member-desc"><?php echo $orders_id['description']; ?></div>
												<div class="member-meta">
													<a href="#" title="" target="">Удалить</a>
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
		</div>
	</div>
</div>




<!-- Конец формы для редактирования катекорий -->

<?php
// Подключение footer - конца админской страницы
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/footer.php';
?>