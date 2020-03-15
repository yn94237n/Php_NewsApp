<?php

function todaysDate() {
    $today = getdate();
    $year = $today['year'];
    $month = $today['mon'];
    $day = $today['mday'];
    $myDate = "";
    
    if( strlen($month) == 1 ) {
        $month = "0" . $month . "";
    }

    if( strlen($day) == 1 ) {
        $day = "0" . $day . "";
    }
    $myDate = $year . "-" . $month . "-" . $day;
    return $myDate;
}

?>