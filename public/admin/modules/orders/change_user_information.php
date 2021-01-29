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
?>

<!-- Хлебные крошки (пройденый путь) -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/admin">Home</a></li>
	<li class="breadcrumb-item"><a href="/admin/orders.php">Orders</a></li>
	<li class="breadcrumb-item"><a href="/admin/modules/orders/about_order.php?id=<?php echo $_GET['id'] ?>">More about ordering</a></li>
	<li class="breadcrumb-item active" aria-current="page">Change user information</li>
  </ol>
</nav>
<!-- Конец хлебных крошек -->

<div class="row">
	<div class="col-md-8">
		<div class="card">
			<form method="POST">
				<table class="table table-hover">
					<thead class="thead">
						<tr>
							<th>#</th>
							<th>Information</th>
							<th>Change</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">ID Orders:</th>
							<td><?php echo $row['id']; ?></td>
							<td>Cannot be changed</td>
							<td></td>
						</tr>
						<tr>
							<th scope="row">Time of order creation:</th>
							<td><?php echo $row['created_at']; ?></td>
							<td>Cannot be changed</td>
							<td></td>
						</tr>
						<tr>
							<th scope="row">Phone:</th>
							<td><?php echo $row['phone']; ?></td>
							<td>Cannot be changed</td>
							<td></td>
						</tr>
						<tr>
							<th scope="row">Name:</th>
							<td><?php echo $row['name']; ?></td>
							<td><input type="text" class="form-control" name="user_name"></td>
							<td></td>
						</tr>
						<tr>
							<th scope="row">Address:</th>
							<td><?php echo $row['address']; ?></td>
							<td><input type="text" class="form-control" name="address"></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>

<?php
// Подключение footer - конца админской страницы
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/footer.php';
?>