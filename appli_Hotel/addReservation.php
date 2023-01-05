<?php
include 'func/func_Helpers.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Ajout Reservation</title>
</head>

<body>
    <?php
    include 'view/header.php';
    ?>
    <main>
        <div class="title-container">
            <h2 class="title">Réservation</h2>
            <div class="form">
                <!-- =================== Formulaire de réservation chambre ========================== -->
                <?php
                $date = (new DateTimeImmutable())->setTimezone(new DateTimeZone("Europe/paris"));
                $strDate = $date->format("Y-m-d\TH:i");
                $date2 = $date->add(new DateInterval('P1D'));
                $strDate2 = $date2->format("Y-m-d\TH:i");
                echo "<form id='formReservation' action='traitement.php?action=doAddReservation' method='post'>
            
            <label class='label' for='SelectHotel'>Hotel : </label>
            <select class='input__text' name='selectHotel'>"
                    . createHotelSelectList() .
                    "</select>
            
            

            <label class='label' for='SelectClient'>Client : </label>
            <select class='input__text' name='selectClient'>"
                    . createClientSelectList() .
                    "</select>
            
            

            <label class='label' for='nbPers'>Nb Personnes : </label>
            <input class='input__number' type='number' name='nbPers' id='nbPers' value=1 min=1 max=5>
            
            
           
            <label class='label' for='nbBed'>Nb Lits : </label>
            <input class='input__number' type='number' name='nbBed' id='nbBed' value=1 min=1 max=3>
            
            
           
            
            <div><label class='label' for='wifi'>Wifi : </label>
            <input type='checkbox' name='wifi' id='wifi' checked></div>
            ";

                // ajout de la partie DateTime 
                include './asset/dateInterval.php';

                echo "<input type='submit' name='submit' value='Ajouter'>
                </form>";

                ?>
            </div>
        </div>
        </div>
    </main>
    <?php include_once "./view/footer.php" ?>


</body>

</html>