<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://localhost/jungle-cars/style/style.css">
    <title>Auto enchères | Accueil</title>
</head>

<body>
    <!-- Menu -->
    <?php include __DIR__ . "/includes/menu.php"; ?>

    <?php if (isset($_SESSION["user_id"])) { ?>
        <div class="container-welcome">
            <p class="welcome">Bienvenue <?= $_SESSION["user_name"]; ?></p>
        </div>

    <?php } ?>

    <?php include __DIR__ . "/includes/announcement.php"; ?>
</body>

</html>