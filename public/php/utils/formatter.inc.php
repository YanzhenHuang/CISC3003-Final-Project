<?php
/**
 * @param $dateTimeStr String in the format of date and time.
 */
function getDisplayTimeString($dateTimeStr)
{
    // dateTimeStr format: 2024-04-20 00:49:09
    $postDateTime = new DateTime($dateTimeStr);
    $curDateTime = new DateTime();

    $interval = $curDateTime->diff($postDateTime);

    $displayTimeString = "";
    if ($interval->y > 0) {
        $displayTimeString = $interval->y . ' y ago';
    } else if ($interval->m > 0) {
        $displayTimeString = $interval->m . ' mo ago';
    } else if ($interval->d > 0) {
        $displayTimeString = $interval->d . ' d ago';
    } else {
        $displayTimeString = $postDateTime->format('H:i');
    }

    return $displayTimeString;
}