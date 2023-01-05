<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Récapitulatif des produits</title>
</head>
<body>
    <?php
    include 'view/header.php';
    ?>
    <div class="title-container">
    <h2 class="title">Liste des produits ajoutés</h2>
    <?php
    if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
        echo "<p>Aucun produit en session...</p>";
    } else {
        // if (isset($_SESSION['sortby'])) {
            $sidx = (isset($_SESSION['sortby']) && $_SESSION['sortby'] == 'idx') ?'-sorted' :'';
            $sname = (isset($_SESSION['sortby']) && $_SESSION['sortby'] == 'name') ?'-sorted' :'';
            $sprice = (isset($_SESSION['sortby']) && $_SESSION['sortby'] == 'price') ?'-sorted' :'';
            $sqtt = (isset($_SESSION['sortby']) && $_SESSION['sortby'] == 'qtt') ?'-sorted' :'';
            $stotal = (isset($_SESSION['sortby']) && $_SESSION['sortby'] == 'total') ?'-sorted' :'';
        // } else {
        //     $sidx = '';
        // }
        
        echo "<table class='title'>",
                "<thead>",
                    "<tr>",
                        "<th class='thHead'>#<a href='traitement.php?sortby=idx' ><i id='sorted".$sidx."' class='fa-solid fa-arrow-down-a-z'></i></a></th>",
                        "<th class='thHead text'>Nom<a href='traitement.php?sortby=name' ><i id='sorted".$sname."' class='fa-solid fa-arrow-down-a-z'></i></a></th>",
                        "<th class='thHead'>Prix<a href='traitement.php?sortby=price' ><i id='sorted".$sprice."' class='fa-solid fa-arrow-down-a-z'></i></a></th>",
                        "<th class='thHead'>Quantité<a href='traitement.php?sortby=qtt' ><i id='sorted".$sqtt."' class='fa-solid fa-arrow-down-a-z'></i></a></th>",
                        "<th class='thHead'>Total<a href='traitement.php?sortby=total' ><i id='sorted".$stotal."' class='fa-solid fa-arrow-down-a-z'></i></a></th>",
                        "<th class='thEnd'><a href='traitement.php?delete=all'><i title='Supprime tout le panier !' id='deleteAll' class='fa-regular fa-trash-can'></i></a></th>",
                        // "<th class='thEnd'></th>",
                    "</tr>",
                "</thead>",
                "<tbody>";
        $totalGeneral = 0;
        foreach ($_SESSION['products'] as $index => $product) {
            echo "<tr>",
                    "<td class='idx'>".$index."</td>",
                    "<td>".$product['name']."</td>",
                    "<td class='numbers'>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "<td class='numbers'><a href='traitement.php?idx=".$index."&add=true'><i title='plus 1' id='plus' class='fa-solid fa-plus'> </i>&nbsp;&nbsp;</a>".$product['qtt']."<a href='traitement.php?idx=".$index."&sub=true'>&nbsp;&nbsp;<i title='moins 1' id='minus' class='fa-solid fa-minus'></i></a></td>",
                    "<td class='numbers'>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "<td><a href='traitement.php?delete=".$index."'><i title='Supprime l&apos;élément nommé  : ".$product['name']."' id='delete' class='fa-regular fa-trash-can'></i></a></td>",
                "</tr>";
            $totalGeneral += $product['total'];
        }
        echo "<tr>",
                "<td colspan=4>&emsp;Total général</td>",
                "<td class='numbers'><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                "<td class='tdEnd'></td>",
                // "<td><a href='traitement.php?delete=all'><i title='Supprime tout le panier !' id='deleteAll' class='fa-regular fa-trash-can'></i></a></td>",
    "</tr>",
            "</tbody>",
            "</table>";
    }
    // echo "</tbody>",
    //     "</table>";


    ?>
    </div>
    <?php include_once "./view/footer.php" ?>
</body>

</html>