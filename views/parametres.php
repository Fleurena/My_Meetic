<?php
if(session_status() == PHP_SESSION_NONE){
require('../modeles/parametres.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>My meetic</title>
	<link rel="stylesheet" type="text/css" href="style_profil.css">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
<script
  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
</head>
<body>
	<header>
	<?php
		include('header.php');
	?>
</header>

<div class="container_body">
	<h2>Changer le mot de passe</h2>

	<form action="parametres.php" method="post">
		<p>
			<label for="pass">Mot de passe actuel :</label>
			<input type="password" name="pass" id="pass"><br>
			<label for="new_pass">Nouveau mot de passe :</label>
			<input type="password" name="new_pass" id="new_pass"><br>
			<label for="re_new_pass">Confirmation du mot de passe :</label>
			<input type="password" name="re_new_pass" id="re_new_pass"><br>
			<input type="submit" name="submit" class="sub">
		</p>
	</form>

	<?php if(isset($_SESSION['flash'])): ?>
    <?php foreach ($_SESSION['flash'] as $type => $message): ?>
        <?= $message; ?>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

	<h2>Changer l'adresse mail</h2>
    <form action="parametres.php" method="post">
		<p>
			<label for="new_mail">Nouveau mail :</label>
			<input type="text" name="new_mail" id="new_mail"><br>
			<input type="submit" name="submit" class="sub">
		</p>
	</form>

	<?php if(isset($_SESSION['flash'])): ?>
    <?php foreach ($_SESSION['flash'] as $type => $message): ?>
        <?= $message; ?>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>


	<h2>Supprimer le compte</h2>
	<form action="parametres.php" method="post">
		<p>
			<label for="new_mail">Êtes-vous sûr de vouloir supprimer votre compte ?</label>
			<select id="select_compte" name="compte">
				<option value="oui">Oui</option>
				<option value="non">Non</option>
			</select><br>
			<input type="submit" name="submit" class="sub">
		</p>
	</form>
</div>

<script>
	$(document).ready(function(){
		$('.menu li').hover(function(){
			$('ul:first',this).css({visibility:"visible"});
		}, function(){
			$('ul:first',this).css({visibility:"hidden"});
		});
	});
</script>
</body>
</html>