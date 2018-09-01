<?php

//Константы ошибок
define('ERROR_NOT_FOUND', 1);
define('ERROR_TEMPLATE_EMPTY', 2);

function renderPage($page_name, $variables = [], $isAjax = false)
{
	$full_result = null;

    if (!$isAjax) {
        //дополним до полного имени файл шаблона из имени страницы page_name
        $file = TPL_DIR . "/" . $page_name . ".tpl";

        //Если шаблон отсутствует выведем ошибку
        if (!is_file($file)) {
            echo 'Template file "' . $file . '" not found';
            exit(ERROR_NOT_FOUND);
        }

        //Если шаблон есть но пустой тоже выведем ошибку
        if (filesize($file) === 0) {
            echo 'Template file "' . $file . '" is empty';
            exit(ERROR_TEMPLATE_EMPTY);
        }

        // если переменных для подстановки не указано, просто
        // возвращаем шаблон как есть
        if (empty($variables)) {
              $templateContent = file_get_contents($file);
        }
        else {
            $templateContent = file_get_contents($file);

            // заполняем значениями если variables не пустая и нужно делать замену
            $templateContent = pasteValues($variables, $page_name, $templateContent);
        }
        //возвращаем текст шаблона
        $full_result = $templateContent;
    } else {
        $full_result = $variables['response'];
    }
    
    return $full_result;
}

function pasteValues($variables, $page_name, $templateContent){
	//перебираем массив замен
    foreach ($variables as $key => $value) {
        $result = "";
        $p_key = '{{' . strtoupper($key) . '}}';
        if ($value != null) {
            if(is_array($value)){
                foreach ($value as $value_key => $item) {
                    $itemTemplateContent = file_get_contents(TPL_DIR . "/" . $page_name . '_' . $key . "_item.tpl");

                    foreach ($item as $item_key => $item_value) {
                         $i_key = '{{' . strtoupper($item_key) . '}}';
                         $itemTemplateContent = str_replace($i_key, $item_value, $itemTemplateContent);
                    } 
                    
                    $result .= $itemTemplateContent;
                }
            } else {
                $result = $value;
            }
        }

        $templateContent = str_replace($p_key, $result, $templateContent);
    }

    return $templateContent;
}

function prepareVariables($page_name, $action){
    $vars = [];
    $id_session = session_id();
    $back = strip_tags($_GET['back']);
    
    if (AlreadyLogin()) {
        $clear_vars['user'] = $_SESSION['login'];
        $clear_vars['back_url'] = $_SERVER['REQUEST_URI'];
        $vars['login'] = renderPage('logout_item', $clear_vars);
    } else {
        $vars['login'] = renderPage('login_item', ['back_url' => $_SERVER['REQUEST_URI']]);
    }
    
	//в зависимости от того, какую страницу вызываем
	//такой блок кода для нее и выполняем
    switch ($page_name) {
        case 'index':
            $vars['gallery'] = getImages();
            $vars['feedback'] = getFeedback();
            break;
        case 'image':
            if (isset($_GET['id'])) {
                $id = (int)$_GET['id'];
            }
            $content = getImagesContent($id);
            $vars['preview'] = countPreview($id);
            $vars['idimage'] = $content["id_image"];
            $vars['image'] = $content["path_img"];
            $vars['description'] = $content["description"];
            $vars['price'] = $content["price"];
            $vars['countProduct'] = getCountProduct($id_session);
            break;
        case 'catalog':
            $countGoods = 5;
            if ($action == '') {
                $vars['catalog'] = showGoods($countGoods);
            } else {
                $vars['response'] = addShowGoods($action);
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
                $vars['basket'] = getBasket($id_session);
                $vars['countProduct'] = getCountProduct($id_session);
                $vars['sum'] = getSumProduct($id_session);
            } else {
                $vars['response'] = doActionWithBasket($action);
            }
            break;
    }
    
	//возвращаем готовый массив значения vars для шаблона 
    return $vars;
}
//функция логирования
function _log($s, $suffix='')
	{
		if (is_array($s) || is_object($s)) $s = print_r($s, 1);
		$s="### ".date("d.m.Y H:i:s")."\r\n".$s."\r\n\r\n\r\n";

		if (mb_strlen($suffix))
			$suffix = "_".$suffix;
			
		      _writeToFile($_SERVER['DOCUMENT_ROOT']."/_log/logs".$suffix.".log",$s,"a+");

		return $s;
	}

function _writeToFile($fileName, $content, $mode="w")
	{
		$dir=mb_substr($fileName,0,strrpos($fileName,"/"));
		if (!is_dir($dir))
		{
			_makeDir($dir);
		}

		if($mode != "r")
		{
			$fh=fopen($fileName, $mode);
			if (fwrite($fh, $content))
			{
				fclose($fh);
				@chmod($fileName, 0644);
				return true;
			}
		}

		return false;
	}

