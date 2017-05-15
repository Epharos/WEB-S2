<?php session_start() ?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/index.css">

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

			<div id="leftside">
				<div id="leftcontent">
					<h1>Bienvenue sur Lyra</h1>
					<h2>Create. Share. Love.</h2>

					<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget sem tempor, mattis enim porta, interdum mi. Donec et nisl interdum, porttitor ipsum vitae, pharetra est. Duis ultrices, nisi ut ultrices tempus, nisl massa suscipit purus, eget rhoncus risus nisi ac lorem. Etiam nec interdum turpis, eu interdum felis. Nam turpis orci, molestie vel efficitur id, commodo sit amet ante. Suspendisse suscipit sit amet magna ac hendrerit. Phasellus a fringilla mi. Donec pretium ligula venenatis est imperdiet, sit amet aliquet massa congue.<br><br>

						Aenean pretium urna quis lacus bibendum, ac interdum purus vehicula. Sed aliquam arcu tristique malesuada maximus. Duis sed lacinia dolor. Aenean imperdiet erat in pretium luctus. Quisque velit lorem, hendrerit sit amet velit vel, tempor bibendum augue. Maecenas et sodales dolor. Maecenas tincidunt egestas viverra. Nullam mollis tellus porttitor ligula cursus, id ultrices massa consectetur. Aliquam nisl diam, egestas a ipsum at, mattis imperdiet purus.
					</p>
				</div>
			</div>

			<div id="rightside">
				<div id="rightcontent">
					<h2>Connectez-vous</h2>
					<form action="test.php" method="post" id="login">
						<input type="text" name="username" placeholder="Nom de compte" style="width : 275px; margin : 5px auto;" required><br>
						<input type="password" name="password" placeholder="Mot de passe" style="width : 275px; margin : 5px auto;" required>
						<button type="sumbit" style="display : none; hidden : hidden;"></button>
					</form>

					<a style="display : block;" href="javascript:{}" onclick="document.getElementById('login').submit();">Se connecter <i class="fa fa-sign-in" aria-hidden="true"></i></a>

					<hr style="height : 1px; background-color : white; border : none;">

					<h2>Inscrivez-vous</h2>
					<form action="register.php" method="post" id="register">
						<input type="text" name="username" placeholder="Nom de compte" style="width : 275px; margin : 5px auto;" required><br>
						<input type="text" name="pusername" placeholder="Pseudonyme" style="width : 275px; margin : 5px auto;" required><br>
						<input type="password" name="password" placeholder="Mot de passe" style="width : 275px; margin : 5px auto;" required>
						<button type="sumbit" style="display : none; hidden : hidden;"></button>
					</form>

					<a style="display : block;" href="javascript:{}" onclick="document.getElementById('register').submit();">Inscription <i class="fa fa-sign-in" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
	</body>
</html>