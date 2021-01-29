<!-- Удаление катекорий -->

<?php
// Подключение базы данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

/* Запрос для удаления катекорий из базы данных */
$sql = "DELETE FROM categories WHERE id=" . $_GET["id"];

if (mysqli_query($conn, $sql)) {
	header("Location: /admin/category.php");
} else {
	echo "Error delete!";
}
/* Конец запроса для удаления катекорий из базы данных */
?>