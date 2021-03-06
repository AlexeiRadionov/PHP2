﻿<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Моя галерея</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div class="auth">
		{{LOGIN}}
	</div>
	<div id="main">
		<div class="post_title"><h2>Моя галерея</h2></div>
		<div class="gallery">
			{{GALLERY}}
		</div>
		<a href="catalog/" class="catalog">Перейти к каталогу</a>
		<div class="feedback">
			<p>Оставьте свой отзыв</p>
			<form>
				<input type="text" name="userName" required placeholder="User Name">
				<input type="text" name="feedback" required placeholder="User feedback">
				<input type="submit" name="send">
			</form>
			{{FEEDBACK}}
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/js/engine.js" type="text/javascript"></script>
</body>
</html>