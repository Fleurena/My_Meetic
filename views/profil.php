<?php
if(session_status() == PHP_SESSION_NONE){
require('../modeles/session.php');

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

	<div class="profil">
		<img src="../images/profil_love.png" alt="profil">
		<div class="informations">
			<h1><?= $_SESSION['nom']. ' '. $_SESSION['prenom']; ?></h1>

			<h3 class="profil_compte"><?= "Né(e) le : ". $_SESSION['naissance']; ?></h3>
			<h3 class="profil_compte"><?= "Age : ". $_SESSION['age']; ?></h3>
			<h3 class="profil_compte"><?= "Habite à : ". $_SESSION['ville']; ?></h3>
			<h3 class="profil_compte"><?= "Sexe : ". $_SESSION['sexe']; ?></h3>
			<h3 class="profil_compte"><?= "Email : ". $_SESSION['email']; ?></h3>
			<h3 class="profil_compte"><?= "Inscrit(e) le : ". $_SESSION['inscription']; ?></h3>

		</div>
	</div>
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