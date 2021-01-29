<?php
/*===========================================
Файл удаления товара из корзины
===========================================*/

//проверяем был ли пост запрос
if(isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST") {
    if(isset($_COOKIE['orders'])) {
        $orders = json_decode($_COOKIE['orders'], true);
        for($i=0; $i < count($orders['orders']); $i++) {
            if($orders['orders'][$i]['product_id'] == $_POST['id']) {
                unset($orders['orders'][$i]);
                sort($orders['orders']);
            }
        }
        //преобразование массива в формат json
        $jsonProduct = json_encode($orders);
        //очищаем куки
        setcookie("orders", "", 0, "/");

        //проверяем, удалены ли все товары из корзин
        if(count($orders['orders'])!=0) {
            //добавляем в куки
            setcookie("orders",$jsonProduct, time() + 60*60, "/");
            //подсчитываем количество добавленных товаров
            echo $jsonProduct;
        } else {//если удалены все, то выдаем запись "Корзина пуста"
           header("Location: /cart.php");
        }
    } 
}  
?>