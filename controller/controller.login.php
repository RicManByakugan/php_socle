<?php 
	if (isset($_SESSION['idPerso'])) {
		require_once('view/accueil.php');
	}else{
		require_once('view/login.php');
	}
 ?>