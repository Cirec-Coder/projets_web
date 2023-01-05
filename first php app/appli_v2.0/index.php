<?php
session_start();
// global $message;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="css/style.css">
    <title>Ajout produit</title>
</head>
<body>
    <?php include_once "./view/header.php" ?>
    <div class="title-container">
    <h2 class="title">Ajouter un produit</h1>
    <form class="add" action="traitement.php" method="post">
        <p>
            <label >
                Nom du produit : 
                <input type="text" name="name" placeholder="Ex. Orange sanguine">
            </label>
        </p>
        <p>
            <label >
                Prix du produit : 
                <input type="number" name="price" step="any" min="0" placeholder="Ex. 2.75">
            </label>
        </p>
        <p>
            <label >Quantité désirée : 
                <input type="number" name="qtt" value="1" min="0">
            </label>
        </p>
        <p>
            <input type="submit" name="submit" value="Ajouter le produit">
        </p>
    </form>
</div>
<!-- <button onclick="javascript:window.location.href = 'recap.php'">recap</button> -->
<?php include_once "./view/footer.php" ?>
    <?php
        if (isset($_SESSION['message'])) {
            ?>
            <script>
               alert('<?php  echo $_SESSION['message'] ?>');
            </script>
        <?php 
            $_SESSION['message'] = null;
                }
    ?>
</body>
</html>