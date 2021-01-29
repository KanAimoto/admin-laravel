<?php
// Подключение базы данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

/* Запрос для удаления продуктов из базы данных */
$sql = "DELETE FROM products WHERE id=" . $_POST["id"];

if (mysqli_query($conn, $sql)) {
	echo "Work!";
} else {
	echo "Error delete!";
}
/* Конец запроса для удаления продуктов из базы данных */
?>