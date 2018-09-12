<?php
	class AddOrders extends Basket {
		public function addOrder($id_session, $user, $date) {
			$sql = "SELECT `id_user` FROM users WHERE `login` = '$user'";
			$login = $this -> getAssocResult($sql);
			$id_user = $login[0]['id_user'];
			
			$amount = $this -> getSumProduct();
			$count = $this -> getCountProduct();

			$sql = "INSERT INTO `orders`(`id_session`, `id_user`, `status`, `count`, `amount`, `date`) VALUES ('$id_session', '$id_user', 'В обработке', '$count', '$amount', '$date')";
			if ($this -> executeQuery($sql)) {
				$lastInsert = $this -> lastInsertId();
				$sql = "SELECT `id_order`, `id_product`, `quantity` FROM `orders`, `basket` WHERE orders.id_order = '$lastInsert' AND basket.id_session = '$id_session'";
				$result = $this -> getAssocResult($sql);
				
				foreach ($result as $value) {
					$id_order = $value['id_order'];
					$id_product = $value['id_product'];
					$quantity = $value['quantity'];
					$sql = "INSERT INTO `products_in_order`(`id_order`, `id_product`, `quantity`) VALUES ('$id_order', '$id_product', '$quantity')";
					$this -> executeQuery($sql);	
				}
			}
		}

		public function template() {
			include '../Twig/Autoloader.php';
			Twig_Autoloader::register();

			try {
				$loader = new Twig_Loader_Filesystem('../templates');
				  
				$twig = new Twig_Environment($loader);
				  
				$template = $twig->loadTemplate('orders.tmpl');

				echo $template->render(array(
				  	'auth' => Auth::$auth,
				  	'back_url' => $_SERVER['REQUEST_URI']
				));
			  
			} catch (Exception $e) {
			  die ('ERROR: ' . $e->getMessage());
			}
		}
	}
?>