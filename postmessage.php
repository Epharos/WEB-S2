<?php
	session_start();
	$file = "messages.txt";
	$line = PHP_EOL . time() . '×' . $_SESSION['username'] . '×' . $_REQUEST['content'];
	file_put_contents("messages.txt", $line, FILE_APPEND);
	echo 'OK';
?>