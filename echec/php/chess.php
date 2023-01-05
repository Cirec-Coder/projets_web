
<?php

// tableau désignant les pièces
$pieces = ["tour", "cavalier", "fou", "reine", "roi", "fou", "cavalier", "tour", "pion", "pion", "pion", "pion", "pion", "pion", "pion", "pion"];


// construction du GamePad
 $gamePad = "<div class='container'>
    <div class='gamePad' id='gamePad'>";
    // permet de faire la bascule entre case noire et blanche
    $black = false;
    for ($i=1; $i <= 8 ; $i++) { 
        $black = ! $black;
        for ($j=1; $j <= 8 ; $j++) { 
            $black =! $black;
            $class = $black ? ' black' : '';
            $pieceName = '';

            // les 2 premères lignes Pions Noirs
            if ($i <= 2) {
                $pieceName = "<img src='./img/".$pieces[($i-1) * 8 + $j - 1]."_n.png'>";
                // $pieceName = $pieces[($i-1) * 8 + $j - 1] . " NOIR";
            } 
            // les 2 dernières lignes Pions Blancs
            else if ($i >= 7) {
                $pieceName = "<img src='./img/".$pieces[(8-$i) * 8 + $j - 1]."_b.png'>";
                // $pieceName = $pieces[(8-$i) * 8 + $j - 1] . " BLANC";
            }

            $gamePad .= "<div class='case$class'>$pieceName</div>";
        }
    }
    $gamePad.= "</div>
    </div>";
echo $gamePad;
