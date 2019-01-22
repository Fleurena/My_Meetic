<?php
require('modeles/database.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>My meetic</title>
	<link rel="stylesheet" type="text/css" href="views/style.css">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
</head>
<body>

<header>
	<a href="views/connexion.php" class="Connexion">
		<h1>Connexion</h1>
	</a>
</header>

<div class="container_all">
<h2 id="inscrivez">Inscrivez-</h2>
<h2 id="vous">Vous</h2>
	<div class="container">
			<img src="images/logo_accueil.png">
		<form method="post" action="index.php">
			<p>
				<label for="nom">Nom</label>
				<input type="text" name="nom" id="nom"><br>

				<label for="prenom">Prénom</label>
				<input type="text" name="prenom" id="prenom"><br>

				<label for="i_am">Je suis :</label>
				<select name="sexe" id="i_am">
					<option value="femme" id="i_am_f">Femme</option>
					<option value="homme" id="i_am_h">Homme</option>
					<option value="autre" id="i_am_a">Autre</option>
				</select><br>

				<label for="naissance">Né(e) le :</label>
				<input type="Date" name="naissance" id="naissance"><br>

				<label for="ville">Ville :</label>
				<input type="text" name="ville" id="ville"><br>

				<label for="email">email :</label>
				<input type="text" name="email" id="email"><br>

				<label for="pass">Mot de passe :</label>
				<input type="password" name="pass" id="pass"><br>

				<label for="re_pass">Retaper le<br>
				mot de passe :</label>
				<input type="password" name="re_pass" id="re_pass"><br>

				<input type="submit" name="submit" id="submit">
			</p>
		</form>

		<?php if(!empty($_POST)){ ?>
			<div class="messages">
				<?php 
					$connexion->insert_form();
					$connexion->isMailExist();
				?>
			</div>
		<?php } ?>
	</div>
</div>

</body>
</html>