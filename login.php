<?php
require_once __DIR__ . "/includes/db.php";

/* Requête POST */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Nettoyage et traitement des valeurs
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];

    // Récupération de l'utilisateur
    $query = $dbh->prepare("SELECT * FROM users WHERE email=?");
    $query->execute([$email]);
    $user = $query->fetch();

    // Si l'utilisateur est trouvé et que le mot de passe saisi correspond au hash du mot de passe de l'utilisateur
    if ($user != false && password_verify($password, $user["password"])) {
        session_start();
        $_SESSION["user_id"] = $user["id"]; // Stockage de l'id de l'utilisateur dans la session
        $_SESSION["user_name"] = $user["name"]; // Stockage du nom de l'utilisateur dans la session
        header("Location: index.php"); // Redirection vers index.php
    } else {
        $result = false;
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="style/connexion.css">
    <title>Auto enchères | Connexion</title>

</head>
<!-- Menu -->

<body>

    <?php include __DIR__ . "/includes/menu.php"; ?>

    <div class="container-header">
        <h2>CONNEXION</h2>
    </div>

    <form action="login.php" method="POST">

        <label for="email">Email :</label>
        <input id="email" name="email" type="email" placeholder="saisie votre email" />
        <label for="password">Mot de passe :</label>
        <input id="password" name="password" type="password" placeholder="saisie ton mot de passe" />
        <input type="submit" value="Se connecter" />
    </form>
    <?php if (isset($result) && $result == false) { ?>
        <p>L'email ou le mot de passe sont incorrects.</p>
    <?php } ?>
</body>

</html>