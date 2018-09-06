<?php
	class Images extends Gallery {
		public function getImages() {
			$sql = "SELECT id, path_img FROM images WHERE 1 ORDER BY count_preview DESC";
		    $images = $this -> getAssocResult($sql);
		    return $images;
		}

		public function getFeedback() {
			$sql = "SELECT `name`, `text_fb`, `date` FROM feedback WHERE 1 ORDER BY `id` DESC";
		    $feedback = $this -> getAssocResult($sql);
		    return $feedback;
		}

		public function template() {
			include '../Twig/Autoloader.php';
			Twig_Autoloader::register();

			try {
			  $loader = new Twig_Loader_Filesystem('../templates');
			  
			  $twig = new Twig_Environment($loader);
			  
			  $template = $twig->loadTemplate('gallery.tmpl');

			  echo $template->render(array(
			  	'images' => $this -> getImages(),
			  	'feedback' => $this -> getFeedback()
			  ));
			  
			} catch (Exception $e) {
			  die ('ERROR: ' . $e->getMessage());
			}	
		}
	}
?>