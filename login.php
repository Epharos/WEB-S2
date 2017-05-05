<?php session_start() ?>

<?php
	$username = $_POST['username'];
	$password = $_POST['password'];

	$returnedCode = -1;

	if(!file_exists("accounts/" . $username))
	{
		$returnedCode = 30;
	}
	else
	{
		$fname = "accounts/" . $username . "/account.txt";
		$file = fopen($fname, "r");

		if(!file)
		{
			$returnedCode = 31;
		}
		else
		{
			$content = fread($file, filesize($fname));
			$fpass = split(PHP_EOL, $content)[0];

			if($password == $fpass)
			{
				$returnedCode = 20;
				$_SESSION['username'] = $username;
				$_SESSION['pusername'] = split(PHP_EOL, $content)[1];
				$_SESSION['connected'] = "1";
			}
			else
			{
				$returnedCode = 21;
			}
		}

		fclose($file);
	}
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
				echo 'ta race';
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
					switch($returnedCode)
					{
						case 20 :
							header('Location: index.php');
							break;
						case 21 :
							echo '<p id="welcome">Il semblerait que votre mot de passe ne soit pas le bon :(<br>Peut-être va t-il vous <a href="index.php">revenir</a> ?</p>';
							break;
						case 30 :
							echo '<p id="welcome">Il semblerait que vous vous êtes trompé dans votre nom de compte :(<br>Peut-être va t-il vous <a href="index.php">revenir</a> ?</p>';
							break;
						case 31 :
							echo '<p id="welcome">Vous avez fait tellement d\'effet à notre serveur qu\'il n\'a pas pu ouvrir votre fichier :o<br>Peut-être va t-il revenir si vous <a href="index.php">réessayez</a> ?</p>';
							break;
						default :
							case 30 :
							echo '<p id="welcome">Le code retourné par notre serveur n\'est même pas valable >.<<br>Peut-être va t-il <a href="index.php">revenir</a> à la normale ?</p>';
							break;
					}
				?>
			</div>
		</div>
	</body>
</html>