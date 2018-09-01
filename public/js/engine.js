$(document).ready(function(){
    var countGoods = 5;
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

    $('.showGoods').on('click', function(){
        countGoods += 5;
        $.ajax({
            url: "/catalog/addShowGoods/",
            type: "POST",
            data:{
                countGoods: countGoods
            },
            dataType : "json",
            success: function(answer){
                if(answer.result == 1) {
                    console.log(answer);
                    addShowGoods(answer);
                } else
                    alert("Что-то пошло не так...");
            },
            error: function() {alert("Ошибка");}
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

function addShowGoods(data) {
    var str = '';
    delete data.result;
    if (data.answer) {
        delete data.answer;
        $('.showGoods').attr('style', 'display:none');
    }
    
    for(var good in data) {
        //console.log(data[good]);
        str += '<div data-id="'+data[good].id_image+'"><img src="../../img/small/'+data[good].path_img+'"><p>"'+data[good].description+'"</p><p>Цена: "'+data[good].price+'" рублей за 1шт.</p><form action="/image/" method="GET" target="_blank"><input type="hidden" name="id" value="'+data[good].id_image+'"><button>Подробнее</button></form><hr></div>';
    }  
    $('.goods').html(str);
}