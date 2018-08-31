<?php
	class Image extends Gallery {
		private $id;

		public function getId() {
			return $this -> id;
		}

		public function setter($id) {
			$this -> id = $id;
		}

		function __construct($id) {
			$this -> setter($id);
		}

		public function getImages(){
		    $sql = "SELECT `path_img` FROM `images` WHERE id = " . $this -> id;
		    $images = $this -> getAssocResult($sql);

			//В случае если изображения нет, вернем пустое значение
		    $result = [];
		    if(isset($images[0]))
		        $result = $images[0];
		    
		    return $result;
		}

		public function countPreview() {
		    $sql = "UPDATE `images` SET `count_preview` = `count_preview` + 1 WHERE id = " . $this -> id;
		    $this -> executeQuery($sql);
		    
		    $sql = "SELECT `count_preview` FROM `images` WHERE id = " . $this -> id;
		    $count = $this -> getAssocResult($sql);
		    
		    return $count[0]['count_preview']; 
		}
	}

	$objImage = new Image($id);
?>