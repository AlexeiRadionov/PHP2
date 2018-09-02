<div data-id="{{ID_IMAGE}}">
	<img src="../../img/small/{{PATH_IMG}}">
	<p>{{DESCRIPTION}}</p>
	<p>Цена: {{PRICE}} рублей за 1шт.</p>
	<form action="/image/" method="GET" target='_blank'>
		<input type="hidden" name="id" value='{{ID_IMAGE}}'>
		<button>Подробнее</button>
	</form>
	<hr>
</div>
