<?php
	include "HomeAppliances.class.php";

	class Television extends HomeAppliances {
		private $model;
		private $price;
		private $discount;

		public function getModel() {
			return $this -> model;
		}

		public function getPrice() {
			return $this -> price;
		}

		public function getDiscount() {
			return $this -> discount;
		}
		
		function __construct($brand, $production, $model, $price, $discount) {
			parent:: __construct($brand, $production);
			$this -> model = $model;
			$this -> price = $price;
			$this -> discount = $discount;
		}

		public function buy() {
			$price = $this -> price - $this -> price/100 * $this -> discount;
			return "Телевизор " . $this -> getBrand() . " производства " . $this -> getProduction() . " продаётся со скидкой " . $this -> discount . " %. Цена со скидкой: {$price} рублей";
		}
	}

	$tv = new Television("Samsung", "Корея", "SM-32-1264", 12000, 10);
	echo $tv -> buy();
?>