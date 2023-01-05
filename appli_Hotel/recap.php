<!-- 
    page récapitulative 
    elle sert à afficher les résultats 
 -->

<?php
spl_autoload_register(function ($class_name) {
    include 'class/' . $class_name . '.php';
});

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <title>Récapitulatif</title>
</head>

<body>
    <?php
    include 'view/header.php';
    ?>
    <main>
        <div class="title-container">
            <!-- =========================== Page récapitulative ================================= -->
            <?php
            // si $_SESSION['hotels'] n'existe pas ou est vide 
            if (!isset($_SESSION['hotels']) || empty($_SESSION['hotels'])) {
                echo "<p>Aucun hotel en session...</p>";
            } else { // sinon
                // si une action est présente :
                if (isset($_POST['action'])) {

                    switch ($_POST['action']) {
                            // on exécute le code qui correspond à la valeur de 'action'
                        case "status":
                            if (isset($_POST['select'])) {
                                $name = $_POST['select'];
                                // recupère les objets Hotel
                                foreach ($_SESSION['hotels'] as $index => $data) {
                                    if ($name == $data['name']) {
                                        // crée un objet Hotel vide
                                        $hotel1 = new Hotel();
                                        // et on "dé-sérialise" 
                                        $hotel1 = unserialize(base64_decode($data['data']));
                                        // controle des réservations dépassées
                                        $hotel1->checkResevations();
                                        echo "
                                    <table>
                                    <tr>
                                        <th scope='col' width='300px' >" . $name . " " . $hotel1->getStrNbStar() . " " . $hotel1->getCity() . "</th>
                                    </tr>
                                    
                                    <tr>
                                        <td>" . $hotel1->getAddress() . "</td>
                                    </tr>
                                    <tr>
                                        <td scope='col' >Nombre de chambres : " . $hotel1->getNbRoom() . "</td>
                                    </tr>
                                    <tr>
                                        <td scope='col' >Nombre de chambres réservées : " . $hotel1->getNbReservation() . "</td>
                                    </tr>
                                    <tr>
                                        <td scope='col' >Nombre de chambres dispo : " . $hotel1->getNbRoom() - $hotel1->getNbReservation() . "</td>
                                    </tr>
                                    </table>
                                    ";



                                        break; // foreach ($_SESSION['hotels'] as $index => $data)
                                    }
                                }
                            }
                            break; // case status

                            // =============== Etat des chambres ====================
                        case "showrooms":
                            if (isset($_POST['select'])) {
                                $name = $_POST['select'];
                                // recupère les objets Hotel
                                foreach ($_SESSION['hotels'] as $index => $data) {
                                    if (strtoupper($name) == strtoupper($data['name'])) {
                                        // crée un objet Hotel vide
                                        $hotel1 = new Hotel();
                                        // et on "dé-sérialise" 
                                        $hotel1 = unserialize(base64_decode($data['data']));
                                        $hotel1->checkResevations();
                                        $table = "<div class='tableDiv'>
                                    <table>
                                    <caption>Status des chambres du : " . $name . " " . $hotel1->getStrNbStar() . " " . $hotel1->getCity() . "</caption>
                                    <tr>
                                        <th scope='col' width='200px' align='left'>CHAMBRE&emsp;&emsp;</th>
                                        <th scope='col' width='100px'>PRIX</th>
                                        <th scope='col' width='100px'>WIFI</th>
                                        <th scope='col' width='200px'>ETAT</th>
                                    </tr>";

                                        // on récupère les chambres
                                        $rooms = $hotel1->getRooms();
                                        foreach ($rooms as $room) {
                                            $table .= "
                                        <tr>
                                            <td scope='row'>Chambre " . $room->getRoomNumber() . "</td>
                                            <td align='center'>" . $room->getPrice() . " €</td>";
                                            if ($room->getWifi()) {
                                                $table .= "<td align='center'><i class='fa-solid fa-wifi'></i></td>";
                                            } else {
                                                $table .= "<td></td>";
                                            }
                                            if ($room->getReserved()) {
                                                $table .= "<td align='center'><span id='reserved' class='state'>RESERVÉE</span></td>";
                                            } else {
                                                $table .= "<td align='center'><span id='disponible' class='state'>DISPONIBLE</span></td>";
                                            }
                                        }
                                        echo $table .= "</tr></table></div>";
                                        break;  // foreach ($_SESSION['hotels'] as $index => $data)
                                    }
                                }
                            }
                            break; // case showrooms
                            // =============== Affiche la liste des Hotels en SESSION ============
                        case "showhotels":
                            $table = "<table>
                            <caption>Liste des Hotels</caption>
                            <tr>
                                <th scope='col'>Nom</th>
                                <th scope='col'>Classement</th>
                                <th scope='col'>Adresse</th>
                            </tr>";

                            foreach ($_SESSION['hotels'] as $index => $data) {
                                $hotel1 = new Hotel();
                                $hotel1 = unserialize(base64_decode($data['data']));

                                $table .= "
                                <tr>
                                    <td scope='row'>" . $hotel1->getName() . "</td>
                                    <td align='right'>" . str_repeat('*', $hotel1->getNbStar()) . "</td>
                                    <td>" . $hotel1->getAddress() . "</td>";
                            }
                            $table .= "</tr>
                        </table>";
                            echo $table;
                            break; // case showhotels

                            // ===================== Affiche les réservation d'un Hotel =====================
                        case "showreservations":
                            if (isset($_POST['select'])) {
                                $name = $_POST['select'];
                                foreach ($_SESSION['hotels'] as $index => $data) {
                                    if (strtoupper($name) == strtoupper($data['name'])) {
                                        $hotel = new Hotel();
                                        $hotel = unserialize(base64_decode($data['data']));
                                        // $hotel->checkResevations();
                                        $resCount = $hotel->getNbReservation();
                                        $txt = ($resCount > 1) ? " Réservations" : " Réservation";
                                        $table = "
                                    <caption>Liste des Réservations de l'Hotel " . $hotel . "</caption>
                                    
                                    <p><br><span id='info' class='state'>" . $resCount . $txt . "</span></p><br>";
                                        $table .= "<table>
                                    
                                    <tr>
                                        <th scope='col'>CLIENT</th>
                                        <th scope='col'>CHAMBRE</th>
                                        <th scope='col'>DURÉE</th>
                                    </tr>
                                    ";

                                        $reservations = $hotel->getReservations();
                                        foreach ($reservations as $reservation) {
                                            if ($reservation->getReserved()) {
                                                $table .= "
                                            <tr>
                                                <td scope='row'>" . $reservation->getClient() . "</td>
                                                <td>Chambre " . $reservation->getRoom()->getRoomNumber() . "</td>
                                                <td>" . $reservation->getDuration(true) . "
                                            </td>";
                                            }
                                        }
                                        break; // foreach ($_SESSION['hotels'] as $index => $data)
                                    }
                                }
                                echo $table .= "</table>";
                            }
                            break; // case showreservations

                            // Affiche les réservations d'un Client
                        case "showreservation":
                            $ret = '';
                            $nbRes = 0;
                            if (isset($_POST['select'])) {
                                $name = $_POST['select'];
                                $total = 0;
                                foreach ($_SESSION['hotels'] as $index => $data) {
                                    $hotel = new Hotel();
                                    $hotel = unserialize(base64_decode($data['data']));
                                    $clients = $hotel->getClients();
                                    foreach ($clients as $client) {
                                        // si c'est le bon client
                                        if (strtoupper($client->getCondensedName()) == strtoupper($name)) {
                                            // on récupère le tableau les réservations
                                            $reservations = ($client->getReservations());
                                            // on les comptes
                                            $nbRes += count($reservations);
                                            // on parcours chaque élément
                                            foreach ($reservations as $reservation) {
                                                // converti le boolean "getWifi()" en litéral "oui" ou "non"
                                                $strWifi = ($reservation->getRoom()->getWifi()) ? "oui" : "non";
                                                // si la réservation correpond bien à l'hotel sélectionné
                                                if ($hotel->getName() == $reservation->getHotel()->getName()) {
                                                    // si la réservation est dépassée
                                                    if (!$reservation->getReserved()) {
                                                        $ret .= "<tr id='timeOut'>";
                                                    } else { // sinon on incrémente le total du prix * le nb de jours
                                                        $ret .= "<tr>";
                                                        $total += $reservation->getDuration() * $reservation->getRoom()->getPrice();
                                                    }
                                                    $ret .= "<td scope='row'>" . $hotel->getName() . "</td>
                                                    <td>Chambre : " . $reservation->getRoom()->getRoomNumber() . " ( " . $reservation->getRoom()->getNbBed() . " lits " . $reservation->getRoom()->getPrice() . " € Wifi : $strWifi )</td>
                                                    <td>" . $reservation->getDuration(true) . " ( " . $reservation->getDuration() . " jours )</td>
                                                    </tr>";
                                                }
                                            }
                                            break; // foreach ($clients as $client)
                                        }
                                    }
                                }
                                $txt = ($nbRes > 1) ? " Réservations" : " Réservation";
                                // si il n'y a pas de réservation on le fait savoir
                                if (!isset($client)) {
                                    echo "<caption>Pas de Réservations </caption>";
                                } else {
                                    // si il y en a on les Affiches
                                    echo "
                                <caption>Liste des Réservations de  " . $client . "</caption>
                                
                                <p><br><span id='info' class='state'>" . $nbRes . $txt . "</span></p><br>
                                <table>
                                
                                <tr>
                                    <th scope='col'>HOTEL</th>
                                    <th scope='col'>CHAMBRE</th>
                                    <th scope='col'>DURÉE</th>
                                </tr>
                                $ret
                                <tr>
                                <td colspan=3><strong>Total : </strong>$total €</td>
                                </tr>
                                </table>
                                ";
                                }
                            }
                            break; // case showreservation
                            // si l'action n'est pas gérée on retourne à l'index
                        default:
                            header("Location:index.php");
                            die();
                            break; // case default
                    }
                }
            }

            ?>
        </div>
    </main>
    <?php include_once "./view/footer.php" ?>
</body>

</html>