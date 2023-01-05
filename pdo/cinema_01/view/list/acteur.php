<?php ob_start();?>

<?php

    $titre = "Cinema - Liste acteurs";

    $titre_secondaire ="Liste des acteurs";
    ?>
        <table>
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Date de Naissance</th>
                </tr>
            </thead>
        <tbody>

    <?php
    foreach ($listActeurs as $acteur) :
        
    ?>
        <tr>
            <td><?=$acteur['nom_acteur']?></td>
            <td><?=$acteur['prenom_acteur']?></td>
            <td><?=$acteur['sex']?></td>
            <td><?=$acteur['date_acteur']?></td>
        </tr>
    <?php
    endforeach;
    ?>
        </tbody>
    </table>
    <?php
    $contenu = ob_get_clean();

    require "view/template.php";

?>