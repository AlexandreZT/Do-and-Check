<?php
session_start();
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
    <link href="../css/style-registration.css" rel="stylesheet">
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
                    <li><a href="login.php">Log In</a></li>
                    <li class="menu-active"><a href="registration.php">Sign In</a></li>
                    <?php
                    if (isset($_SESSION['pseudo'])) {
                    ?>
                        <li><a href="logout.php">Log Out</a> </li>
                    <?php
                    }
                    ?>
                    <li><a href="help.php">Help</a></li>
                </ul>
            </nav>
        </div>

        <!-- zone d'inscription  -->
        <?php

        /* page: registration.php */

        //connexion à la base de données:
        $BDD = array();
        $BDD['host'] = "127.0.0.1";
        $BDD['user'] = "root";
        $BDD['pass'] = "";
        $BDD['db'] = "bdd";
        // $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass); // php
        $mysqli = mysqli_connect($BDD['host'], $BDD['user'], $BDD['pass'], $BDD['db']);
        if (!$mysqli) {
            echo "<p>Connexion non établie.</p>";
            exit;
        }
        //création automatique de la table membres, une fois créée, vous pouvez supprimer les lignes de code suivantes:
        mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS `" . $BDD['db'] . "`.`membres` ( `id` INT NOT NULL AUTO_INCREMENT , `pseudo` VARCHAR(25) NOT NULL, `mail` VARCHAR(25) NOT NULL, `mdp` CHAR(32) NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;") . mysqli_error($mysqli);
        //la table est créée avec les paramètres suivants:
        //champ "id": en auto increment pour un id unique, peux vous servir pour une identification future
        //champ "pseudo": en varchar de 0 à 25 caractères
        //champ "mail": en varchar de 0 à 25 caractères
        //champ "mdp": en char fixe de 32 caractères, soit la longueur de la fonction md5()
        //fin création automatique
        //par défaut, on affiche le formulaire (quand il validera le formulaire sans erreur avec l'inscription validée, on l'affichera plus)
        $AfficherFormulaire = 1;
        // traitement du formulaire d'inscription :
        if (isset($_POST['pseudo'], $_POST['mail'], $_POST['mdp'])) { //l'utilisateur à cliqué sur "S'inscrire", on demande donc si les champs sont défini avec "isset"
            if (empty($_POST['pseudo'])) { //le champ pseudo est vide, on arrête l'exécution du script et on affiche un message d'erreur
                echo "<p id='reginfo' >Le champ Pseudo est vide.</p>";
            } elseif (!preg_match("#^[a-z0-9]+$#", $_POST['pseudo'])) { //le champ pseudo est renseigné mais ne convient pas au format qu'on souhaite qu'il soit, soit: que des lettres minuscule + des chiffres
                echo "<p id='reginfo'>Le Pseudo doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.</p>";
            } elseif (strlen($_POST['pseudo']) > 25) { // Le pseudo est trop long, il dépasse 25 caractères
                echo "<p id='reginfo'>Le pseudo est trop long, il dépasse 25 caractères.</p>";
            } elseif (empty($_POST['mail'])) { // Le champ mail est vide
                echo "<p id='reginfo'>Le champ Mail est vide.</p>";
            } elseif (empty($_POST['mdp'])) { // Le champ mot de passe est vide
                echo "<p id='reginfo'>Le champ Mot de passe est vide.</p>";
            } elseif (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM membres WHERE pseudo='" . $_POST['pseudo'] . "'")) == 1) { //on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
                echo "<p id='reginfo'>Ce pseudo est déjà utilisé.</p>";
            } else {
                //toutes les vérifications sont faites, on passe à l'enregistrement dans la base de données:
                //Bien évidement il s'agit là d'un script simplifié au maximum, libre à vous de rajouter des conditions avant l'enregistrement comme la longueur minimum du mot de passe par exemple
                if (!mysqli_query($mysqli, "INSERT INTO membres SET pseudo='" . $_POST['pseudo'] . "', mail='" . $_POST['mail'] . "', mdp='" . md5($_POST['mdp']) . "'")) { //on crypte le mot de passe avec la fonction propre à PHP: md5()
                    echo "Une erreur s'est produite: " . mysqli_error($mysqli); //je conseille de ne pas afficher les erreurs aux visiteurs mais de l'enregistrer dans un fichier log
                } else {
                    echo "<p id='reginfo'>Vous êtes inscrit avec succès!</p>";
                    // on affiche plus le formulaire
                    $AfficherFormulaire = 0;
                }
            }
        }
        if ($AfficherFormulaire == 1) {
        ?>
            <!-- 
    Les balises <form> sert à dire que c'est un formulaire
    on lui demande de faire fonctionner la page registration.php une fois le bouton "S'inscrire" cliqué
    on lui dit également que c'est un formulaire de type "POST"
      
    Les balises <input> sont les champs de formulaire
    type="text" sera du texte
    type="password" sera des petits points noir (texte caché)
    type="submit" sera un bouton pour valider le formulaire
    name="nom de l'input" sert à le reconnaitre une fois le bouton submit cliqué, pour le code PHP
     -->
            <div id="container">
                <form class="logs" action="registration.php" method="post">
                    <h2>Registration</h2>
                    <label><b>Username</b></label>
                    <input type="text" name="pseudo" placeholder="Enter your username here" value="" />
                    <label><b>Password</b></label>
                    <input type="password" name="mdp" placeholder="Enter your password here" value="" />
                    <label><b>E-Mail</b></label>
                    <input type="text" name="mail" placeholder="Enter a valide e-mail here" value="" />
                    <a id="already" href="login.php"><p style="text-align:center">Already an account ?</p></a>
                    <input type="submit" name="connexion" value="Sign In" />
                </form>
            </div>
        <?php
        }
        ?>
    </header>
    <script src="../js/main.js"></script>
</body>

</html>