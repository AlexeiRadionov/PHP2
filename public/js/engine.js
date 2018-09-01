$(document).ready(function(){
    $('.buy').on('click', function(){
        var id_good = $(this).attr("id");
        $.ajax({
            url: "/basket/add/",
            type: "POST",
            data:{
                id_good: id_good
            },
            dataType : "json",
            success: function(answer){
                if(answer.result == 1) {
                    alert("Товар добавлен в корзину!");
                    addProduct(answer);
                } else
                    alert("Что-то пошло не так...");
            },
            error: function() {alert("Ошибка");}
        })
    });

    $('.remove').on('click', function(){
        var id_basket = $(this).attr("id");
        $.ajax({
            url: "/basket/remove/",
            type: "POST",
            data:{
                id_basket: id_basket,
            },
            error: function() {alert("Ошибка");},
            success: function(answer){
                if(answer.result == 1) {
                    alert("Товар удалён из корзины!");
                    removeProduct(answer);
                } else
                    alert("Что-то пошло не так...");
            },
            dataType : "json"
        })
    });
});

function addProduct(data) { 
    $('#myBasket > button').html('Ваша корзина ' + '(' + data.countProduct + ')');
}

function removeProduct(data) {
    if (data.quantity > 0) {
        $('p[data-id="'+data.id_product+'"]').html('Количество: ' + data.quantity);
    } else {
        $('div[data-id="'+data.id_product+'"]').remove();
    }

    $('#count').html('Всего товаров в корзине: ' + data.countProduct);
    $('#sum').html('Общая сумма покупки: ' + data.sum);
}

