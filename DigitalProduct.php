<?php
	class DigitalProduct extends Product {
		function __construct($initialCost, $profit) {
			parent:: __construct($initialCost, $profit);
		}

		public function calcFinalCost() {
			$finalCost = ($this -> getInitialCost() + $this -> getInitialCost() / 100 * $this -> getProfit()) / 2;
			return "Конечная стоимость цифрового товара с учётом прибыли равна {$finalCost} рублей"; 
		}
	}
?>