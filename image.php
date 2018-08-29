<?php
	session_start();

	if (isset($_POST['id'])) {
        $_SESSION["id"] = (int)$_POST['id'];
        header("Location: image.php");
    } else if (isset($_SESSION['id'])) {
        $id = (int)$_SESSION['id'];
    }

	include 'Gallery.class.php';
	include 'Image.class.php';
	include 'Twig/Autoloader.php';
	Twig_Autoloader::register();

	try {
	  $loader = new Twig_Loader_Filesystem('templates');
	  
	  $twig = new Twig_Environment($loader);
	  
	  $template = $twig->loadTemplate('image.tmpl');

	  echo $template->render(array(
	  	'image' => $objImage -> getImagesContent($id),
	  	'countPreview' => $objImage -> countPreview($id)
	));
	  
	} catch (Exception $e) {
	  die ('ERROR: ' . $e->getMessage());
	}
?>