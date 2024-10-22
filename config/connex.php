<?php 
	/**
	 * Class for SUR Connexion
	 */
	class Connexion
	{
		private $localhost = "localhost";
		private $mdp = "";
		private $user = "root";
		private $dbname = "nom";
		
		public function connectBD()
		{
			$bdd = new PDO('mysql:host='.$this->localhost.';dbname='.$this->dbname.';charset=utf8;',$this->user,$this->mdp);
			if ($bdd) {
				return $bdd;
			}
			else{
				echo "Erreur de connexion";
			}
		}
	}


 ?>