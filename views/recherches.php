<?php
if(session_status() == PHP_SESSION_NONE){
require('../modeles/recherches_modeles.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>My meetic</title>
	<link rel="stylesheet" type="text/css" href="style_profil.css">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
</head>
<body>
	<header>
		<?php
			include('header.php');
		?>
	</header>


<div class="recherches_container">
	<div class="container_form">
		<form class="form_recherches" action="recherches.php" method="post">
		<h1>Recherches</h1>
			<select class="select_recherches" name="sexe">
				<option value="null">Genres</option>
                    <?php foreach($mixte as $mixt): ?>
                    	<option value="<?= $mixt['sexe'] ?>" id="i_am_f"><?= $mixt['sexe'] ?></option>
                    <?php endforeach; ?>
			</select><br>

			<select class="select_recherches" name="age">
				<option value="null">Ages</option>
				<option value="18/25">18/25 ans</option>
				<option value="25/35">25/35 ans</option>
				<option value="35/45">35/45 ans</option>
				<option value="45+">45+ ans</option>
			</select><br>

			<div class="ville">
				<label for="paris">Paris :</label><input type="checkbox" name="ville[]" value="paris" id="paris"><br>
				<label for="lyon">Lyon :</label><input type="checkbox" name="ville[]" value="lyon" id="lyon"><br>
				<label for="toulouse">Toulouse :</label><input type="checkbox" name="ville[]" value="toulouse" id="toulouse"><br>
				<label for="marseille">Marseille :</label><input type="checkbox" name="ville[]" value="marseille" id="marseille"><br>
			</div>
			<input id="submit" type="submit" name="submit">
		</form>
	</div>


<div class="container_recherches_pretendants">
   	<p id="left-arrow">&lt;</p>
	<p id="right-arrow">></p>
	
	<?php foreach($genres as $genre): ?>
	<div class="pretendants">
		<img class="profil_recherches" src="../images/profil_love.png" alt="profil">
        <h2 class="h2_recherches"><?= $genre['nom']. " ". $genre['prenom']; ?></h2>
        <h3><?= $genre['ville']; ?></h3>
        <p><?= $genre['age'];?> ans</p>
	</div>
   	<?php endforeach;?>


   	<?php foreach($ages as $age): ?>
	<div class="pretendants">
		<img class="profil_recherches" src="../images/profil_love.png" alt="profil">
        <h2 class="h2_recherches"><?= $age['nom']. " ". $age['prenom']; ?></h2>
        <h3><?= $age['ville']; ?></h3>
        <p><?= $age['age'];?> ans</p>
	</div>
   	<?php endforeach; ?>

   	<?php foreach($city as $citys): ?>
	<div class="pretendants">
		<img class="profil_recherches" src="../images/profil_love.png" alt="profil">
        <h2 class="h2_recherches"><?= $citys['nom']. " ". $citys['prenom']; ?></h2>
        <h3><?= $citys['ville']; ?></h3>
        <p><?= $citys['age'];?> ans</p>
	</div>
   	<?php endforeach; ?>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

<script src="../js/menu.js"></script>
<script src="../js/slider.js"></script>

</body>
</html>