<?php
/**
 * Takes source and destination lat/lon and calculates distance
 * @note Distance is 'as the crow flies' - not driving
 * @param  float $latitude        Source Latitude
 * @param  float $longitude       Source Longitude
 * @param  float $store_latitude  Destination Latitude
 * @param  float $store_longitude Destination Longitude
 * @param  str   $unit            Unit of measure [Default: miles]
 * @return float                  Distance in miles
 */
function get_distance($latitude, $longitude, $store_latitude, $store_longitude, $unit = 'mi') {

    // Conversion multiples => Unit to multiple
    $unit_multiples = array(
        'km' => 1.60934,
        'ft' => 5280,
    );

    $earthRadius = 3959; // Miles
    $latFrom = deg2rad($latitude);
    $lonFrom = deg2rad($longitude);
    $latTo = deg2rad($store_latitude);
    $lonTo = deg2rad($store_longitude);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    $miles = number_format((float)$angle * $earthRadius, 1, '.', '');

    // Convert?
    if( $unit && $unit_multiples[$unit] ){
        $distance = $miles * $unit_multiples[$unit];
    } else {
        $distance = $miles;
    }

    return round($distance, 1);
}
