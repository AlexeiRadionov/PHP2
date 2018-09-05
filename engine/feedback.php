<?php
	function addFeedback() {
		$name = $_GET['userName'];
		$feedback = $_GET['feedback'];
		$date = date('Y.m.d H:i:s');

		$sql = "INSERT INTO `feedback`(`name`, `text_fb`, `date`) VALUES ('$name', '$feedback', '$date')";
    	executeQuery($sql);

    	header('Location: /');
	}

	if (isset($_GET['send'])) {
		addFeedback();
	}
?>