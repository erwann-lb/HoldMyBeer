<?php
if (isset($_GET['pseudo'], $_GET['key']) && !empty($_GET['pseudo']) && !empty($_GET['key'])) {
	$db = new PDO("mysql:host=mysql-lvanden.alwaysdata.net;dbname=lvanden_hmb2021;port=3306", "lvanden", "hmb2021");
	$pseudo = htmlspecialchars($_GET['pseudo']);
	$key = htmlspecialchars($_GET['key']);

	$requser = $db->prepare("SELECT * FROM utilisateur WHERE pseudo = ? AND confirmation_key = ?");
	$requser->execute(array($pseudo, $key));
	$userexist = $requser->rowCount();
	if ($userexist == 1) {
		$user = $requser->fetch();
		if ($user['confirmed'] == 0) {
			$updateuser = $db->prepare("UPDATE utilisateur SET confirmed = 1 WHERE pseudo = ? AND confirmation_key = ?");
			$updateuser->execute(array($pseudo, $key));


			session_start();
			$_SESSION['pseudo'] = $pseudo;
			header('Location:index.php');
		} else {
			echo "L'utilisateur a déjà été confirmé";
		}
	} else {
		echo "L'utilisateur n'existe pas";
	}
}
?>