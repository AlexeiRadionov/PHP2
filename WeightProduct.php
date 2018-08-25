<?php
	class WeightProduct extends Product {
		private $count;

		public function getCount() {
			return $this -> count;
		}

		function __construct($initialCost, $profit, $count) {
			parent:: __construct($initialCost, $profit);
			$this -> count = $count;
		}

		public function calcFinalCost() {
			$finalCost = ($this -> getInitialCost() + $this -> getInitialCost() / 100 * $this -> getProfit()) * $this -> getCount();
			return "Конечная стоимость весового товара с учётом прибыли равна {$finalCost} рублей за " . $this -> count . " килограмм"; 
		}
	}
?>