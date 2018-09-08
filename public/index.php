<?php
session_start();
//подключаем все библиотеки
include '../model/DataBase.class.php';
include '../model/Gallery.class.php';
function __autoload($className) {
	include "../model/$className.class.php";
}
include '../controller/controllerMain.php';
include '../controller/controllerAddFeedback.php';

//Запускаем главный контроллер
prepareVariables($page_name, $action);