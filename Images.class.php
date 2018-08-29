<?php
	class Images extends Gallery {
		public function getImages() {
			$sql = "SELECT id, path_img FROM images WHERE 1 ORDER BY count_preview DESC";
		    $images = $this -> getAssocResult($sql);
		    return $images;
		}
	}

	$objImages = new Images();
?>