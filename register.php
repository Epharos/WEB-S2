<?php session_start() ?>

<?php
	$code = 0;

	if(!file_exists("accounts/" . $_POST['username']))
	{
		mkdir("accounts/" . $_POST['username']);
	}
	
	$file = fopen("accounts/" . $_POST['username'] . "/account.txt", "x");
	if(!$file)
	{
		$code = 2;
	}
	else
	{
		$code = 1;
		fwrite($file, $_POST['password'] . PHP_EOL . $_POST['pusername']);
	}
	fclose($file);
?>

<DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/register.css">

		<?php
			include('header.php');	
		?>
	</head>

	<body>
		<?php
			if(isset($_SESSION['connected']) AND isset($_SESSION['username']))
			{
				header('Location: feed.php');
			}
		?>

		<div id="contentindex">
			<div id="top">
				<div id="topcontent">
					<nav>
						<ul>
							<li><a><i class="fa fa-home" aria-hidden="true"></i><span class="text">Lyra</span></a></li>
							<li><a><span class="text">A propos</span></a></li>
						</ul>
					</nav>

					<img src="img/index/logo2.png" alt="Logo de Lyra">
				</div>
			</div>

			<div id="drawn">
				<?php 
					if($code == 1)
					{
						echo '<p id="welcome">Bonjour ' . $_POST['username'] . ' ! Merci pour votre inscription sur Lyra :)<br>
						<a href="index.php">Connectez-vous</a> pour profiter de votre inscription !</p>';
					}
					else
					{
						echo '<p id="welcome">Désolé ' . $_POST['username'] . ' votre inscription n\'a pas pu être validée, un utilisateur porte déjà votre nom :(<br>
						Essayez de vous <a href="index.php">inscrire à nouveau</a> avec un autre pseudonyme ?</p>';
					}
				?>
			</div>
		</div>
	</body>
</html>