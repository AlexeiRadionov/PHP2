<?php
session_start();
//подключаем все библиотеки
include '../engine/Gallery.class.php';
function __autoload($className) {
	include "../engine/$className.class.php";
}

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
	if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
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
            auth($login, $pass);
            header("Location: {$back}");
            break;
        case 'logout':
            unset($_SESSION['login']);
            unset($_SESSION['pass']);
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

prepareVariables($page_name, $action);
