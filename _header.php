<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title><?= $titre ?></title>
	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>

<body>
	<header>
		<nav>
			<ul class="menu">
				<li><a href="accueil.php">Acceuil</a></li>
				<li><a href="fiche_membre.php">Ma fiche</a></li>
				<li><a href="mes_messages.php">Mes messages</a></li>
				<li><a href="gestion_des_membres.php">Gestion des membres(admin)</a></li>
				<li><a href="Connexion.php" onclick="return confirm('Etes-vous sûr de vouloir retourner à la page de connexion?')">Déconnexion</a></li>
			</ul>
		</nav>
	</header>