<?php

	if(!file_exists("accounts/" . $_POST['username']))
	{
		mkdir("accounts/" . $_POST['username']);
	}
	
	$file = fopen("accounts/" . $_POST['username'] . "/account.psw", "x") or die("Le compte existe deja");

	if(!$file)
	{
		echo 'Ce compte existe déjà ...';
		echo '<a href="index.php">Retour à l\'index</a>';
	}
	else
	{
		fwrite($file, $_POST['password']);
	}

	fclose($file);
	header('index.php');
?>