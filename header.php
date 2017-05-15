<?php
	echo '<title>';

	if(isset($_SESSION['connected']) AND isset($_SESSION['username']))
	{
		echo 'Lyra - ' . $_SESSION['pusername'];
	}
	else
	{
		echo 'Lyra - Create. Share. Love.';
	}

	echo '</title>';

	echo '<meta charset="utf-8">';
	echo '<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
	echo '<link href="https://fonts.googleapis.com/css?family=Playfair+Display|Titillium+Web" rel="stylesheet">';
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">';
?>