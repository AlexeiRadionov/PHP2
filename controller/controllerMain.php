<?php
	$url_array = explode("/", $_SERVER['REQUEST_URI']);

	if ($url_array[1] == "")
		$page_name = "index";
	else
		$page_name = $url_array[1];

	$action = '';
	if (!isset($_GET['id'])) {
		$action = $url_array[2];
	}

	function prepareVariables($page_name, $action) {
		$date = date('Y.m.d H:i:s');
		$id_session = session_id();
		$back = strip_tags($_GET['back']);
		if (isset($_GET['id'])) {
	        $id = (int)$_GET['id'];
	    }

	    $objAuth = new Auth();
	    
	    if ($objAuth -> alreadyLogin()) {
	    	$user = $_SESSION['login'];
	    	$objAuth -> setAuth($user);
	    } else {
	    	$objAuth -> setAuth();
	    }

		switch ($page_name) {
	        case 'index':
	            $objImages = new Images();
				$objImages -> template();
	            break;
	        case 'image':
	            $objImage = new Image($id, $id_session);
	            $objImage -> template();
	            break;
	        case 'catalog':
	            if ($action == '') {
	                $objCatalog = new Catalog($action);
					$objCatalog -> template();
	            } else {
	            	$objCatalog = new Catalog($action);
	            	echo $objCatalog -> addShowGoods();
	            }
	            break;
	        case 'login':
	            $login = $_POST['login'];
	            $pass = $_POST['pass'];
	            $objAuth -> getAuth($login, $pass);
	            header("Location: {$back}");
	            break;
	        case 'logout':
	            $_SESSION['login'] = null;
	            $_SESSION['pass'] = null;
	            header("Location: {$back}");
	            break;
	        case 'basket':
	            if ($action == '') {
	            	$objBasket = new Basket($id, $id_session, $action);
					$objBasket -> template();
	            } else {
	            	$objBasket = new Basket($id, $id_session, $action);
	            	echo $objBasket -> doActionWithBasket();
	            }
	            break;
	        case 'registration':
	        	$objRegistration = new Registration();
	        	if (isset($_POST['sendForm'])) {
	        		$login = $_POST['login'];
	        		$pass = $_POST['pass'];
	        		$email = $_POST['email'];
	        		if ($objRegistration -> addUser($login, $pass, $email)) {
	        			$objRegistration -> template();
	        		} else {
	        			header("Location: {$back}");
	        		}
	        	} else {
	        		$objRegistration -> template();
	        	}
	        	break;
	        case 'account':
	        	$objAccount = new Account($back);
	        	$objAccount -> template();
	        	break;
	        case 'orders':
	        	$objOrders = new Orders($id, $id_session, $action);
	        	$objOrders -> template();
	        	if ($user) {
	        		$objOrders -> addOrder($id_session, $user, $date);
	        	}
	        	break;
	    }
	}
?>