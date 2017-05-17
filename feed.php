<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/feed.css">

		<?php
			include('header.php');
		?>

		<script>
			var time = new Date();

			window.onload = function()
			{
				adaptBackground();
				time = new Date();
			};

			function adaptBackground()
			{
				var e = document.getElementById("bg");
				var h = parseInt(document.getElementById("feed").clientHeight);
				e.style.height = h + "px";
			}

			function sub()
			{
				if(document.getElementById("topost").value.length <= 180)
				{
					ajax('postmessage.php?content=' + document.getElementById('topost').value, null); 
					document.getElementById('topost').value = '';
					ajax('updatefeed.php?time=' + Math.floor(time.getTime() / 1000), update);
					setTimeout(function() { time = new Date()}, 500);
					adaptBackground();
				}
			}

			function sub2()
			{
				if(document.getElementById("topost2").value.length <= 180)
				{
					ajax('postmessage.php?content=' + document.getElementById('topost2').value, null); 
					document.getElementById('topost2').value = '';
					ajax('updatefeed.php?time=' + Math.floor(time.getTime() / 1000), update);
					setTimeout(function() { time = new Date()}, 500);
					adaptBackground();
				}
			}

			function refresh()
			{
				ajax('updatefeed.php?time=' + Math.floor(time.getTime() / 1000), update);
				setTimeout(function() { time = new Date()}, 500);
				adaptBackground();
			}

			function remaining()
			{
				var e = document.getElementById("remainingcharacters");
				var v = document.getElementById("topost").value;

				e.innerHTML = (180 - v.length) + " caractères restants";

				if(180 - v.length >= 0)
				{
					e.style.color = "black";
				}
				else
				{
					e.style.color = "red";
				}
			}

			function remaining2()
			{
				var e = document.getElementById("remainingcharacters2");
				var v = document.getElementById("topost2").value;

				e.innerHTML = (180 - v.length) + " caractères restants";

				if(180 - v.length >= 0)
				{
					e.style.color = "black";
				}
				else
				{
					e.style.color = "red";
				}
			}

			function ajax(u, func)
			{
				var xhttp;
				xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() 
				{
				    if (this.readyState == 4 && this.status == 200) 
				    {
				      	func(this);
				    }
			  	};

			  	xhttp.open("GET", u, true);
			  	xhttp.send();
			}

			function update(xhttp)
			{
				var e = document.getElementById("feedmessages");
				e.innerHTML = xhttp.responseText + e.innerHTML;
				var v = document.getElementById("feedmessages2");
				v.innerHTML = xhttp.responseText + v.innerHTML;
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

		<div id="top" class="hide-mini">
			<div id="topcontent">
				<nav style="text-align:center;">
					<ul style="float:left; padding : 0;" class="hide-small hide-medium">
						<li><a><i class="fa fa-home" aria-hidden="true"></i><span class="text">Lyra</span></a></li>
						<li><a><i class="fa fa-at" aria-hidden="true"></i><span class="text"><?php echo $_SESSION['username']; ?></span></a></li>
					</ul>

					<ul style="float:left; padding : 0;" class="hide-big">
						<li><a><i class="fa fa-home" aria-hidden="true"></i></a></li>
						<li><a><i class="fa fa-at" aria-hidden="true"></i></a></li>
						<li><a><i class="fa fa-quote-right" aria-hidden="true"></i></a></li>
					</ul>

					<img src="img/index/logo2.png" alt="Logo de Lyra">

					<ul style="float:right; padding : 0;" class="hide-small hide-medium">
						<li><a><i class="fa fa-cog" aria-hidden="true"></i><span class="text">Paramètres</span></a></li>
						<li><a href="disconnect.php"><i class="fa fa-sign-out" aria-hidden="true"></i><span class="text">Se déconnecter</span></a></li>
					</ul>

					<ul style="float:right; padding : 0;" class="hide-big">
						<li><a><i class="fa fa-cog" aria-hidden="true"></i></a></li>
						<li><a href="disconnect.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
					</ul>
				</nav>
			</div>
		</div>

		<div id="bg" class="hide-mini">
			<div id="content" class="hide-small hide-medium">
				<div id="feed">
					<form action="#" onsubmit="sub(); return false;" method="post">
						<input type="text" id="topost" name="topost" onkeydown="window.setTimeout(function(){remaining()}, 1);" placeholder="Dites à vos amis comment vous vous sentez" style="width : 506px; margin : 10px 30px; font-size : 23px;" required>
						<p id="remainingcharacters">180 caractères restants</p>
						<button type="sumbit" style="display : none; hidden : hidden;"></button>
					</form>

					<hr style="border : none; height : 1px; width : 100%; background-color : gray;">
					<p id="refresh" onclick="refresh();"><i class="fa fa-refresh" aria-hidden="true"></i> Rafraîchir le fil d'actualité</p>

					<div id="feedmessages">

						<?php require "lyraPOO.php";

						$bdd = new BDD;
						$messages = array_reverse($bdd->getMessages());

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
						?>
					</div>
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
								<td><?php $nbrMessages = count($bdd->getMessages($_SESSION['username'])); 
										echo $nbrMessages; ?></td>
								<td>0</td>
								<td>0</td>
							</tr>

							<tr id="second">
								<td>message<?php if($nbrMessages > 1) echo 's';?></td>
								<td>followers</td>
								<td>likes</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div id="contents" class="hide-big">
				<div id="personnalinfos">
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
							<td><?php $nbrMessages = count($bdd->getMessages($_SESSION['username'])); 
									echo $nbrMessages; ?></td>
							<td>0</td>
							<td>0</td>
						</tr>

						<tr id="second">
							<td>message<?php if($nbrMessages > 1) echo 's';?></td>
							<td>followers</td>
							<td>likes</td>
						</tr>
					</table>
				</div>

				<div id="feeds">
					<form action="#" onsubmit="sub2(); return false;" method="post">
						<input type="text" id="topost2" name="topost2" onkeydown="window.setTimeout(function(){remaining2()}, 1);" placeholder="Dites à vos amis comment vous vous sentez" style="width : 90%; position : absolute; top : 5px; left : 50%; transform : translateX(-50%); font-size : 23px;" required>
						<div id="spacing"></div>
						<p id="remainingcharacters2">180 caractères restants</p>
						<button type="sumbit" style="display : none; hidden : hidden;"></button>
					</form>

					<hr style="border : none; height : 1px; width : 100%; background-color : gray;">
					<p id="refresh" onclick="refresh();"><i class="fa fa-refresh" aria-hidden="true"></i> Rafraîchir le fil d'actualité</p>

					<div id="feedmessages2">

						<?php
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
						?>
					</div>
				</div>				
			</div>
		</div>
	</body>
</html>