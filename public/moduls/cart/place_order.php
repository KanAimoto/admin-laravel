<?php
/*=======================
Файл отправки заказа
=========================*/

//подключамся к базе данных
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";

if(isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST") {
    if(isset($_POST["place-order"])) {
        if($_POST["username"]!="" && $_POST["surname"]!="" && $_POST["phone"]!="" && $_POST["address"]!="" && $_POST["nova_poshta"]!="") {
            $sqlOrder = "INSERT INTO orders(`sum_total`, `name`, `surname`, `phone`, `city`, `novaposhta`, `order_list`) VALUES ('".$_POST['sumTotal']."', '".$_POST['username']."', '".$_POST['surname']."', '".$_POST['phone']."', '".$_POST['address']."', '".$_POST['nova_poshta']."', '".$_COOKIE['orders']."')";
            if ($conn->query($sqlOrder)) {
                // message_to_telegram('Новый заказ!');
                //переходит на главную страницу
                header ("Location: /shop.php");
                //очищаем куки заказов 
                setcookie("orders", "", 0, "/");
            } else {
                    //если какие-то данные не введены, то выдает сообщение об ошибке  
                    echo "<h2> Произошла ошибка!</h2>".mysqli_error($conn);
                } 
        } else {
                    //если какие-то данные не введены, то выдает сообщение об ошибке  
                    echo "<h2> Данные введены не верно!</h2>".mysqli_error($conn);
                } 
    }
}
?>