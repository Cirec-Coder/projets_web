<?php
function formatDate(DateTime $aDateTime, $pattern = "eeee d MMMM yyyy", $locale = "fr_FR",  $separator = ' '): string
{
    $formatter = new IntlDateFormatter($locale, IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
    $formatter->setPattern($pattern);
    $strDate = $formatter->format($aDateTime);

    $splitedDate = preg_split("/( |-|\/)/", $strDate);
    $ret = "";
    $ret =  ucfirst($splitedDate[0]) . $separator .
        $splitedDate[1] . $separator .
        ucfirst($splitedDate[2]);
    if (count($splitedDate) > 3) {
        $ret = $ret . $separator . $splitedDate[3];
    }
    return $ret;
}

    /*
    
    */
    function minuteToStrTime(int $mn): string {
        $secPerHour = 60;
        $h = intdiv($mn, $secPerHour);
        $mn = $mn % $secPerHour;
        if ($mn == 0) {
            return $h . "h ";
        } else {
            return $h . "h " . $mn." min.";
        }
        
    }
