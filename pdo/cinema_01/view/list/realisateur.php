<?php ob_start();?>


<?php

    $titre = "Cinema - Liste réalisateurs";

    $titre_secondaire ="Liste des réalisateurs";
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
    foreach ($listRealisateurs as $realisateur) :
        
    ?>
        <tr>
            <td><?=$realisateur['nom_realisateur']?></td>
            <td><?=$realisateur['prenom_realisateur']?></td>
            <td><?=$realisateur['sex']?></td>
            <td><?=$realisateur['date_realisateur']?></td>
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