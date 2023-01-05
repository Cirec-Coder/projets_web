<?php
    session_start();
    include 'helpers/functions.php';

    $url = "index.php";

    //  Gestion des nouvelles entrées
    if (isset($_POST['submit'])) {
        // $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $name = htmlspecialchars($_POST['name']);
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
        //  message d'erreur
        $_SESSION['message'] = "Erreur de saisie veuillez recommencer !";
    
        if ($name && $price && $qtt) {
 
            $product = [
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price*$qtt
            ];

            $_SESSION['products'][] = $product;
            //  si on arrive ici c'est que tout va bien
            //  et on le fait savoir 
            $_SESSION['message'] = "Bravo !! \\n    Votre nouveau produit a été enregisté avec succès.";
        }
        //  gestion du tri
    } elseif (isset($_GET['sortby'])) {

        $_SESSION['sortby'] = $_GET['sortby'];
        switch(true){
            // tri sur index
            case $_GET['sortby'] == 'idx': 
                ksort($_SESSION['products']);
            break;
            // tri sur name -> qtt -> price -> total
            case $_GET['sortby'] == 'name': 
                uasort($_SESSION['products'], function ($a, $b) {
                    
                    return sortBy($a, $b, ['name' => 'strcasecmp', 
                                           'qtt' => 'strnatcmp', 
                                           'price' => 'floatStrCmp', 
                                           'total' => 'floatStrCmp'
                                        ]);
                });
                break;
            // tri sur qtt -> name -> price -> total
            case $_GET['sortby'] == 'qtt': 
                uasort($_SESSION['products'], function ($a, $b) {
                    
                    return sortBy($a, $b, ['qtt' => 'strnatcmp', 
                                           'name' => 'strcasecmp', 
                                           'price' => 'floatStrCmp', 
                                           'total' => 'floatStrCmp'
                                        ]);
                });
                break;
            // tri sur price -> name -> qtt -> total
            case $_GET['sortby'] == 'price': 
                uasort($_SESSION['products'], function ($a, $b) {

                    return sortBy($a, $b, ['price' => 'floatStrCmp', 
                                           'name' => 'strcasecmp', 
                                           'qtt' => 'strnatcmp', 
                                           'total' => 'floatStrCmp'
                                        ]);
                });
                break;
            // tri sur total -> name -> qtt -> price
            case $_GET['sortby'] == 'total': 
                uasort($_SESSION['products'], function ($a, $b) {

                    return sortBy($a, $b, ['total' => 'floatStrCmp',
                                           'name' => 'strcasecmp', 
                                           'qtt' => 'strnatcmp', 
                                           'price' => 'floatStrCmp', 
                                        ]);
                });
                break;

        }

        $url = "recap.php";

        //  gestion des suppressions
    }  elseif (isset($_GET['delete'])) {
            //  si delete = all
        if ($_GET['delete'] == "all") {
            //  supprime toute les données
            $_SESSION['products'] = [];
            //  sinon il renvoi l'index de l'élément a supprimer
        } else {
            // suppression d'un élément 
            unset($_SESSION['products'][$_GET['delete']]);

        }
        
        $url = "recap.php";

        //  Gestion des modifications de quantité
    } elseif (isset($_GET['add']) or isset($_GET['sub'])) {
        $idx = $_GET['idx'];
        $qtt = $_SESSION['products'][$idx]["qtt"];
        $price = $_SESSION['products'][$idx]["price"];
            //  si augmenter
        if ($_GET['add']) {
            $qtt = $qtt + 1;
            //  si non on vérifie les limites 
            //  pour ne pas se retrouver avec une qtt négative.
        } elseif ($qtt > 1) {
            $qtt = $qtt - 1;
        }
        //  mise à jour des données modifiées
        $_SESSION['products'][$idx]["qtt"] = $qtt;
        $_SESSION['products'][$idx]["total"] = $price * $qtt;

        $url = "recap.php";
        }

    header("Location:".$url);
