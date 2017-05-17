<?php
	session_start();
	$file = "messages.txt";
	require "lyraPOO.php";
	$bdd = new BDD;
	$messages = array_reverse($bdd->getMessages(null, $_REQUEST['time']));

	$i = 0;

	foreach ($messages as $m)
	{
		$i++;
		$i = $i % 2;

		echo '<hr style="border : none; height : 1px; width : 100%; background-color : gray;">';

		echo '<div class="message' . $i . '">';

		$userpseudo = "";

		if(!file_exists('accounts/' . $m->getUser() . '/avatar.png'))
		{
			echo '<img src="img/default/avatar.png" class="profilepicturem">';
		} 
		else
		{
			echo '<img src="accounts/' . $m->getUser() . '/avatar.png" class="profilepicturem">';
		}

		if(!file_exists("accounts/" . $m->getUser()))
		{
			
		}
		else
		{
			$fname = "accounts/" . $m->getUser() . "/account.txt";
			$file = fopen($fname, "r");

			if(!$file)
			{
				
			}
			else
			{
				$content = fread($file, filesize($fname));
				$userpseudo = explode(PHP_EOL, $content)[1];
			}

			fclose($file);
		}

		echo '<h3 class="messageuser">' . $userpseudo . '</h3><h4 class="messagepseudo">' . $m->getUser() . '</h4><br>';
		echo '<p class="messagecontent">' . $m->getContent() . '</p>';
		echo '<p class="messagedate" style="font-size : 11px; color : darkgray;">' . date("d/m/Y G:i:s", intval($m->getTime())) . '</p>';
		echo '</div>';
	} 

	echo '<hr style="border : none; height : 1px; width : 100%; background-color : gray;">';
?>