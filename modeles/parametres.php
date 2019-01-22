<?php
session_start();
class parameter
{
	private $bdd;
	public $pass;
	public $new_pass;
	public $re_new_pass;
	public $new_mail;
	public $compte;

	
	function __construct($bdd, $_username, $_password, $donnees)
	{
		$this->PDOConnexion($bdd, $_username, $_password);
		if(isset($_POST['pass']) AND isset($_POST['new_pass']) AND isset($_POST['re_new_pass']) AND empty($_POST['new_mail']) AND empty($_POST['compte'])){

			$this->pass = $donnees['pass'];
			$this->new_pass = $donnees['new_pass'];
			$this->re_new_pass = $donnees['re_new_pass'];
		}

		if(empty($_POST['pass']) AND empty($_POST['new_pass']) AND empty($_POST['re_new_pass']) AND isset($_POST['new_mail']) AND empty($_POST['compte'])){

			$this->new_mail = $donnees['new_mail'];
		}

		if(empty($_POST['pass']) AND empty($_POST['new_pass']) AND empty($_POST['re_new_pass']) AND empty($_POST['new_mail']) AND isset($_POST['compte'])){
			$this->compte = $donnees['compte'];
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

	public function new_pass()
	{
		if(isset($this->new_pass) AND isset($this->re_new_pass) AND isset($this->pass) AND $this->new_mail == "")
		{
			$req = $this->bdd->prepare('SELECT password FROM membres');
			$datas = $req->execute();
			$datas = $req->fetch();

			$passwordCorrect = password_verify($this->pass, $datas['password']);

			if($passwordCorrect){

				if($this->new_pass != $this->re_new_pass){
					$_SESSION['flash']['error'] = "Les mots de passes ne correspondent pas";
				}
				else{

					if(preg_match("#^[A-Za-z0-9]{5,}$#", $this->new_pass))
					{
						$user_id = $_SESSION['id'];
						$password = password_hash($this->new_pass, PASSWORD_DEFAULT);

						$req = $this->bdd->prepare('UPDATE membres SET password = ? WHERE id = ?');
						$req->execute([$password, $user_id]);
						$_SESSION['flash']['success'] = "Votre mot de passe a bien été mis à jour";
					}
					else{
						$_SESSION['flash']['error'] = "Votre mot de passe n'est pas valide. Il doit contenir au moins 5 caractères alphanumériques.";
					}
				}
			}
			else{
				$_SESSION['flash']['error'] = "Mauvais mot de passe";
			}
		}
	}

	public function isMailExist()
	{
		if(isset($this->new_mail))
		{
			$req = $this->bdd->prepare('SELECT email FROM membres WHERE email = :email');

			$req->bindValue(':email', $this->new_mail);
			$req->execute();

			$donnees = $req->fetch();
			return $donnees;
		}
	}

	public function new_mail()
	{
		$donnees = $this->isMailExist();

		if(isset($this->new_mail))
		{
			if(filter_var($this->new_mail, FILTER_VALIDATE_EMAIL))
			{
				if(!$donnees)
				{
					$user_id = $_SESSION['id'];
					$req = $this->bdd->prepare('UPDATE membres SET email = ? WHERE id = ?');
					$req->bindValue(':email', $this->new_mail);
					$req->execute([$this->new_mail, $user_id]);
					$_SESSION['flash']['success'] = "Votre mail a bien été mis à jour";
				}
				else{
					$_SESSION['flash']['error'] = "Ce mail existe déjà";
				}
			}
		}
	}

	public function is_isset()
	{
		if($this->compte == "oui")
		{
			$user_id = $_SESSION['id'];
			$user_email = $_SESSION['email'];
			$req = $this->bdd->prepare('INSERT INTO delete_members(id, email, date_delete) VALUE(:id, :email, NOW())');
			$req->bindValue(':id', $user_id);
			$req->bindValue(':email', $user_email);
			$datas = $req->execute();

			header('Location: ../index.php');
		}
		else if($this->compte == "non")
		{
			return null;
		}
	}
}

if(!empty($_POST)){
$param = new parameter('my_meetic', 'root', '', $_POST);
$param->new_pass();
$param->new_mail();
$param->is_isset();
}