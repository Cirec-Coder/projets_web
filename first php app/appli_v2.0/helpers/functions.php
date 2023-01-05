<?php
//  ────────────────── Renvoi le nombre d'articles dans e tabeau ──────────────────
function getNbArticle(){
    return (empty($_SESSION["products"])) ?0 :count($_SESSION["products"]);
}

// ────────────────── trie sur chaine de caractères contenant des réels ──────────────────
function floatStrCmp(string $a, string $b): int {
    if (floatval($a) == floatval($b)) {
     return 0;
    } else {
     return (floatval($a) < floatval($b)) ?-1 :1;
    }
}

//  ────────────────── tri multicritères sur tabeau reationnel ──────────────────
/*
* Fonction sortBy sert à effectuer un trie sur tabeau reationnel
* @param $a     =   ['cle' => 'valeur']
* @param $b     =   ['cle' => 'valeur']
* @param $c     =   ['cle à trier' => 'fonction de trie à utiliser'] Ex. ['name' => 'strcasecmp', 
                                                                          'qtt' => 'strnatcmp', 
                                                                          'price' => 'floatStrCmp', 
                                                                          'total' => 'floatStrCmp'
                                        ]
* @return $ret  =   0 si = -1 si < 1 si >
*/
function sortBy(array $a, array $b, array $c) {
                    
    foreach ($c as $key => $value) {
        $ret = $value($a[$key], $b[$key]);
        if ($ret <> 0) {
            break;
        }
    }
    return $ret;
}

