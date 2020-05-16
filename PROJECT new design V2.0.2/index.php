<?php
// include and require
// include 'view/login.php';
// include 'view/logout.php';

session_start(); // Démarre une nouvelle session ou reprend une session existante

// connexion à la base de donnée
$mysqli = mysqli_connect("127.0.0.1", "root", "", "bdd");
// requête pour aller rechercher toutes les todolist de l'user connecté
// $req_list = $mysqli->query("SELECT todolist FROM todolists WHERE membre=$id");
// $req_task = $mysqli->query("SELECT tache FROM taches WHERE membre=$id");

// requête pour aller rechercher le nombre de todolist de l'user connecté
/* 
$req_nb_list = $mysqli->query("SELECT todolist FROM todolists WHERE membre=$id");
$nb_list = $req_nb_list->num_rows;
echo $nb_list; // nombre de todolist de l'utilisateur connecté

$i = 0; // initialisation
while ($i < $nb_list) // parcour le nombre de liste
{
    $i++;
}
*/

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Do&Check</title>
	<!-- Favicons -->
	<link href="img/favicon.ico" rel="icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="css/style-home.css" rel="stylesheet">
</head>

<body>
	<header id="header">
		<div class="container">
			<div id="logo" class="pull-left">
				<a href="index.php" class="logo"><b>DO&<span>CHECK</span></b></a>
			</div>
			<nav id="nav-menu-container">
				<ul class="nav-menu">
					<li class="menu-active"><a href="index.php">Home</a></li>
					<li><a href="view/login.php">Log In</a></li>
					<li><a href="view/registration.php">Sign In</a></li>
					<li><a href="view/help.php">Help</a></li>

					<?php
					if (isset($_SESSION['pseudo'])) {
					?>
						<li><a href="view/logout.php">Log Out </a> </li>
						<li><a href="view/mail.php">Mailing</a> </li>
					<?php
					}
					?>
				</ul>
			</nav>
		</div>
	</header>
	
	<?php
	// HOME PAGE : déconnecté
	// => BIENVENU
	if (!isset($_SESSION['pseudo'])) {
	?>
		<section id="main">
			<div class="main-container">
				<h1>Welcome to DO&<span>CHECK</span></h1>
				<h2>The first complete and free <span>TO-DO</span> list service</h2>
				<a href="view/login.php" class="btn-get-started">Get Started</a>
			</div>
		</section>
	<?php
	}
	// HOME PAGE : connecté
	// => MANAGEMENT

	// if (session_status() == 2) {
	if (isset($_SESSION['pseudo'])) { // si un utilisateur est connecté
		// echo "<p>Votre id : $_SESSION[id]</p> </br>";
		// echo "<p id='welcome'>Bonjour $_SESSION[pseudo]</p>";

	?>
	<section id="topdisplay">
			<form id="notifications">
				<label><b>Je suis une notification</b></label>
				<input type="submit" name="Accepter" value="Accepter" />
				<input type="submit" name="Refuser" value="Refuser" />
				</br>
				<label><b>Moi aussi je suis une notification</b></label>
				<input type="submit" name="Accepter" value="Accepter" />
				<input type="submit" name="Refuser" value="Refuser" />
				</br>
				<label><b>Moi aussi</b></label>
				<input type="submit" name="Accepter" value="Accepter" />
				<input type="submit" name="Refuser" value="Refuser" />
			</form>

			<form id="managements" action="index.php" method="post">
				<label class="positive"><b>Créer une todolist</b></label>
				</br>
				<input type="text" name="add" placeholder="Nouvelle todolist" value="" />
				<input type="submit" name="Add" value="+" />
				</br>
				<label class="negative"><b>Supprimer une todolist</b></label>
				</br>
				<input type="text" name="del" placeholder="Nom de la todolist" value="" />
				<input type="submit" name="Del" value="-" />
				</br>
				<label class="positive"><b>Ajouter une tâche</b></label>
				</br>
				<input type="text" name="add_task" placeholder="Nouvelle tâche" value="" />
				<input type="text" name="add_to" placeholder="Nom de la todolist" value="" />
				<input type="submit" name="Add_task" value="+" />
				</br>
				<label class="negative"><b>Supprimer une tâche</b></label>
				</br>
				<input type="text" name="del_task" placeholder="Nom de la tâche" value="" />
				<input type="text" name="del_to" placeholder="Nom de la todolist" value="" />
				<input type="submit" name="Del_task" value="-" />
				</br>
				<label class="neutre"><b>Changer le status de la todolist</b></label>
				</br>
				<input type="text" name="chg_status_todo" placeholder="Nom de la todolist" value="" />
				<input type="submit" name="Chg_status_todo" value="O" />
				</br>
				<label class="neutre"><b>Changer le status de la tâche</b></label>
				</br>
				<input type="text" name="chg_status_task" placeholder="Nom de la tache" value="" />
				<input type="text" name="chg_status_to" placeholder="Nom de la todolist" value="" />
				<input type="submit" name="Chg_status_task" value="O" />
				</br>
				<label class="negative"><b>Supprimer toutes les todolists terminés</b></label>
				<input type="submit" name="Todo_finished" value="-" />
				</br>
				<label class="negative"><b>Supprimer toutes les tâches terminés</b></label>
				<input type="submit" name="Task_finished" value="-" />
				</br>
				<label class="neutre"><b>Modifier le nom de la todolist</b></label>
				</br>
				<input type="text" name="old_name" placeholder="Nom actuel de la todolsit" value="" />
				<input type="text" name="new_name" placeholder="Nouveau nom de la todolist" value="" />
				<input type="submit" name="Rename_todo" value="O" />
				</br>
				<label class="neutre"><b>Filtre d'affichage</b></label>
				</br>
				<input type="submit" name="view" value="En cours" />
				<input type="submit" name="view" value="Terminés" />
				<input type="submit" name="view" value="Tout" />
				</br>
				<label class="neutre"><b>Rechercher un utilisateur</b></label>
				</br>
				<input type="text" name="search" placeholder="Pseduo ou mail" value="" />
				<input type="submit" name="Search" value="Rechercher" />
			</form>
	</section>

		<?php
		// permet d'ajouter une todolist
		if (isset($_POST['Add'])) {
			$req_add = $mysqli->query("INSERT INTO todolists (`membre`, `todolist`,`status`) VALUES ($_SESSION[id], '$_POST[add]', 0)"); // `` permit to escape reserved word like status, '' doesn't work !
		}
		// permet de supprimer une todolist
		if (isset($_POST['Del'])) {
			// La todolist doit être vide pour être supprimé
			$req_del = $mysqli->query("DELETE FROM taches WHERE todolist='$_POST[del]'"); // `` permit to escape reserved word like status, '' doesn't work !
			// On peut le supprimer
			$req_del = $mysqli->query("DELETE FROM todolists WHERE todolist='$_POST[del]'"); // `` permit to escape reserved word like status, '' doesn't work !
		}
		// permet d'ajouter une tâche à une todolist
		if (isset($_POST['Add_task'])) { // vérifie si on a voulu ajouter une tache
			$insert_task = $mysqli->query("INSERT INTO taches (membre, todolist, tache, `status`) VALUES ($_SESSION[id], '$_POST[add_to]', '$_POST[add_task]', 0)");
		}

		// permet de supprimer une tâche d'une todolist
		if (isset($_POST['Del_task'])) { // vérifie si on a voulu supprimer une tache
			$delete_task = $mysqli->query("DELETE FROM taches WHERE todolist = '$_POST[del_to]' and tache = '$_POST[del_task]'");
		}
		// permet de modifier le nom d'une todolist
		if (isset($_POST['Rename_todo'])) {
			$rename_todo = $mysqli->query("UPDATE todolists SET todolist= '$_POST[new_name]' WHERE todolist = '$_POST[old_name]' and membre=$_SESSION[id]");
			// Cela implique également de changer le nom des todolists de la table taches
			$rename_todo_task = $mysqli->query("UPDATE taches SET todolist= '$_POST[new_name]' WHERE todolist = '$_POST[old_name]' and membre=$_SESSION[id]");
		}

		// permet de changer le status d'une todolist
		if (isset($_POST['Chg_status_todo'])) { // vérifie si on a voulu modifier le status d'une tache
			// on récupère le status
			$Chg_status_todo = $mysqli->query("SELECT * FROM todolists WHERE todolist='$_POST[chg_status_todo]' and membre=$_SESSION[id]");
			$Chg_status_todo->data_seek(0);
			$row = $Chg_status_todo->fetch_assoc();
			// on change le valeur
			if ($row['status'] == 0) {
				$Chg_status_todo = $mysqli->query("UPDATE todolists SET `status` = 1 WHERE todolist='$_POST[chg_status_todo]' and membre=$_SESSION[id]");
			} else if ($row['status'] == 1) {
				$Chg_status_todo = $mysqli->query("UPDATE todolists SET `status` = 0 WHERE todolist='$_POST[chg_status_todo]' and membre=$_SESSION[id]");
			}
		}

		// permet de changer le status d'une tache
		if (isset($_POST['Chg_status_task'])) { // vérifie si on a voulu modifier le status d'une tache
			$Chg_status_task = $mysqli->query("SELECT * FROM taches WHERE todolist='$_POST[chg_status_to]' and tache='$_POST[chg_status_task]' and membre=$_SESSION[id]");
			$Chg_status_task->data_seek(0);
			$row = $Chg_status_task->fetch_assoc();
			// on change le valeur
			if ($row['status'] == 0) {
				$Chg_status_task = $mysqli->query("UPDATE taches SET `status` = 1 WHERE todolist='$_POST[chg_status_to]' and tache='$_POST[chg_status_task]' and membre=$_SESSION[id]");
			} else if ($row['status'] == 1) {
				$Chg_status_task = $mysqli->query("UPDATE taches SET `status` = 0 WHERE todolist='$_POST[chg_status_to]' and tache='$_POST[chg_status_task]' and membre=$_SESSION[id]");
			}
		}

		// permet de supprimer toutes les todolists terminé
		if (isset($_POST['Todo_finished'])) {
			$Select_finished = $mysqli->query("SELECT todolist FROM todolists WHERE membre=$_SESSION[id] and `status`=1");
			$Todo_finished = $mysqli->query("DELETE FROM todolists WHERE membre=$_SESSION[id] and `status`=1");
			// il faut donc également supprimer les tâches des todolits qu'on supprime
			$Select_finished->data_seek(0);
			$Select_finished->data_seek(0);
			while ($row = $Select_finished->fetch_assoc()) {
				$Task_kill = $mysqli->query("DELETE FROM taches where todolist='$row[todolist]'");
			}
		}
		// permet de supprimer toutes les tâches terminé
		if (isset($_POST['Task_finished'])) {
			$Task_finished = $mysqli->query("DELETE FROM taches WHERE membre=$_SESSION[id] and `status`=1");
		}

		// permet de rechercher un utilisateur grâce à son pseudo ou mail
		if (isset($_POST['Search'])) {
			$Search = $mysqli->query("SELECT * FROM membres WHERE pseudo='$_POST[search]' or mail='$_POST[search]'");
			$Search->data_seek(0);
			$row = $Search->fetch_assoc();
			if ((!isset($row['pseudo']))  or (!isset($row['mail']))) {
				echo "<p id='search' >Aucun résultat</p>";
			} else echo "<p id='search' >pseudo : $row[pseudo] </br> mail : $row[mail]</p>";
		}
		?>
		<form id="todolists">
			<!--  Afin de choisir quelles todolists on veut visualiser (personnel ou celle d'un amis), il faut sélectionner l'id aproprié -->
			<?php
			// Affichage des Todolists de l'utilisateur avec les tâches associées :
			$req_user_todo = $mysqli->query("SELECT * FROM todolists WHERE membre=$_SESSION[id]");
			$req_user_todo->data_seek(0);
			while ($row = $req_user_todo->fetch_assoc()) {
				if ($row['status'] == 0) {
					$row['status'] = "en cours";
				} else if ($row['status'] == 1) {
					$row['status'] = "terminé";
				}
				echo "<p># $row[todolist] (todolist $row[status]) :</p>"; // Affichage des todolists et leur status
				// Affichage des taches de chaque todolist :
				$req_user_task = $mysqli->query("SELECT * FROM taches WHERE membre=$_SESSION[id] and todolist='$row[todolist]'");
				$req_user_task->data_seek(0);
				while ($row = $req_user_task->fetch_assoc()) {
					if ($row['status'] == 0) {
						$row['status'] = "en cours";
					} else if ($row['status'] == 1) {
						$row['status'] = "terminé";
					}

					// filtre task in progress only
					if ((isset($_POST['view'])) and (($_POST['view']) == "En cours") and ($row['status'] == "en cours")) {
						echo "<p>- $row[tache] (tache $row[status])</p>";
					}
					// filtre task complete only
					else if ((isset($_POST['view'])) and (($_POST['view']) == "Terminés") and ($row['status'] == "terminé")) {
						echo "<p>- $row[tache] (tache $row[status])</p>";
					} else if ((!isset($_POST['view'])) or ((isset($_POST['view'])) and ($_POST['view']) == "Tout")) {
						echo "<p>- $row[tache] (tache $row[status])</p>"; // Affichage des taches de chaque todolist et status
					}
				}
			}
			?>
		</form>
	<?php
	}

	?>
	
</body>

</html>