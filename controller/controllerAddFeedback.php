<?php
	if (isset($_GET['send'])) {
		$name = $_GET['userName'];
		$feedback = $_GET['feedback'];
		$date = date('Y.m.d H:i:s');
		$objAddFeedback = new AddFeedback($name, $feedback, $date);
		$objAddFeedback -> addFeedback();
	}
?>