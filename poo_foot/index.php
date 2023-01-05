
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Football</title>
</head>

<body>
<?php include "./view/header.php" ?>
    <main id="container">
        <div class="menu">
            <h3>Pays</h3>
            <div class="dropdown-content">
                <?= buildMenuCountry(); ?>
            </div>
        </div>
        <div class="menu">
            <h3>Équipe</h3>
            <div class="dropdown-content">
                <?= buildMenuClub(); ?>
            </div>
        </div>
        <div class="menu">
            <h3>Joueur</h3>
            <div class="dropdown-content">
                <?= buildMenuPlayer(); ?>
            </div>
        </div>
        <?php include_once "./recap.php" ?>
    </main>
    <?php include_once "./view/footer.php" ?>
</body>

</html>