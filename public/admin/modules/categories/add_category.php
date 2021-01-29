<!-- Добавление новых катекорий -->

<?php
$page_admin = "categories";

// Подключение базы данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
// Подключение header - начала админской страницы
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/header.php';

/* Запрос на добавления новых катекорий в базу данных */
if (isset( $_POST["add_category"] )) {
    if (isset( $_POST["title"] )) {

        $sql = "INSERT INTO categories (title) VALUES ('" . $_POST["title"] . "')";

        if ($conn->query($sql)) {
            header("Location: /admin/category.php");
        } else {
            echo "Error add!";
        }
    }
}
/* Конец запроса на добавления новых катекорий в базу данных */
?>

<!-- Хлебные крошки (пройденый путь) -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
    <li class="breadcrumb-item"><a href="/admin/category.php">Categories</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
  </ol>
</nav>
<!-- Конец хлебных крошек -->

<!-- Форма для добавления новых катекорий -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Category</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success pull-right" name="add_category" value="1">Add Category</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Конец формы для добавления новых катекорий -->

<?php
// Подключение footer - конца админской страницы
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/footer.php';
?>