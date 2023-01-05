<?php ob_start();?>

<?php

    $titre = "Cinema - Liste genres";

    $titre_secondaire ="Liste des genres";
    ?>
        <table>
            <thead>
                <tr>
                    <th scope="col">Nom Genre</th>
                    <th scope="col">id Genre</th>
                </tr>
            </thead>
        <tbody>

    <?php
    foreach ($listGenres as $genre) :        
    ?>
        <tr>
            <td><?=$genre['nom_genre']?></td>
            <td><?=$genre['id_genre']?></td>
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