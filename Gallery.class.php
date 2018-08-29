<?php
	class Gallery {
		const HOST = 'localhost';
		const USER = 'root';
		const PASS = '';
		const DB = 'gallery';

		public function getHOST() {
			return self::HOST;
		}

		public function getUSER() {
			return self::USER;
		}

		public function getPASS() {
			return self::PASS;
		}

		public function getDB() {
			return self::DB;
		}

		public function getAssocResult($sql) {
		    $db = mysqli_connect(self::HOST, self::USER, self::PASS, self::DB);
			$result = mysqli_query($db, $sql);
			$array_result = [];
			while($row = mysqli_fetch_assoc($result))
				$array_result[] = $row;

		    mysqli_close($db);
			return $array_result;
		}

		public function executeQuery($sql){
		    $db = mysqli_connect(self::HOST, self::USER, self::PASS, self::DB);
			$result = mysqli_query($db, $sql);
		    mysqli_close($db);
			return $result;
		}
	}
?>