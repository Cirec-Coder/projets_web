<?php

session_start();
    // permet le chargement automatique des Classes utiles au code
    spl_autoload_register(function ($class_name) {
        include 'class/'.$class_name . '.php';
    });

include 'func/func_Helpers.php';

//  récupère le click et appel la fonction "populateSESSION()";
if (isset($_POST["btnSubmit"])) {

    switch ($_POST["btnSubmit"]) {

        case "reset":
            populateSESSION();
            header("Location:index.php");
        die();

        break;

        case "addClient":
                header("Location:addClient.php");
                die();
            
        break;

        case "addReservation":
                header("Location:addReservation.php");
                die();

        break;

    }
    
}

// ================== Gestion des retours des formulaires addClient & addReservation ================================

if (isset($_POST["submit"])) {
    switch ($_GET["action"]) {
        // ============= Ajout d'un Client =============
        case "doAddClient":
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fName = filter_input(INPUT_POST, "fName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 
            $_SESSION['message'] = 'Tous les champs sont obligatoire';

            if ($name && $fName) {
                foreach ($_SESSION['hotels'] as $index => $data) {
                    $hotel = new Hotel();
                    $hotel = unserialize(base64_decode($data['data']));
                    $hotel->addClient(new Client($fName, $name));
                    // mise à jour de l'objet
                    $_SESSION["hotels"][$index]["name"] = $hotel->getName();
                    $_SESSION["hotels"][$index]["data"] = base64_encode(serialize($hotel));
                }
                $_SESSION['message'] = 'Client Ajouté';
                header("Location:index.php");
                die();
            }
        break;
        // ============= Ajout d'une réservation =============
        case "doAddReservation":
            $hName = filter_input(INPUT_POST, "selectHotel", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $cName = filter_input(INPUT_POST, "selectClient", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nbPers = filter_input(INPUT_POST, "nbPers", FILTER_SANITIZE_NUMBER_INT);
            $nbBed = filter_input(INPUT_POST, "nbBed", FILTER_SANITIZE_NUMBER_INT);
            $wifi = filter_input(INPUT_POST, "wifi", FILTER_VALIDATE_BOOL);
            $dFrom = filter_input(INPUT_POST, "dFrom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dTo = filter_input(INPUT_POST, "dTo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $dTo = filter_input(INPUT_POST, "dTo", FILTER_SANITIZE_NUMBER_INT);
            
            $wifi = ($wifi) ?1 :0;
            if ($hName && $cName && $nbPers && $nbBed && $dFrom && $dTo) {

                foreach ($_SESSION['hotels'] as $index => $data) {
                    $hotel = new Hotel();
                    $hotel = unserialize(base64_decode($data['data']));

                    if ($data['name'] == $hName) {
                        foreach ($hotel->getClients() as $client) {
                            if ($client->getCondensedName() == $cName) {
                                $room = $hotel->findFreeRoom($nbPers, $nbBed, $wifi);
                                if (isset($room)) {
                                    $fromDate = new DateTime($dFrom);
                                    $toDate = new DateTime($dTo);
                                    // $toDate = ($fromDate->setTimezone(new DateTimeZone("Europe/paris")))->add(new DateInterval( 'P'.$dTo.'D' ));
                                    $dTo = $toDate->format('y-m-d');
                                    new Reservation($hotel, $room, $client, $dFrom, $dTo);
                                    // mise à jour de l'objet
                                    $_SESSION["hotels"][$index]["name"] = $hotel->getName();
                                    $_SESSION["hotels"][$index]["data"] = base64_encode(serialize($hotel));
                                    $_SESSION['message'] = "Réservation enregistée !!";
                                    header("Location:index.php");
                                    die();
                                } else {
                                    $_SESSION['message'] = "Réservation a échouée !!";
                                    header("Location:index.php");
                                    die();
                                }
                                break;
                             }
                             
                        }   
                        break;
                     }

                }

            } else {
                $_SESSION['message'] = "Tous les champs sont requis";
            }

        break;
    }
}

header("Location:index.php");

