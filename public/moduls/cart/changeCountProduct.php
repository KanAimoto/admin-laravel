<?php
/*==========================================
Файл добавления количества товаров в корзину 
===========================================*/

//подключаемся к базе данных
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";

    //проверяем, существует ли пост запрос
    if(isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST") {
            //переводим куки в массив 
            $orders = json_decode($_COOKIE['orders'], true);
            $countOrders=0;
            $totalCoast=0;
            //проходимся по массиву для внесения необходимых изменений
            for($i=0; $i < count($orders['orders']); $i++) {
                //проверяем какого именно элемента массива коснулись изменения
                if($orders['orders'][$i]['product_id'] == $_POST['id']) {
                    $orders['orders'][$i]['count'] = $_POST['count']; 
                }
                $countOrders=$countOrders + $orders['orders'][$i]['count'];
                $coastOrder=$orders['orders'][$i]['count']*$orders['orders'][$i]['coast'];
                $totalCoast=$totalCoast+$coastOrder;
            }
            //преобразование массива в формат json
            $jsonProduct = json_encode($orders);
            //очищаем куки
            setcookie("orders", "", 0, "/");
            //добавляем в куки
            setcookie("orders",$jsonProduct, time() + 60*60, "/");
            //переменная для подсчета стоимости заказанного продукта
            $coast=$_POST['coast']*$_POST['count'];
            echo json_encode([
                "totalCoast" => $totalCoast,
                "coast" => $coast,
                "count" => $countOrders
            ]);
    
    }  

?>