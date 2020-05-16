<?php

session_start(); // à mettre tout en haut du fichier .php, cette fonction propre à PHP servira à maintenir la $_SESSION
if (isset($_POST['connexion'])) { // si le bouton "Connexion" est appuyé
    // on vérifie que le champ "Pseudo" n'est pas vide
    // empty vérifie à la fois si le champ est vide et si le champ existe belle et bien (is set)
    if (empty($_POST['pseudo'])) {
        $logerror = "Le champ Pseudo est vide.";
    } else {
        // on vérifie maintenant si le champ "Mot de passe" n'est pas vide"
        if (empty($_POST['mdp'])) {
            $logerror =  "Le champ Mot de passe est vide.";
        } else {
            // les champs sont bien posté et pas vide, on sécurise les données entrées par le membre:
            $Pseudo = htmlentities($_POST['pseudo'], ENT_QUOTES, "ISO-8859-1"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $MotDePasse = htmlentities($_POST['mdp'], ENT_QUOTES, "ISO-8859-1");
            //on se connecte à la base de données:
            $mysqli = mysqli_connect("127.0.0.1", "root", "", "bdd");
            //on vérifie que la connexion s'effectue correctement:
            if (!$mysqli) {
                $logerror =  "Erreur de connexion à la base de données.";
            } else {
                // on fait maintenant la requête dans la base de données pour rechercher si ces données existe et correspondent:
                $Requete = mysqli_query($mysqli, "SELECT * FROM membres WHERE pseudo = '" . $Pseudo . "' AND mdp = '" . md5($MotDePasse) . "'"); //si vous avez enregistré le mot de passe en md5() il vous suffira de faire la vérification en mettant mdp = '".md5($MotDePasse)."' au lieu de mdp = '".$MotDePasse."'
                // si il y a un résultat, mysqli_num_rows() nous donnera alors 1
                // si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
                if (mysqli_num_rows($Requete) == 0) {
                    $logerror =  "The username or password is incorrect, the account was not found..";
                } else {
                    // on ouvre la session avec $_SESSION:
                    $_SESSION['pseudo'] = $Pseudo; // la session peut être appelée différemment et son contenu aussi peut être autre chose que le pseudo
                    $open = true;// $session_status = session_status();
                }
            }
        }
    }
}
?>

<!-- 
Les balises <form> sert à dire que c'est un formulaire
on lui demande de faire fonctionner la page login.php une fois le bouton "Connexion" cliqué
on lui dit également que c'est un formulaire de type "POST"
 
Les balises <input> sont les champs de formulaire
type="text" sera du texte
type="password" sera des petits points noir (texte caché)
type="submit" sera un bouton pour valider le formulaire
name="nom de l'input" sert à le reconnaitre une fois le bouton submit cliqué, pour le code PHP
 -->

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
    <link href="../css/style-login.css" rel="stylesheet">
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
                    <li class="menu-active"><a href="login.php">Log In</a></li>
                    <li><a href="registration.php">Sign In</a></li>
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

        <div id="container">
            <form class="log" action="login.php" method="post">
                <h2>Good to see you again</h2>
                <label><b>Username</b></label>
                <input type="text" name="pseudo" placeholder="Enter your username here" value="" />
                <label><b>Password</b></label>
                <input type="password" name="mdp" placeholder="Enter your password here" value="" />
                <a href="registration.php"><p style="text-align:center">No account yet ?</p></a>

                <input type="submit" name="connexion" value="Log In" />
                
            </form>
        </div>
    </header>


    <?php
    if (isset($logerror)) {
        echo "<p>$logerror</p>";
    }
    if ((isset($Pseudo) and isset($open))) {
        echo "<p><b>You're connected $Pseudo!</b></p>";
        // echo "<p>Status de la sessions : $session_status </p>";
        $req_id = $mysqli->query("SELECT id FROM membres WHERE pseudo = '$_SESSION[pseudo]'");
        $row = mysqli_fetch_array($req_id); // sous forme de tableau
        $_SESSION['id'] = $row['id']; // Je récupère l'id
    }
    ?>
    <!-- Template Main JS File -->
    <script src="../js/main.js"></script>
</body>

</html>