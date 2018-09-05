<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Корзина</title>
	<link rel="stylesheet" href="../../css/style.css">
</head>
<body>
	<div class="auth">
		{{LOGIN}}
	</div>
	<div class="goods">
		{{BASKET}}
		<p id="count">Всего товаров в корзине: {{COUNTPRODUCT}}</p>
		<p id="sum">Общая сумма покупки: {{SUM}}</p>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/js/engine.js" type="text/javascript"></script>
</body>
</html>