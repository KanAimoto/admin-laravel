<!-- Редактирование катекорий -->

<?php
$page_admin = "categories";

// Подключение базы данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
// Подключение header - начала админской страницы
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/header.php';

/* Запрос на изменение катекорий в базе данных */
$sql = "SELECT * FROM categories WHERE id=" . $_GET["id"];
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (isset( $_POST["edit_category"] )) {
    if (isset( $_POST["title"] )) {

        $sql = "UPDATE categories SET title='" . $_POST["title"] . "' WHERE categories.id=" . $_GET["id"];

        if ($conn->query($sql)) {
            header("Location: /admin/category.php");
        } else {
            echo "Error edit!";
        }
    }
}
/* Конец запроса на изменение катекорий в базе данных */
?>

<!-- Хлебные крошки (пройденый путь) -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
    <li class="breadcrumb-item"><a href="/admin/category.php">Categories</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
  </ol>
</nav>
<!-- Конец хлебных крошек -->

<!-- Форма для редактирования катекорий -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Category</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $row['title']; ?>">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success pull-right" name="edit_category" value="1">Edit Category</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Конец формы для редактирования катекорий -->

<?php
// Подключение footer - конца админской страницы
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/footer.php';
?>