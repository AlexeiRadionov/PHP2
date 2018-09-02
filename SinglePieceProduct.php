<?php
	class SinglePieceProduct extends Product {
		function __construct($initialCost, $profit) {
			parent:: __construct($initialCost, $profit);
		}

		public function calcFinalCost() {
			$finalCost = $this -> getInitialCost() + $this -> getInitialCost() / 100 * $this -> getProfit();
			return "Конечная стоимость штучного товара с учётом прибыли равна {$finalCost} рублей"; 
		}
	}
?>