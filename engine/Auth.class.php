<?php
	class Auth extends Gallery {
		public static $auth;

		public function setAuth($page_item, $user = '') {
			self::$auth = $user;
		}

		public function alreadyLogin() {
			return ($_SESSION["login"] == "admin" && $_SESSION["pass"] == "123"); 
		}

		public function getAuth($login, $pass) {
			$login = strip_tags($login);
			$pass = strip_tags($pass);
			$_SESSION["login"] = $login;
			$_SESSION["pass"] = $pass; 
		}

		public function template() {
			
		}
	}
?>