<?php
include 'func/func_Helpers.php';

?>
    <!--  Crée les formulaires pour gérer l'affichage et les données   -->
    <form class="formHotel" action="recap.php" method="post">
        <div id="select-hotel-div">
        <label for="select-hotel">Sélectionnez un Hotel au choix : </label>
        <select  name="select" id="select-hotel">
    <!-- crée et insert la liste des hotels -->
        <?php echo createHotelSelectList() ?>
        </select>
        </div>
        <div class="divFormHotel">
    <!-- // voir le status d'un Hotel -->
        <button type="submit" name="action" class="action" value="status" >Satus de l'Hotel : </button>
    <!-- // voir le status des chambres d'un Hotel -->
        <button type="submit" name="action" class="action" value="showrooms" >Satus des chambres de l'Hotel : </button>
    <!-- // voir les réservations d'un Hotel -->
        <button type="submit" name="action" class="action" value="showreservations" >Récapitulatif des réservations de l'Hotel : </button>
        </div>
    </form><br>


    <form class="form" action="recap.php" method="post">
    <!-- // voir les réservation d'un Client -->
        <button type="submit" name="action" class="action" value="showreservation" >Récapitulatif des réservations de </button>
        <select name="select">
    <!-- crée et insert la liste des Clients -->
        <?php echo createClientSelectList() ?>
        </select>
    </form><br>
 
    <div><form class='form' action='traitement.php' method='post'>
    <!-- // ajouter un Client -->
            <button type='submit' name='btnSubmit' class='btnSubmit' value='addClient' >Ajouter un Client</button>
    <!-- // Ajouter une réservation à un Client -->
            <button type='submit' name='btnSubmit' class='btnSubmit' value='addReservation' >Ajouter une Réservation</button>
    </form></div>

 
    <div class='frReset__div'><form class='frmReset' action='traitement.php' method='post'>
    <!-- // Réinitialise la SESSION --> 
            <button type='submit' name='btnSubmit' class='btnSubmit' value='reset' >Reset Session Hotel</button>
    </form></div>

