<?php include __DIR__ . "/includes/menu.php"; ?>
<?php

session_start();
if (!isset($_SESSION["user_id"])) {
    header('location:login.php');
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/register.css" media="screen" type="text/css" />
    <title>EDITION PRODIL</title>
</head>

<body>
    <div class="container-header">
        <h2>EDIT PROFIL</h2>
    </div>

    <!-- <a href="deconnexion.php">deconnexion</a> -->
    <form action="" method="POST">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="name" placeholder="modifier votre nom" />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="modifier votre email" />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="modifier votre mot de passe" />

        <input type="submit" value="Valider la modification" />
    </form>
</body>
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = (string) htmlspecialchars($_POST['name']);
    $email = (string)htmlspecialchars($_POST['email']);
    $password = (string) htmlspecialchars($_POST['password']);

    function edit($name, $email, $password)
    {
        if (empty(!$name) && empty(!$email) && empty(!$password)) {
            echo "hello";
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $bdd = new PDO('mysql:host=localhost;dbname=projetphp', 'root', 'root');



            $envoieDb = $bdd->prepare("UPDATE  users set name= ?, email= ?, password= ? WHERE id = ?;");
            $accuse = $envoieDb->execute([$name, $email, $hashPassword, $_SESSION["user_id"]]);

            if ($accuse == true) {
                echo "edit bon";
            } else {
                echo "erreur lors de l'enregistrement";
            }
        } else {
            echo "champ non remplie";
        }
    }
    edit($name, $email, $password);
}
?>

</html>