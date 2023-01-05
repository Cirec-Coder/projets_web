<?php ob_start();?>

<?php

    $titre = "Cinema - Liste castings";

    $titre_secondaire ="Liste des castings";
    ?>
        <table>

            <thead>
                <tr>
                    <th scope="col">Nom Film</th>
                    <th scope="col">id Acteur</th>
                </tr>
            </thead>
        <tbody>

    <?php
    foreach ($showCasting as $casting) :
        
    ?>
        <tr>
            <td><?=$casting['titre_film']?></td>
            <td><?=$casting['Nom_act']?></td>
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