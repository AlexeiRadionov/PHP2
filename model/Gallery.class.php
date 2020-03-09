<?php
	abstract class Gallery {
		abstract protected function template();

		public function getAssocResult($sql) {
			$objDataBase = DataBase::getInstance();
			$result = $objDataBase -> getAssocResult($sql);

			return $result;
		}

		public function executeQuery($sql) {
			$objDataBase = DataBase::getInstance();
			$result = $objDataBase -> executeQuery($sql);

			return $result;
		}

		public function lastInsertId() {
			$objDataBase = DataBase::getInstance();
			$result = $objDataBase -> getDb() -> lastInsertId();

			return $result;
		}

		public function getIdUser($user) {
			$sql = "SELECT `id_user` FROM users WHERE `login` = '$user'";
			$login = $this -> getAssocResult($sql);
			$id_user = $login[0]['id_user'];

			return $id_user;
		}
	}
?>