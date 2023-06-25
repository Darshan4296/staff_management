<?php

function getDateDifference($dateStart, $dateEnd) {

    if (empty($dateStart) || empty($dateEnd)) {
        return '';
    }

    // Define the two dates
    $startDateTime = new DateTime($dateStart);
    $endDateTime = new DateTime($dateEnd);

    // Calculate the difference between the dates
    $interval = $startDateTime->diff($endDateTime);

    // Retrieve the difference in hours, minutes, and seconds
    $hours = $interval->h;
    $minutes = $interval->i;
    $seconds = $interval->s;

    $difference = '';
    if ($hours) {
        $difference .= sprintf("%s hours", $hours);
    }

    if ($hours || $minutes) {
        $difference .= sprintf(" %s minutes", $minutes);
    }

    $difference .= sprintf(" %s seconds", $seconds);

    return $difference;
}

?>