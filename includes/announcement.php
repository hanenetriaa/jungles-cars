<?php


$dbh = new PDO("mysql:dbname=projetphp;host=localhost", "root", "root");


// Récupération données de la table announcement

$query = $dbh->query("SELECT a.*, MAX(t.price_buy) AS max_price_buy FROM announcements a LEFT JOIN transactions t ON a.id=t.announcement_id GROUP BY a.id");
// Récupération données de la table announcement


/**
 * Récupération des données de la requête
 * sous forme de tableau associatif
 */
$announcement = $query->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://localhost/jungle-cars/style/announcement.css">
    <script src="https://kit.fontawesome.com/7c9cc9d9e6.js" crossorigin="anonymous"></script>
    <title>Annonce</title>
</head>

<body>
    <div>
        <ul>
            <?php foreach ($announcement as $offer) {
                $status = "";
                $date = date('d-m-y h:i:s');
                if ($offer["end_date"] >= $date) {
                    $status = "En cours";
                } else {
                    $status = "Enchère terminée";
                }

            ?>
                <div class="offer">
                    <p>N° de l'offre : <?= $offer["id"] ?></p>
                    <p>Marque du véhicule : <?= $offer["brand"] ?></p>
                    <p>Modèle : <?= $offer["model"] ?></p>
                    <p>Prix : <?= $offer["price"] ?> €</p>
                    <p>Status : <?= $status ?></p>
                    <p>Date de fin de l'enchère : <?= $offer["end_date"] ?></p>
                    <p>L'enchere la plus élévé: <?= $offer["max_price_buy"] ?? 0 ?>€</p>
                    <div class="btn">

                        <button class="btnDetails"><a href="includes/details.php?id=<?= $offer["id"]; ?>">
                                Détails du véhicule / Enchérir
                            </a>&emsp;<i class="fa-solid fa-gavel"></i></button>
                    </div>
                </div>
            <?php } ?>
        </ul>
    </div>



</body>

</html>