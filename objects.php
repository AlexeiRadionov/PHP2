<?php
	include 'Product.php';
	function __autoload ($className) {
		include $className . '.php';
	}

	$digitalObj = new DigitalProduct(100, 10);
	$singlePieceObj = new SinglePieceProduct(100, 20);
	$weightObj = new WeightProduct(200, 10, 5);

	echo $digitalObj -> calcFinalCost() . '<hr>';
	echo $singlePieceObj -> calcFinalCost() . '<hr>';
	echo $weightObj -> calcFinalCost() . '<hr>';
?>