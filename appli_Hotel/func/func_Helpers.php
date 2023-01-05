<?php
session_start();
// permet le chargement automatique des Classes utiles au code
spl_autoload_register(function ($class_name) {
    include 'class/'.$class_name . '.php';
});


function populateSESSION(){
$hotel = new Hotel('Regent', '61', 'Rue Dauphine', '75006', 'Paris', 4);
$hotel2 = new Hotel('Hilton', '1', 'Av. Herrenschmidt', '67000', 'Strasbourg', 4);
$hotel3 = new Hotel('Georges V', '31', 'Av. George V', '75008', 'Paris', 4);
for ($i=0; $i < 30; $i++) { 
    $hotel->addRoom(new Room($i+1, random_int(2,5), random_int(1,3), random_int(110, 300), random_int(0,1), false));
    $hotel2->addRoom(new Room($i+1, random_int(2,5), random_int(1,3), random_int(110, 300), random_int(0,1), false));
    $hotel3->addRoom(new Room($i+1, random_int(2,5), random_int(1,3), random_int(110, 300), random_int(0,1), false));
}


//  on efface tout
$_SESSION["hotels"] = [];

$_SESSION["hotels"][] = ["name" => $hotel->getName(),
                        "data" => base64_encode(serialize($hotel))
                        ];

$_SESSION["hotels"][] = ["name" => $hotel2->getName(),
                        "data" => base64_encode(serialize($hotel2))
                        ];

$_SESSION["hotels"][] = ["name" => $hotel3->getName(),
                        "data" => base64_encode(serialize($hotel3))
                        ];
}

function createHotelSelectList(): string{
$ret = '';
foreach ($_SESSION['hotels'] as $index => $data) {
    $ret .= '<option value="'.$data['name'].'">'.$data['name'].'</option>';
}
return $ret;
}

function createClientSelectList(): string{
$ret = '';
$names = null;
foreach ($_SESSION['hotels'] as $index => $data) {
    $hotel = new Hotel();
    $hotel = unserialize(base64_decode($data['data']));
    foreach ($hotel->getClients() as $client) {
        $names[$client->getCondensedName()] = $client->getFirstName()." ".$client->getName();
    }
}
    // var_dump($names);
    if ($names == null) {
        $ret .= '<option value="">pas de Client</option>';
    } else {
        foreach ($names as $key => $name) {
            $ret .= '<option value="'.$key.'">'.$name.'</option>';
        }
    }
return $ret;
}
?>