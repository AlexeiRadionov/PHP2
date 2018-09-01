<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Изображение</title>
	<link rel="stylesheet" href="../../css/style.css">
</head>
<body>
	<div class="auth">
		{{LOGIN}}
	</div>
	<div class="image">
		<img src="../../img/big/{{IMAGE}}">
		<p>Просмотров: {{PREVIEW}}</p>
		<hr>
		<h2>Описание товара</h2>
		<p>{{DESCRIPTION}}</p>
		<p>Цена: {{PRICE}} рублей</p>
		<button class="buy" id="{{IDIMAGE}}">Купить</button>
		<a id="myBasket" target="_blank" href="../basket/"><button>Ваша корзина ({{COUNTPRODUCT}})</button></a>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/js/engine.js" type="text/javascript"></script>
</body>
</html>