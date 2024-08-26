<?php
namespace DEC\shortcode;

defined( 'ABSPATH' ) || exit;

class Upcoming_Events {

    function __construct() {
        add_shortcode( 'upcoming_events_list', array( $this, 'upcoming_event_list_callback' ) );
    }

    function upcoming_event_list_callback( $atts, $shortcode ){

        $atts = shortcode_atts( array(
            'number' => '9',
            'column' => '4',
        ), $atts );

        // Get today's date in YYYY-MM-DD format
        $today = date('Y-m-d');

        $args = array(
            'post_type'      => 'event',
            'posts_per_page' => $atts['number'],
            'meta_query'     => array(
                array(
                    'key'     => 'event_start_date',
                    'value'   => $today,
                    'compare' => '>=',
                    'type'    => 'DATE',
                ),
            ),
            'orderby'       => 'meta_value',
            'order'         => 'ASC',
        );

        $query = new \WP_Query($args);

        $output = '';
        $output .= '<div class="container">';
            $output .= '<div class="events-listing">';
                $output .= '<div class="row">';
                    while ( $query->have_posts() ) {
                        $query->the_post();

                        $output .= '<div class="col-md-'.$atts['column'].'">';
                            $output .= '<div class="single-event-listing">';
                                if ( has_post_thumbnail() ){
                                    $output .= '<a href="'.get_the_permalink().'">';
                                        $output .= get_the_post_thumbnail(get_the_ID(), array(300,400), array('class' => 'img-responsive'));
                                    $output .= '</a>';
                                }
                                $output .= '<div class="title-wrap">';
                                    $output .= '<h2><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>';
                                    $output .= '<p>'.DEC()->limit_word_text(strip_tags(get_the_content()), 70).'...</p>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    }
                $output .= '</div>';
            $output .= '</div>';
        $output .= '</div>';

        // Restore original Post Data
        wp_reset_postdata();

        return $output;
    }
}
