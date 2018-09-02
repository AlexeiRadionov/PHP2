<?php
	function AlreadyLogin() {
		return ($_SESSION["login"] == "admin" && $_SESSION["pass"] == "123"); 
	}

	function auth($login, $pass) {
		$login = strip_tags($login);
		$pass = strip_tags($pass);
		$_SESSION["login"] = $login;
		$_SESSION["pass"] = $pass; 
	}
?>