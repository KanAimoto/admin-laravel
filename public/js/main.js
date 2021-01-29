//переменая начальной части адресной строки
//for local
var siteURL = "http://shop-project.local/";

//добавить товар в корзину
function addToOrders(btn) {
    console.dir(btn.dataset.id);
  // Создаем экземпляр класса XMLHttpRequest
  var ajax = new XMLHttpRequest();
      /* Указываем что соединение	у нас будет POST, говорим что путь к файлу в переменной url, и что запрос у нас
        синхронный */ 
      ajax.open("POST", siteURL + "moduls/cart/add_to_cart.php", false);
      //В заголовке говорим что тип передаваемых данных закодирован.
      ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      //Вот здесь мы и передаем строку с данными, которую формировали выше. И собственно выполняем запрос.
      ajax.send("id=" + btn.dataset.id);
    //переменная для подсчета товаров, добавленных в корзину
    var response = JSON.parse(ajax.response); 
        console.dir(response);
    //переменная для отображения количества товаров на кнопке корзины
    var btnGoOrders = document.querySelector("#quantity-orders");
        btnGoOrders.innerText = response.count;
}

//
function clearCart(btn) {
     // Создаем экземпляр класса XMLHttpRequest
    var ajax = new XMLHttpRequest();
        /* Указываем что соединение	у нас будет POST, говорим что путь к файлу в переменной url, и что запрос у нас
            синхронный */ 
        ajax.open("POST", siteURL + "moduls/cart/clear-cart.php", false);
        //В заголовке говорим что тип передаваемых данных закодирован.
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //Вот здесь мы и передаем строку с данными, которую формировали выше. И собственно выполняем запрос.
        ajax.send();

}


//функция удаления товаров из корзины
function deleteProductOrders(obj, id) {
    // Создаем экземпляр класса XMLHttpRequest
    var ajax = new XMLHttpRequest();
    /* Указываем что соединение	у нас будет POST, говорим что путь к файлу в переменной url, и что запрос у нас
        синхронный */ 
    ajax.open("POST", siteURL + "moduls/cart/delete.php", false);
    //В заголовке говорим что тип передаваемых данных закодирован.
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //Вот здесь мы и передаем строку с данными, которую формировали выше. И собственно выполняем запрос.
    ajax.send("id=" + id);
    //удалить строку с товаром
    obj.parentNode.parentNode.remove();
    alert("Product deleted");
    var response = JSON.parse(ajax.response);
    //Для отображения изменения количества товаров в кнопке корзины
    var btnGoOrders = document.querySelector("#quantity-orders");
        btnGoOrders.innerText = response.count;
}

function changeCountProduct(obj, id, coast) {
    //создаем переменную для получения данных о количестве товара
    var newCountInput = document.getElementById("change"+id);
    console.dir(newCountInput);

    //вносим новое значение количества товара
    var newCount = newCountInput.value;
    // Создаем экземпляр класса XMLHttpRequest
    var ajax = new XMLHttpRequest();
        /* Указываем что соединение	у нас будет POST, говорим что путь к файлу в переменной url, и что запрос у нас
        синхронный */ 
        ajax.open("POST", siteURL + "moduls/cart/changeCountProduct.php", false);
        //В заголовке говорим что тип передаваемых данных закодирован.
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //Вот здесь мы и передаем строку с данными, которую формировали выше. И собственно выполняем запрос.
        ajax.send("id="+id+"&count="+newCount+"&coast="+coast);
        console.dir(ajax);
        //переменная для подсчета товаров
    var response = JSON.parse(ajax.response);
    console.dir(response);

    //Для отображения изменения количества товаров в кнопке корзины
    var btnGoOrders = document.querySelector("#quantity-orders");
        btnGoOrders.innerText = response.count;
    
    //Для отображения новой цены
    var coast = document.getElementById("coast"+id);
        coast.innerText = response.coast;

    var totalCoast = document.getElementById("totalCoast");
        totalCoast.innerText = response.totalCoast;
    
    var subTotalCoast = document.getElementById("subTotalCoast");
        subTotalCoast.innerText = response.totalCoast;
    
}

