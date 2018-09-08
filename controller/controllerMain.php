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
		$id_session = session_id();
		$back = strip_tags($_GET['back']);
		if (isset($_GET['id'])) {
	        $id = (int)$_GET['id'];
	    }

	    $objAuth = new Auth();
	    
	    if ($objAuth -> alreadyLogin()) {
	    	$page_item = 'logout_item';
	    	$user = $_SESSION['login'];
	    	$objAuth -> setAuth($page_item, $user);
	    } else {
	    	$page_item = 'login_item';
	    	$objAuth -> setAuth($page_item);
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
	    }
	}
?>