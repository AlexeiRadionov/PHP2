<?php
	class Account extends Gallery {
		private $back;

		public function getBack() {
			return $this -> back;
		}

		public function setter($back) {
			$this -> back = $back;
		}

		function __construct($back) {
			$this -> setter($back);
		}

		public function template() {
			include '../Twig/Autoloader.php';
			Twig_Autoloader::register();

			try {
			  $loader = new Twig_Loader_Filesystem('../templates');
			  
			  $twig = new Twig_Environment($loader);
			  
			  $template = $twig->loadTemplate('account.tmpl');

			  echo $template->render(array(
			  	'back_url' => $_SERVER['REQUEST_URI'],
			  	'back' => $this -> back,
			  	'auth' => Auth::$auth,
			  	'user' => Auth::$auth
			  ));
			  
			} catch (Exception $e) {
			  die ('ERROR: ' . $e->getMessage());
			}	
		}
	}
?>