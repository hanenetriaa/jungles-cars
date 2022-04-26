<?php

session_start();
$dbh = new PDO("mysql:dbname=projetphp;host=localhost", "root", "root");


// Récupération données de la table announcement

$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);

$query = $dbh->prepare("SELECT a. *,  MAX(t.price_buy) FROM announcements a LEFT JOIN transactions t ON a.id=t.announcement_id WHERE a.id=? GROUP BY a.id");
$query->execute([$id]);
/**
 * Récupération des données de la requête
 * sous forme de tableau associatif
 */
$offer = $query->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://localhost/jungle-cars/style/details.css">
    <title>Annonce</title>
</head>

<body>
    <div>
        <ul>
            <div class="details">
                <p>N° de l'offre : <?= $offer["id"] ?></p>
                <p>Marque du véhicule : <?= $offer["brand"] ?></p>
                <p>Modèle : <?= $offer["model"] ?></p>
                <p>Année du véhicule : <?= $offer["year"] ?></p>
                <p>Prix : <?= $offer["price"] ?> €</p>
                <p>Description : <?= $offer["description"] ?></p>
                <p>Nombre de Km : <?= $offer["km"] ?> Km</p>

            </div>


        </ul>
    </div>
    <div class="details1">

        <?php

        if (date('d-m-y h:i:s') <= $offer["end_date"]) {
        ?>
            <hr>
            <p>Enchère la plus élevée : <?= $offer["MAX(t.price_buy)"] ?? 0 ?>€</p>

            <form method="POST">

                <label for="enchere">Mettez le montant de votre enchère : </label>
                <input type="number" name="price_buy">
                <input type="hidden" name="announcement_id" value="<?= $offer["id"] ?>">

                <input type="submit" value="Enchérir">

            </form>
        <?php
        } else {
            echo "Fin de l'enchère";
        }
        ?>

        <button class="btnretour"><a href="http://localhost/jungle-cars/index.php">Retour aux enchères</a></button>
        <?php


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            /* récupérer les données du formulaire en utilisant 
        la valeur des attributs name comme clé  */


            $price_buy = $_POST['price_buy'];
            $announcement_id = $_POST['announcement_id'];
            $buyer_id = $_SESSION["user_id"];

            // Insertion en base de données
            $query = $dbh->prepare("INSERT INTO transactions (price_buy,announcement_id,buyer_id) VALUES (?,?,?)");
            $result = $query->execute([$price_buy, $announcement_id, $buyer_id]);
        }


        ?>



    </div>


</body>

</html>