<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Reservation Hotels</title>
</head>

<body>
    <?php include_once "./view/header.php" ?>
    <main>
        <div class="title-container">
            <h2 class="title">Tableau de bord</h1>
                <?php
                // Affiche le "Tableau de Bord"
                include 'asset/dashBoard.php';
                // gestion de l'affichage des messages de Succès ou d'Erreur
                if (isset($_SESSION['message'])) {
                ?>
                    <script>
                        alert('<?php echo $_SESSION['message'] ?>');
                    </script>
                <?php
                    $_SESSION['message'] = null;
                }
                ?>

        </div>
    </main>
    <?php include_once "./view/footer.php" ?>
</body>

</html>