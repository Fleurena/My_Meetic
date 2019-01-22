<?php

class Delete
{
	public function del()
	{
		session_start();

		unset($_SESSION['id']);
		unset($_SESSION['prenom']);
		unset($_SESSION['nom']);
		unset($_SESSION['naissance']);
		unset($_SESSION['age']);
		unset($_SESSION['sexe']);
		unset($_SESSION['email']);
		unset($_SESSION['ville']);
		unset($_SESSION['inscription']);

		header('Location: ../views/connexion.php');
	}

}

$delete = new Delete();
$delete->del();