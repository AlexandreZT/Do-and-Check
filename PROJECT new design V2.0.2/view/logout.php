<?php
session_start(); // reprends la session
session_destroy(); // détruit la session
// header('location: ../index.php');
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
    <link href="../css/style-logout.css" rel="stylesheet">
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
                        <li class="menu-active"><a href="logout.php">Log Out</a> </li>
                    <?php
                    }
                    ?>
                    <li><a href="help.php">Help</a></li>
                </ul>
            </nav>
        </div>
    </header>

        <section id="main">
			<div class="main-container">
				<h1>YOU ARE NOW WELL DISCONNECTED</h1>
				<h2>We hope to see you soon</h2>
			</div>
		</section>            

    
    <script src="../js/main.js"></script>
</body>

</html>