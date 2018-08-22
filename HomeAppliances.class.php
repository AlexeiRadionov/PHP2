<?php
	class HomeAppliances {
		protected $brand;
		protected $production;


		public function getBrand() {
			return $this -> brand;
		}

		public function getProduction() {
			return $this -> production;
		}

		public function setter($brand, $production) {
			$this -> brand = $brand;
			$this -> production = $production;
		}
		
		function __construct($brand, $production) {
			$this -> setter($brand, $production);
		}
	}
?>