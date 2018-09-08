<?php
session_start();
//подключаем все классы
include '../model/DataBase.class.php';
include '../model/Gallery.class.php';
function __autoload($className) {
	include "../model/$className.class.php";
}
//подключаем контроллеры
include '../controller/controllerMain.php';
include '../controller/controllerAddFeedback.php';

//Запускаем главный контроллер
prepareVariables($page_name, $action);