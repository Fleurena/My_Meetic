<?php

class Database
{
	private $bdd;
	public $nom;
	public $prenom;
	public $sexe;
	public $naissance;
	public $ville;
	public $email;
	public $pass;
	public $re_pass;

	
	function __construct($bdd, $_username, $_password, $donnees)
	{
		$this->PDOConnexion($bdd, $_username, $_password);
		$this->nom = $donnees['nom'];
		$this->prenom = $donnees['prenom'];
		$this->sexe = $donnees['sexe'];
		$this->naissance = $donnees['naissance'];
		$this->ville = $donnees['ville'];
		$this->email = $donnees['email'];
		$this->pass = $donnees['pass'];
		$this->re_pass = $donnees['re_pass'];
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

	public function isMailExist()
	{
		if(isset($this->email))
		{
			$req = $this->bdd->prepare('SELECT email FROM membres WHERE email = :email');

			$req->bindValue(':email', $this->email);
			$req->execute();

			$donnees = $req->fetch();
			return $donnees;
		}
	}

	public function age()
	{
		if(isset($this->naissance))
		{
			$annee = date_parse($this->naissance);
			$age = (date("Y") - $annee["year"]);

			return $age;
		}
	}

	public function insert_form()
	{
		$donnees = $this->isMailExist();
		$age = $this->age();

		if(!isset($this->nom) AND !isset($this->prenom) AND !isset($this->naissance) AND !isset($this->ville) AND !isset($this->email) AND !isset($this->pass) AND !isset($this->re_pass))
		{
			return null;
		}

		if(!empty($this->nom) AND !empty($this->prenom) AND !empty($this->naissance) AND !empty($this->ville) AND !empty($this->email) AND !empty($this->pass) AND !empty($this->re_pass))
		{

			if(filter_var($this->email, FILTER_VALIDATE_EMAIL))
			{
				if(preg_match("#^[A-Za-z0-9]{5,}$#", $this->pass))
				{
					if(isset($this->pass) AND $this->pass === $this->re_pass)
					{
						if(!$donnees)
						{
							if($age >= 18)
							{
								$pass_hache = password_hash($this->pass, PASSWORD_DEFAULT);

								$req = $this->bdd->prepare('INSERT INTO membres(nom, prenom, naissance, age, sexe, ville, email, password, date_inscription) VALUES(:nom, :prenom, :naissance, :age, :sexe, :ville, :email, :pass, NOW())');

								$req->bindValue(':nom', $this->nom);
								$req->bindValue(':prenom', $this->prenom);
								$req->bindValue(':naissance', $this->naissance);
								$req->bindValue(':age', $age);
								$req->bindValue(':sexe', $this->sexe);
								$req->bindValue(':ville', $this->ville);
								$req->bindValue(':email', $this->email);
								$req->bindValue(':pass', $pass_hache);

								$req->execute();

								echo "Vous êtes inscrit";
							}
							else{
								echo "Vous êtes trop jeune.";
							}
						}else{
							echo "Ce mail est déjà pris.";
						}
					}
					else{
						echo "Mauvaise saisie.";
					}
				}
				else{
					echo "Votre mot de passe n'est pas valide. Il doit contenir au moins 5 caractères alphanumériques.";
				}
			}
			else{
				echo "L'email n'est pas valide.";
			}
		}
		else{
			echo "Il faut remplir tous les champs";
		}
	}
}
if(!empty($_POST)){
$connexion = new Database('my_meetic', 'root', '', $_POST);
}
else{
	return null;
}
// $connexion->insert_form();
// $connexion->isMailExist();
