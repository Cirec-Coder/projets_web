<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout produit</title>
</head>
<body>
    <h1>Ajouter un produit</h1>
    <form action="traitement.php" method="post">
        <p>
            <label >
                Nom du produit : 
                <input type="text" name="name">
            </label>
        </p>
        <p>
            <label >
                Prix du produit : 
                <input type="number" name="price" step="any" min="0">
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
</body>
</html>