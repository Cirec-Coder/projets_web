<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/adresses' => [[['_route' => 'app_adresses', '_controller' => 'App\\Controller\\AdressesController::getAdresseList'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/adresses/(?'
                    .'|([^/]++)(*:67)'
                    .'|nom/(.+)(*:82)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        67 => [[['_route' => 'app_detailAdresses', '_controller' => 'App\\Controller\\AdressesController::getDetailAdresse'], ['id'], ['GET' => 0], null, false, true, null]],
        82 => [
            [['_route' => 'app_detailName', '_controller' => 'App\\Controller\\AdressesController::getDetailName'], ['nom'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
