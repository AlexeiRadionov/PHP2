<?php
	include 'Gallery.class.php';
	include 'Images.class.php';
	include 'Twig/Autoloader.php';
	Twig_Autoloader::register();

	try {
	  $loader = new Twig_Loader_Filesystem('templates');
	  
	  $twig = new Twig_Environment($loader);
	  
	  $template = $twig->loadTemplate('gallery.tmpl');

	  echo $template->render(array('images' => $objImages -> getImages()));
	  
	} catch (Exception $e) {
	  die ('ERROR: ' . $e->getMessage());
	}
?>