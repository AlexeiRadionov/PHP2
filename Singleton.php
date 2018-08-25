<?php
	include 'traitSingleton.php';

	class Singleton {
		private static $instance;

		private function __construct() {

		}

		use getObject;

		private function __clone() {

		}

		private function __wakeup() {

		}
	}
?>