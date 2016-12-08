<?php

/**
 * Geolocation Query - Extends WP_Query to do geographic searches
 * Expects post type to have two meta fields: latitude & longitude
 * Options passed in $args which are unique to this class:
 * @var float latitude : Source location latitude [REQUIRED]
 * @var float longitude : Source location longitude [REQUIRED]
 * @var int distance : Radius in which to search for results [OPTIONAL, BUT REQUIRES LAT/LNG]
 *
 * Note: since this extends WP_Query, you can use it without lat/lng
 * and it will simply return what would've been returned with a
 * standard WP_Query query based on your $args
 */

class WP_GeoQuery extends WP_Query {

    /**
     * Constructor - adds necessary filters to extend Query hooks
     */
    public function __construct($args = array()) {

        // Get Latitude
        if(!empty($args['latitude']))
        {
            $this->_search_latitude = $args['latitude'];
        }

        // Get Longitude
        if(!empty($args['longitude']))
        {
            $this->_search_longitude = $args['longitude'];
        }

        // Get Distance
        if(!empty($args['distance']))
        {
            $this->_search_distance = $args['distance'];
        }

        add_filter('posts_fields', array(&$this, 'posts_fields'), 10, 2);
        add_filter('posts_join', array(&$this, 'posts_join'), 10, 2);
        add_filter('posts_where', array(&$this, 'posts_where'), 10, 2);
        add_filter('posts_orderby', array(&$this, 'posts_orderby'), 10, 2);
        add_filter('posts_groupby', array(&$this, 'posts_groupby'), 10, 2); // Actually used to pass a HAVING clause

        parent::query($args);

    }

    /**
     * Selects the distance from a haversine formula
     */
    public function posts_fields($fields) {
        global $wpdb;

        if(!empty($this->_search_latitude) && !empty($this->_search_longitude))
        {
            $fields .= sprintf(", ( 3959 * acos(
                    cos( radians(%s) ) *
                    cos( radians( latitude.meta_value ) ) *
                    cos( radians( longitude.meta_value ) - radians(%s) ) +
                    sin( radians(%s) ) *
                    sin( radians( latitude.meta_value ) )
                ) ) AS distance ", $this->_search_latitude, $this->_search_longitude, $this->_search_latitude);
        }

        $fields .= ", latitude.meta_value AS latitude ";
        $fields .= ", longitude.meta_value AS longitude ";

        return $fields;
    }

    /**
     * Makes joins as necessary in order to select lat/long metadata
     */
    public function posts_join($join, $query) {
        global $wpdb;

        $join .= " INNER JOIN ".$wpdb->postmeta." AS latitude ON ".$wpdb->posts.".ID = latitude.post_id ";
        $join .= " INNER JOIN ".$wpdb->postmeta." AS longitude ON ".$wpdb->posts.".ID = longitude.post_id ";

        return $join;
    }

    /**
     * Adds where clauses to compliment joins
     */
    public function posts_where($where) {
        $where .= ' AND latitude.meta_key="latitude" ';
        $where .= ' AND longitude.meta_key="longitude" ';

        return $where;
    }

    /**
     * Adds GROUP BY, which is where we slipstream in the HAVING clause for distance - since WP doesn't support
     * MySQL HAVING clauses in the standard filter hooks. Kind of hacky, but hey, it works. /tww
     */
    public function posts_groupby($groupby) {
        if($this->_search_distance && $this->_search_latitude && $this->_search_longitude){
            $groupby .= ' HAVING distance <= '.$this->_search_distance;
        }

        return $groupby;
    }

    /**
     * Adds where clauses to compliment joins
     */
    public function posts_orderby($orderby) {
        if(!empty($this->_search_latitude) && !empty($this->_search_longitude))
        {
            $orderby = " distance ASC, " . $orderby;
        }

        return $orderby;
    }
}

?>