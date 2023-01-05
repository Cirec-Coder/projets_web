<?php
    function formatDate(DateTime $aDateTime, $pattern = "eeee d MMMM yyyy", $locale = "fr_FR"): string
    {
        $formatter = new IntlDateFormatter($locale, IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
        $formatter->setPattern($pattern);
        $strDate = $formatter->format($aDateTime);

        $explodedDate = explode(" ", $strDate);
        $ret = "";
        $ret =  ucfirst($explodedDate[0]) . " " . 
            $explodedDate[1] . " " . 
            ucfirst($explodedDate[2]) . " "; 
            if (count($explodedDate) > 3) {
                $ret = $ret.$explodedDate[3];
            }
            return $ret;
    }

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
?>