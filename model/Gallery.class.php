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
	}
?>