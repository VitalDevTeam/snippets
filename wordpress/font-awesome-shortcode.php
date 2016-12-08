<?php
/*   Font Awesome
     EXAMPLE: [fa icon="fa-search" color="#555555"]
    --------------------------------------------------------------------------  */
    function font_awesome_shortcode( $atts ) {
        extract( shortcode_atts( array(
            'icon' => 'fa-question-circle',
            'color' => '#555555'
        ), $atts ) );
        return "<span class='fa {$icon}' style='color:{$color}'></span>";
    }
    add_shortcode( 'fa', 'font_awesome_shortcode' );
