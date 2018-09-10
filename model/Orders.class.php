<?php
	class Orders extends Basket {
		public function addOrder($id_session, $user, $date) {
			$sql = "SELECT `id_session` FROM `basket` WHERE `id_session` = '$id_session'";
			$result = $this -> getAssocResult($sql);
			$id_session = $result[0]['id_session'];
			
			$sql = "SELECT `id_user` FROM users WHERE `login` = '$user'";
			$login = $this -> getAssocResult($sql);
			$id_user = $login[0]['id_user'];
			
			$amount = $this -> getSumProduct();
			$count = $this -> getCountProduct();

			$sql = "INSERT INTO `orders`(`id_session`, `id_user`, `status`, `count`, `amount`, `date`) VALUES ('$id_session', '$id_user', 'В обработке', '$count', '$amount', '$date')";
			$this -> executeQuery($sql);
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