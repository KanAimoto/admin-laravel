<?php
/*==========================================
Файл добавления товаров в корзину 
===========================================*/
//подключамся к базе данных
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
//проверяем, существует ли пост запрос
if (isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){
    //отправляем запрос в бд на товар, по которому кликнул пользователь
    $sql = "SELECT * FROM products WHERE id=" .$_POST["id"];
    //получаем результат запроса
    $result = $conn->query($sql);
    //преобразовуем данные в массив
    $product = mysqli_fetch_assoc($result);
    //если в корзине уже что-то есть
    if(isset($_COOKIE['orders'])) {
        //преобразуем json массив из куки в удобный массив для работы с данными
        $orders = json_decode($_COOKIE['orders'], true);
        $countOrders = 0;
        $coast=0;
        $issetProduct = 0;
        for ($i=0; $i< count($orders['orders']); $i++) {
            if ($orders['orders'][$i]["product_id"] == $product["id"]) {
                $orders['orders'][$i]["count"]++;
                $issetProduct = 1;

            }
        }
        if ($issetProduct != 1) {
            $orders['orders'][]=[
                        "product_id" => $product['id'],
                        "coast" => $product['discounted_price'],
                        "count" => 1
                    ];
        } 
    } else {
        //если корзина пуста
        $orders = ["orders"=>[
            ["product_id" => $product['id'],
            "coast" => $product['discounted_price'],
            "count" => 1]
            ] 
            ];
        }

        for ($i=0; $i< count($orders['orders']); $i++) {
            $countOrders = $countOrders + $orders['orders'][$i]['count'];
            $coastOrder=$orders['orders'][$i]['count']*$orders['orders'][$i]['coast'];
            $coast=$coast+$coastOrder;    
        }


        //преобразование массива в формат json
        $jsonProduct = json_encode($orders);
        //очищаем куки
        setcookie("orders", "", 0, "/");
        //добавляем в куки
        setcookie("orders",$jsonProduct, time() + 60*60, "/");
        //подсчитываем количество добавленных товаров
        echo json_encode([
            "count" => $countOrders,
            "coast" => $coast
        ]);
}
?>