function _makeDir($dir, $is_root = true, $root = '')
        {
            $dir = rtrim($dir, "/");
            if (is_dir($dir)) return true;
            if (mb_strlen($dir) <= mb_strlen($_SERVER['DOCUMENT_ROOT'])) 
return true;
            if (str_replace($_SERVER['DOCUMENT_ROOT'], "", $dir) == $dir) 
return true;

            if ($is_root)
            {
                $dir = str_replace($_SERVER['DOCUMENT_ROOT'], '', $dir);
                $root = $_SERVER['DOCUMENT_ROOT'];
            }
            $dir_parts = explode("/", $dir);

            foreach ($dir_parts as $step => $value)
            {
                if ($value != '')
                {
                    $root = $root . "/" . $value;
                    if (!is_dir($root))
                    {
                        mkdir($root, 0755);
                        chmod($root, 0755);
                    }
                }
            }
            return $root;
        }

//функция возвращает массив всех изображений
function getImages(){
    $sql = "SELECT id, path_img FROM images WHERE 1 ORDER BY count_preview DESC";
    $images = getAssocResult($sql);
    return $images;
}

function getFeedback(){
    $sql = "SELECT `name`, `text_fb`, `date` FROM feedback WHERE 1 ORDER BY `id` DESC";
    $feedback = getAssocResult($sql);
    return $feedback;
}

function getImagesContent($id){
    $sql = "SELECT `id_image`, `path_img`, `description`, `price` FROM `images` WHERE id = " . $id;
    $images = getAssocResult($sql);

	//В случае если изображения нет, вернем пустое значение
    $result = [];
    if(isset($images[0]))
        $result = $images[0];
    
    return $result;
}

function countPreview($id) {
    $sql = "UPDATE `images` SET `count_preview` = `count_preview` + 1 WHERE id = " . $id;
    executeQuery($sql);
    
    $sql = "SELECT `count_preview` FROM `images` WHERE id = " . $id;
    $count = getAssocResult($sql);
    
    return $count[0]['count_preview']; 
}

function getBasket($id_session) {
    $sql = "SELECT * FROM `basket`, `images` WHERE id_session = '$id_session' AND id_product = `id_image`";
    $basket = getAssocResult($sql);
    if (empty($basket)) {
        $basket = 'Ваша корзина пуста';
    }
    return $basket;
}

function showGoods($countGoods) {
    $sql = "SELECT `id_image`, `path_img`, `description`, `price` FROM `images` LIMIT $countGoods";
    $catalog = getAssocResult($sql);
    
    return $catalog;
}

function addProduct($id, $id_session, &$response) {
    $sql = "SELECT * FROM `basket` WHERE id_session = '$id_session' AND id_product = " . $id;
    $result = getAssocResult($sql);

    if (empty($result)) {
        $sql = "INSERT INTO `basket`(`id_session`, `id_product`, `quantity`) VALUES ('$id_session', '$id', 1)";
    } else {
        $sql = "UPDATE `basket` SET `quantity` = `quantity` + 1 WHERE id_session = '$id_session' AND id_product = " . $id;
    }
    
    if(executeQuery($sql)) {
        $response['result'] = 1;
        $response['countProduct'] = getCountProduct($id_session);
    }
}

function removeProduct($id, $id_session, &$response) {
    $sql = "SELECT `id`, `id_product`, `quantity` FROM `basket` WHERE id_session = '$id_session' AND id_product = " . $id;
    $result = getAssocResult($sql);

    if ($result[0]['quantity'] > 1) {
        $sql = "UPDATE `basket` SET `quantity` = `quantity` - 1 WHERE id = " . $result[0]['id'];
    } else {
        $sql = "DELETE FROM `basket` WHERE id = " . $result[0]['id'];
    }
    
    if(executeQuery($sql)) {
        $response['result'] = 1;
        $response['countProduct'] = getCountProduct($id_session);
        $response['sum'] = getSumProduct($id_session);
        $response['id_product'] = $id;
        $response['quantity'] = $result[0]['quantity'] - 1;
    }
}

function getCountProduct($id_session) {
    $countProduct = '';
    $basket = getBasket($id_session);
    if (is_array($basket)) {
        foreach ($basket as $value) {
            $countProduct += (int)$value['quantity'];
        }
    }
    return $countProduct;
}

function getSumProduct($id_session) {
    $sum = '';
    $basket = getBasket($id_session);
    if (is_array($basket)) {
        foreach ($basket as $value) {
            $sum += (int)$value['quantity'] * (float)$value['price'];
        }
    }
    return sprintf("%.2f", $sum);
}

function doActionWithBasket($action){
    $id_session = session_id();
    $response = [
        "result" => 0,
        "countProduct" => 0,
        "sum" => 0,
        "quantity" => 0
    ];

    switch($action){
        case "add":
            $id = (int)$_POST['id_good'];
            addProduct($id, $id_session, $response);
            break;
        case "remove":
            $id = (int)$_POST['id_basket'];
            removeProduct($id, $id_session, $response);
            break;
    }
    
    return json_encode($response);
}

function addShowGoods($action){
    $response = [
        "result" => 0
    ];

    if ($action == 'addShowGoods') {
        $countGoods = (int)$_POST['countGoods'];
        $result = showGoods($countGoods);
        $sql = "SELECT COUNT(*) FROM `images`";
        $count = getAssocResult($sql);
        if ($countGoods >= $count[0]['COUNT(*)']) {
            $response['answer'] = 1;
        }
        $response['result'] = 1;
        foreach ($result as $key => $value) {
            $response["$key"] = $value;
        }
    }
    
    return json_encode($response);
}