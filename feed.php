<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/feed.css">

		<?php
			include('header.php');
		?>

		<script>
			function remaining(v)
			{
				var e = document.getElementById("remainingcharacters");

				e.innerHTML = (180 - v.length) + " caractères restants";
			}
		</script>
	</head>

	<body>
		<?php
			if(!isset($_SESSION['connected']) OR !isset($_SESSION['username']))
			{
				header('Location: index.php');
			}
		?>

		<div id="top">
			<div id="topcontent">
				<nav style="text-align:center;">
					<ul style="float:left">
						<li><a><i class="fa fa-home" aria-hidden="true"></i><span class="text">Lyra</span></a></li>
						<li><a><i class="fa fa-at" aria-hidden="true"></i><span class="text"><?php echo $_SESSION['username']; ?></span></a></li>
						<li><a><i class="fa fa-quote-right" aria-hidden="true"></i><span class="text">Mentions</span></a></li>
					</ul>

					<img src="img/index/logo2.png" alt="Logo de Lyra">

					<ul style="float:right">
						<li><a><i class="fa fa-cog" aria-hidden="true"></i><span class="text">Paramètres</span></a></li>
						<li><a href="disconnect.php"><i class="fa fa-sign-out" aria-hidden="true"></i><span class="text">Se déconnecter</span></a></li>
					</ul>
				</nav>
			</div>
		</div>

		<div id="bg">
			<div id="content">
				<div id="feed">
					<form action="" method="post" id="login">
						<input type="text" id="topost" name="topost" onkeydown="remaining(this.value);" placeholder="Dites à vos amis ce qui vous passe par la tête" style="width : 506px; margin : 10px 30px; font-size : 23px;" required>
						<p id="remainingcharacters">180 caractères restants</p>
						<button type="sumbit" style="display : none; hidden : hidden;"></button>
					</form>
				</div>

				<div id="right">
					<div id="personnalinfo">
						<?php 
							if(!file_exists('accounts/' . $_SESSION['username'] . '/avatar.png'))
							{
								echo '<img src="img/default/avatar.png" class="profilepicture">';
							} 
							else
							{
								echo '<img src="accounts/' . $_SESSION['username'] . '/avatar.png" class="profilepicture">';
							}
						?>

						<h2 id="username"><?php echo $_SESSION['pusername']; ?></h2>
						<h3 id="pseudo"><?php echo $_SESSION['username']; ?></h3>

						<?php

							if(!file_exists("accounts/" . $_POST['username']))
							{
								mkdir("accounts/" . $_POST['username']);
							}

						?>

						<table id="infos">
							<tr id="first">
								<td>Yolo</td>
								<td>Yolo</td>
								<td>Yolo</td>
							</tr>

							<tr id="second">
								<td>messages</td>
								<td>followers</td>
								<td>likes</td>
							</tr>
						</table>
				</div>
				</div>
			</div>
		</div>
	</body>
</html>