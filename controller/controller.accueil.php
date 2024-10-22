<?php 
	include 'modele/personnel/modele.personnel.php';
	
	$modelePerso = new Personnel();

	if (isset($_SESSION['idPerso'])) {
		$idPerso = $_SESSION['idPerso'];
		$user = $modelePerso->GetPersonneBySomething('idPerso',$idPerso);
		if ($user['image']==NULL || $user['image']=="") {
			$img = "data/user/profile.png";
		}else{
			$img = "data/user/".$user['imageA'];
		}
		require_once('view/accueil.php');
	}else{
		require_once('view/login.php');
	}
 ?>