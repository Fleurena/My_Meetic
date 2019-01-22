<?php
session_start();
class Session
{
	private $bdd;
	public $email;
	public $pass;

	
	function __construct($bdd, $_username, $_password, $donnees)
	{
		$this->PDOConnexion($bdd, $_username, $_password);
		$this->email = $donnees['email'];
		$this->pass = $donnees['pass'];
	}

	function PDOConnexion($bdd, $_username, $_password)
	{
		try
		{
		    $this->bdd = new PDO('mysql:dbname='.$bdd.';host=127.0.0.1;charset=utf8', $_username, $_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		} 
		catch (Exception $e)
		{
		    die('Erreur : ' .$e->getMessage());
		}
	}

	public function is_delete_id()
	{
		if(isset($this->email) AND isset($this->pass))
		{
			$req = $this->bdd->prepare('SELECT id FROM delete_members WHERE email = :email');

			$req->bindValue(':email', $this->email);
			$req->execute();

			$donnees = $req->fetch();
			return $donnees;
		}
	}

	public function connexion()
	{
		$donnees = $this->is_delete_id();

		if(!$donnees)
		{
			if(isset($this->email) AND isset($this->pass))
			{
				$req = $this->bdd->prepare('SELECT * FROM membres WHERE email = :email');
				$req->bindValue(':email', $this->email);
				$datas = $req->execute();
				$datas = $req->fetch();


				$passwordCorrect = password_verify($this->pass, $datas['password']);

				if(empty($this->email) AND empty($this->pass))
				{
					header('Location: ../views/connexion.php');
					$_SESSION['flash']['error'] = "Champs vides";
				}

				if(!$datas OR isset($this->email) AND empty($this->pass)){
					header('Location: ../views/connexion.php');
				}

				if($passwordCorrect)
				{
					$_SESSION['id'] = $datas['id'];
					$_SESSION['prenom'] = $datas['prenom'];
					$_SESSION['nom'] = $datas['nom'];
					$_SESSION['sexe'] = $datas['sexe'];
					$_SESSION['naissance'] = $datas['naissance'];
					$_SESSION['age'] = $datas['age'];
					$_SESSION['email'] = $datas['email'];
					$_SESSION['ville'] = $datas['ville'];
					$_SESSION['inscription'] = $datas['date_inscription'];
				}
			}
		}
		else{
			header('Location: ../views/connexion.php');
			$_SESSION['flash']['error'] = "Ce compte n'existe plus";
		}
	}
}

if(!empty($_POST)){
$session = new Session('my_meetic', 'root', '', $_POST);
$session->connexion();
}