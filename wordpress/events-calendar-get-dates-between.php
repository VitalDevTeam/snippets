<?php

// Create an array of active dates between two dates.
// This is most useful when you need to create an array of active dates to send to a jqueryui (or somesuch) calendar
// This example uses WP Tribe Events Calendar functions to determine start/end date, but you could pass anything to it
// in $start_date/$end_date NOTE: requires PHP 5.3.0 or greater because of the DatePeriod iterator class on ln 13

$start_date = tribe_get_start_date($post->ID, null, 'Y-m-d');
$end_date = tribe_get_end_date($post->ID, null, 'Y-m-d');

if ($start_date != $end_date) {
    $start_date = new DateTime($start_date);
    $end_date = new DateTime($end_date);
    $active_date_crawl = new DatePeriod(
        $start_date,
        new DateInterval('P1D'),
        $end_date->modify('+1 day') // Add 1 day to end_date for end date 'inclusive'
    );

    // Loop through iterator results and add them to active_dates array
    // Note: you could also use iterator_to_array($active_date_crawl), but you would still need to extract vals
    foreach ($active_date_crawl as $d) {
        $active_dates[] = $d->format("Y-m-d");
    }

} else {
    $active_dates[] = $start_date;
}

// At this point, $active_dates would be set to an array of dates for your range. Giggity.

?>