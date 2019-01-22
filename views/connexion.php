<?php
require('../modeles/session.php');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>My meetic</title>
	<link rel="stylesheet" type="text/css" href="style_connexion.css">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
</head>
<body>

	<div class="inscription">
	<a href="../index.php">
		<h1>Inscription</h1>
	</a>
	</div>

<div class="container_all">
<h2 id="inscrivez">Connectez-</h2>
<h2 id="vous">Vous</h2>
	<div class="container">
		<img src="../images/logo_accueil.png">
		<form method="post" action="profil.php">
			<p>
				<label for="email">email :</label>
				<input type="text" name="email" id="email"><br>

				<label for="pass">Mot de passe :</label>
				<input type="password" name="pass" id="pass"><br>

				<input type="submit" name="submit" id="submit">
			</p>
		</form>

			<?php if(isset($_SESSION['flash'])): ?>
		<div class="messages">
		    <?php foreach ($_SESSION['flash'] as $type => $message): ?>
		        <?= $message; ?>
		    <?php endforeach; ?>
		    <?php unset($_SESSION['flash']); ?>
		</div>
		    <?php endif; ?>
	</div>
</div>

</body>
</html>