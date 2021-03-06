<?php 

/*========
1. Як завантажувати файли на сервер?
- перевіряємо через phpinfo(); чи влкючена функція file_uploads on
- всі налаштування щодо завантаженн зберігаються в php.ini. Шлях прописаний в графі конфігураційний налаштувань PHP Loaded Configuration File
- max_file_uploads максимальне число файлів для завантаження за один раз
- upload_max_filesize максимальний розмір для завантаження файлу за один раз
- upload_tmp_dir директорія куди завантажуються файли
$_FILES глобальна змінна, яка є масивом, що зберігає в собі всю інформацію повязану з файлом



Алгоритм завантаження:
1. Користувач відкриває сторінку з формою для  завантаження файлу (має кнопку перегляду та кнопку відправки)
2. Користувач нажимає кнопку переглядку та вибирає файл зі свого копютера
3. Вибраний файл буде відправлений на тимчасовий каталог на сервері, відбувається перевірка на отримання файлу, підтвердження отримання файлу для користувача
4. Візуалізуватии опис докумета порядковий номер та посилання на файл  у вікні для користувачів
 - відобразити номер, назву документа у вигляді послання
 - при нажатті на назву файл з документом має відображатися
 - або вставити картинку з типом файлу і при нажатті на картинку має відкритися файл
========*/

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
		move_uploaded_file($file_tmp, "../files/".$file_name);
		echo "Файл завантажено успішно";
	} else {
		print $errors;
	}
}
?>
  <!-- форма для вибору файлу його відправки -->
	<form method="POST" enctype="multipart/form-data">
		<input type="file" name="slk">
	 </form>


