<?php
	class Admin extends Gallery {
		private $back;
		private $id;
		private $action;
	
		public function getBack() {
			return $this -> back;
		}

		public function getId() {
			return $this -> id;
		}

		public function getAction() {
			return $this -> action;
		}

		public function setter($back, $id, $action) {
			$this -> back = $back;
			$this -> id = $id;
			$this -> action = $action;
		}

		function __construct($back, $id = '', $action = '') {
			$this -> setter($back, $id, $action);
		}

		public function getOrders() {
			$sql = "SELECT * FROM `orders`, `users` WHERE orders.id_user = users.id_user ORDER BY orders.id_user,`status`";
			$orders = $this -> getAssocResult($sql);

			return $orders;
		}

		public function getOrderInfo() {
			$id_order = $this -> id;
			$sql = "SELECT * FROM `products_in_order`, `images`, `orders`, `users` WHERE orders.id_order = '$id_order' AND products_in_order.id_order = '$id_order' AND `id_product` = `id_image` AND orders.id_user = users.id_user";
			$orderInfo = $this -> getAssocResult($sql);

			return $orderInfo;
		}

		public function changeStatus() {
			$response = [
				'result' => 0
			];
			
			$status = $_POST['status'];
			foreach ($_POST as $key => $value) {
				if ($key == 'orders') {
					foreach ($value as $val) {
						$id_order = (int)$val;
						$sql = "UPDATE `orders` SET `status` = '$status' WHERE id_order = $id_order";
						$this -> executeQuery($sql);
						if (true) {
							$sql = "SELECT `id_order`, `status` FROM `orders` WHERE id_order = $id_order";
							$result = $this -> getAssocResult($sql);
							$response["$id_order"] = $result[0];
						}
					}
				}
			}
			$response['result'] = 1;

			return json_encode($response);
		}

		public function template() {
			include '../Twig/Autoloader.php';
			Twig_Autoloader::register();

			try {
			  $loader = new Twig_Loader_Filesystem('../templates');
			  
			  $twig = new Twig_Environment($loader);
			  
			  $template = $twig->loadTemplate('admin.tmpl');

			  echo $template->render(array(
			  	'back' => $this -> back,
			  	'user' => Auth::$auth,
			  	'orders' => $this -> getOrders(),
			  	'action' => $this -> action,
			  	'id_order' => $this -> id,
			  	'orderInfo' => $this -> getOrderInfo()
			  ));
			  
			} catch (Exception $e) {
			  die ('ERROR: ' . $e->getMessage());
			}	
		}
	}
?>