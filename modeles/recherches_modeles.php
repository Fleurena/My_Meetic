<?php
session_start();
class recherches
{
	private $bdd;
	public $sexe;
	public $age;
	public $city;

	
	function __construct($bdd, $_username, $_password, $donnees)
	{
		$this->PDOConnexion($bdd, $_username, $_password);
		if(isset($_POST['sexe']) OR isset($_POST['age'])){
			$this->sexe = $donnees['sexe'];
			$this->age = $donnees['age'];
		}
		if(isset($_POST['ville']))
		{
			$this->city = $donnees['ville'];
		}
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

	public function mixte()
	{
		$req = $this->bdd->prepare('SELECT DISTINCT sexe FROM membres');
		$req->execute();

		$donnees = $req->fetchAll();
		return $donnees;
	}

	public function sexe()
	{
		$age = $this->age();

		if(!isset($this->sexe) AND !isset($this->age)){
			$req = $this->bdd->prepare('SELECT * FROM membres');
			$req->execute();

			$donnees = $req->fetchAll();
			return $donnees;
		}

		if(isset($this->sexe))
		{
			$req = $this->bdd->prepare('SELECT * FROM membres WHERE sexe = :sexe');
			$req->bindValue(':sexe', $this->sexe);
			$req->execute();

			$donnees = $req->fetchAll();
			return $donnees;
		}
	}

	public function age()
	{
		$city = $this->city();

		if(isset($this->age))
		{
			if($this->age == "18/25")
			{
				$req = $this->bdd->prepare('SELECT * FROM membres WHERE age BETWEEN "18" AND "25"');
				$req->execute();

				$donnees = $req->fetchAll();
				return $donnees;
			}

			if($this->age == "25/35")
			{
				$req = $this->bdd->prepare('SELECT * FROM membres WHERE age BETWEEN "25" AND "35"');
				$req->execute();

				$donnees = $req->fetchAll();
				return $donnees;
			}

			if($this->age == "35/45")
			{
				$req = $this->bdd->prepare('SELECT * FROM membres WHERE age BETWEEN "35" AND "45"');
				$req->execute();

				$donnees = $req->fetchAll();
				return $donnees;
			}

			if($this->age == "45+")
			{
				$req = $this->bdd->prepare('SELECT * FROM membres WHERE age BETWEEN "45" AND "100"');
				$req->execute();

				$donnees = $req->fetchAll();
				return $donnees;
			}
		}
	}

	public function city()
	{
		if(isset($this->city) AND sizeof($this->city) == 1){
			$req = $this->bdd->prepare('SELECT * FROM membres WHERE ville = :ville');
			$req->bindValue(':ville', $this->city[0]);
			$req->execute();

			$donnees = $req->fetchAll();
			return $donnees;
		}

		if(isset($this->city) AND sizeof($this->city) == 2){
			$req = $this->bdd->prepare('SELECT * FROM membres WHERE ville = :ville0 OR ville = :ville1');
			$req->bindValue(':ville0', $this->city[0]);
			$req->bindValue(':ville1', $this->city[1]);
			$req->execute();

			$donnees = $req->fetchAll();
			return $donnees;
		}

		if(isset($this->city) AND sizeof($this->city) == 3){
			$req = $this->bdd->prepare('SELECT * FROM membres WHERE ville = :ville0 OR ville = :ville1 OR ville = :ville2');
			$req->bindValue(':ville0', $this->city[0]);
			$req->bindValue(':ville1', $this->city[1]);
			$req->bindValue(':ville2', $this->city[2]);
			$req->execute();

			$donnees = $req->fetchAll();
			return $donnees;
		}

		if(isset($this->city) AND sizeof($this->city) == 4){
			$req = $this->bdd->prepare('SELECT * FROM membres WHERE ville = :ville0 OR ville = :ville1 OR ville = :ville2 OR ville = :ville3');
			$req->bindValue(':ville0', $this->city[0]);
			$req->bindValue(':ville1', $this->city[1]);
			$req->bindValue(':ville2', $this->city[2]);
			$req->bindValue(':ville3', $this->city[3]);
			$req->execute();

			$donnees = $req->fetchAll();
			return $donnees;
		}
	}
}
$recherches = new recherches('my_meetic', 'root', '', $_POST);
$mixte = $recherches->mixte();
$genres = $recherches->sexe();
$ages = $recherches->age();
$city = $recherches->city();