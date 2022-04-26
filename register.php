<?php
require_once __DIR__ . "/includes/db.php";

/* Requête POST */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Nettoyage et traitement des valeurs
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash du mot de passe

    // Insertion en base de données
    $query = $dbh->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $result = $query->execute([$name, $email, $password_hash]);

    // Si l'enregistrement est validé
    if ($result == true) {
        header("Location: login.php"); // Redirection vers login.php
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="style/register.css" media="screen" type="text/css" />
    <title>Auto enchères | Inscription</title>
</head>
<!-- Menu -->


<body>

    <?php include __DIR__ . "/includes/menu.php"; ?>

    <div class="container-header">
        <h2>INSCRIPTION</h2>
    </div>


    <form action="register.php" method="POST">
        <label for="name">Nom :</label>
        <input id="name" name="name" type="text" placeholder="saisie un pseudo" />

        <br />

        <label for="email">Email :</label>
        <input id="email" name="email" type="email" placeholder="saisie un email" />

        <br />

        <label for="password">Mot de passe :</label>
        <input id="password" name="password" type="password" placeholder="saisie un mot de passe" />

        <br />

        <input type="submit" value="S'inscrire" />
    </form>
    <?php if (isset($result) && $result == false) { ?>
        <p>Une erreur s'est produite, veuillez réessayer. Un utilisateur existe peut-être déjà avec cette adresse email.</p>
    <?php } ?>
</body>

</html>