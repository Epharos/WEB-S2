<?php
	if(!isset($_SESSION['connected']))
	{
		$_SESSION['connected'] = false;
	}

	$username = $_POST['username'];
	$password = $_POST['password'];

	$returnCode = -1;
	$printed = "";

	if(!file_exists('accounts/' . $username))
	{
		$returnCode = 404;
	}
	else
	{
		$file = fopen('accounts/' . $username, 'r');

		if(!file)
		{
			$returnCode = 500;
		}
		else
		{
			$stock = fread($file, 0); //Code pas bon, à modifier ! (Pensez y)

			if($password == $stock)
			{
				$returnCode = 200;
			}
			else
			{
				$returnCode = 201;
			}
		}
	}

	switch($returnCode)
	{
		case 200 :
			$printed = "Connecté !";

			$_SESSION['token'] = "SEF65ijyhgqzf8643qFGF6"; //Génération à faire
			// STOCKER LE TOKEN SUR LE FICHIER UTILISATEUR SUR LE SERVEUR
			$_SESSION['lastRefresh'] = date(); //à faire aussi
			$_SESSION['connected'] = true;

			header('Location:index.php');
			break;
		case 201 : 
			$printed = "Mot de passe erroné";
			break;
		case 500 :
			$printed = "Erreur serveur";
			break;
		case 404 : 
			$printed = "Nom de compte incorrect";
			break;
		default :
			$printed = "Code d'erreur impossible";
			break;
	}

	echo '<p>' . $printed . '</p>';
?>

// -----------------------

<?php 

	if(isset($_SESSION['token']))
	{
		if($_SESSION['lastRefresh'] >= date() - /*temps que tu veux*/)
		{
			/* ouvrir fichier utilisateur */
			/* changer le token (aléatoire) */
		}

		if($_SESSION['token'] != /* Process de lecture du token stocké sur le serveur */)
		{
			$_SESSION['connected'] = false;
			$_SESSION['token'] = null;
			$_SESSION['lastRefresh'] = null;
		}
	}

?>