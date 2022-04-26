<?php
require_once __DIR__ . "/includes/db.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /* récupérer les données du formulaire en utilisant 
        la valeur des attributs name comme clé 
       */
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $km = $_POST['km'];
    $engine_capacity = $_POST['engine_capacity'];
    $color = $_POST['color'];
    $fuel = $_POST['fuel'];
    $transmission = $_POST['transmission'];
    $end_date = $_POST['end_date'];



    // Insertion en base de données
    $query = $dbh->prepare("INSERT INTO announcements (brand, model, year, price, description, km, engine_capacity, color, fuel, transmission, end_date) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $result = $query->execute([$brand, $model, $year, $price, $description, $km, $engine_capacity, $color, $fuel, $transmission, $end_date]);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/submitOffer.css" media="screen" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jungle-cars</title>
</head>

<body>
    <!-- Menu -->
    <?php include __DIR__ . "/includes/menu.php"; ?>

    <body>
        <div align="center">
            <div class="container-header">
                <h2>Déposer un annonce</h2>
            </div>

            <form method="POST" action="submitOffer.php" enctype="multipart/form-data">
                <TABLE>
                    <tr>
                        <td align="right">
                            <label for="brand">Marque :</label>
                        </td>
                        <td>
                            <input type="text" id="brand" name="brand">
                        </td>
                    </tr>

                    <tr>
                        <td align="right">
                            <label for="model">Modèle :</label>
                        </td>
                        <td>
                            <input type="text" id="model" name="model">
                        </td>

                    <tr>
                        <td align="right">
                            <label for="year">1ere année d'immatriculation :</label>
                        </td>
                        <td>
                            <input type="text" id="year" name="year">
                        </td>
                    </tr>

                    <tr>
                        <td align="right">
                            <label for="price">Prix :</label>
                        </td>
                        <td>
                            <input type="text" id="price" name="price">
                        </td>
                    </tr>
                    <td align="right">
                        <label for="description">Description :</label>
                    </td>
                    <td>
                        <textarea id="description" name="description" class="textform" cols="30" rows="5"></textarea>
                    </td>
                    </tr>


                    <tr>
                        <td align="right">
                            <label for="km">Nombre de KM au compteur :</label>
                        </td>
                        <td>
                            <input type="number" id="km" name="km">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="engine_capacity">Puissance :</label>
                        </td>
                        <td>
                            <input type="text" id="engine_capacity" name="engine_capacity">
                        </td>
                    </tr>

                    <tr>
                        <td align="right">
                            <label for="color">Couleur :</label>
                        </td>
                        <td>
                            <input type="text" id="color" name="color">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="fuel">Carburant :</label>
                        </td>
                        <td>
                            <input type="text" id="fuel" name="fuel">
                        </td>
                    </tr>

                    <tr>
                        <td align="right">
                            <label for="transmission">Transmission :</label>
                        </td>
                        <td>
                            <input type="text" name="transmission">
                        </td>
                    </tr>

                    <tr>
                        <td align="right">
                            <label for="end_date">Date de fin de l'annonce :</label>
                        </td>
                        <td>
                            <input type="datetime-local" name="end_date">
                        </td>
                    </tr>



                    <td align="right">
                        <label for="envoyer"></label>
                    </td>
                    <td>
                        <input type="submit" name="formannonce" id="formannonce" value="Envoyer">
                        <input type="reset" value="Effacer">
                    </td>
                    </tr>

                </table>

            </form>

    </body>
</body>


</html>