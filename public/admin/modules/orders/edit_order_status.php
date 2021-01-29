<?php
	// Подключение базы данных
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

	$sql = "SELECT * FROM orders WHERE id=" . $_GET['id'];
	$result = $conn->query($sql);
	$row = mysqli_fetch_assoc($result);

	if ($row['status'] == 1) {
		$sql2 = "UPDATE orders SET status='2' WHERE `orders`.`id`=" . $_GET['id'];
	} else {
		$sql2 = "UPDATE orders SET status='1' WHERE `orders`.`id`=" . $_GET['id'];
	}
	
	$w = $_GET['id'];

	if ($conn->query($sql2)) {
		header("Location: /admin/modules/orders/about_order.php?id=$w");
		exit;
	} else {
		echo "error";
		?>
		<a href="/admin/modules/orders/about_order.php?id=<php echo $_GET['id'] ?>">Come back</a>
		<?php
	}
?>