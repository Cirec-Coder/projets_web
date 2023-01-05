<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Ajout Client</title>
</head>

<body>
    <?php
    include 'view/header.php';
    ?>
    <main>
        <div class="title-container">
            <h2 class="title">Ajouter un Client</h2>
            <!-- =================== Formulaire d'ajout Client ========================== -->
            <form class="form" action='traitement.php?action=doAddClient' method='post'>
                <label for='name'>Nom du client :</label>
                <input type='text' name='name' id='name'>
                <label for='fName'>Prénom du client :</label>
                <input type='text' name='fName' id='fName'>
                <input type='submit' name='submit' value='Ajouter'>
            </form>
        </div>
    </main>
    <?php include_once "./view/footer.php" ?>

</body>

</html>