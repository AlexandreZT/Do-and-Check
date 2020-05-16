<?php
session_start();
$mysqli = mysqli_connect("127.0.0.1", "root", "", "bdd");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>DO&CHECK</title>

	<!-- Favicons -->
	<link href="../img/favicon.ico" rel="icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="../css/style-help.css" rel="stylesheet">
</head>

<body>
	<header id="header">
		<div class="menu-bar">

			<div id="logo" class="pull-left">
				<a href="../index.php" class="logo"><b>DO&<span>CHECK</span></b></a>
			</div>

			<nav id="nav-menu-container">
				<ul class="nav-menu">
					<li><a href="../index.php">Home</a></li>
					<li> <a href="login.php">Log In</a></li>
					<li><a href="registration.php">Sign In</a></li>
					<?php
					if (isset($_SESSION['pseudo'])) {
					?>
						<li><a href="logout.php">Log Out</a> </li>
					<?php
					}
					?>
					<li class="menu-active"><a href="help.php">Help</a></li>
				</ul>
			</nav>
		</div>
	</header>

	<section id="wiki">
		<p>Une todo list (anglicisme), ou liste de tâches, est un procédé qui se veut simple et efficace pour gérer les tâches d'un projet.<br>Ces tâches peuvent être indépendantes ou devoir, au contraire, être accomplies dans un certain ordre. </p>
		<h5>Source by Wikipedia</h5>
	</section>
	<!-- Ici on va ajouter la possibilité de sélectionner le theme light ou dark-->

	<?php
	if (isset($_SESSION['pseudo'])) // si une variable de session est set =  un utilisateur est connecté
	{
	?>
		<form id="help" action="help.php" method="post">
			<label><b>Supprimer mon compte</b></label>
			<input type="text" name="delete_user" class="champ" placeholder="Confirmer votre pseudo" value="" />
			<input type="submit" name="Delete_user" class="btn-supp" value="Je veux supprimer mon compte" />
		</form>
	<?php

		if (isset($_POST['Delete_user'])) {
			if ($_POST['delete_user'] != $_SESSION['pseudo']) {
				echo "<p>Incorret !</p>";
			} else if ($_POST['delete_user'] == $_SESSION['pseudo']) {
				session_destroy(); // détruit la session
				// détruire taches
				$delete_user_todo = $mysqli->query("DELETE FROM taches WHERE membre='$_SESSION[id]'");
				// détruire todolists
				$delete_user_todo = $mysqli->query("DELETE FROM todolists WHERE membre='$_SESSION[id]'");
				// détruit enfin l'utilisateur
				$delete_user = $mysqli->query("DELETE FROM membres WHERE pseudo='$_POST[delete_user]' and id='$_SESSION[id]'");
				header("Refresh:0");
				echo "<p>Votre compte a bien été supprimé avec succès</p>";
			}
		}
	}
	?>
	<script src="../js/main.js"></script>
</body>

</html>