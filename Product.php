<?php
	abstract class Product {
		private $initialCost;
		private $profit;

		public function getInitialCost() {
			return $this -> initialCost;
		}

		public function getProfit() {
			return $this -> profit;
		}

		public function setter($initialCost, $profit) {
			$this -> initialCost = $initialCost;
			$this -> profit = $profit;
		}
		
		function __construct($initialCost, $profit) {
			$this -> setter($initialCost, $profit);
		}

		abstract protected function calcFinalCost();
	}
?>