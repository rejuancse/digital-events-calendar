<?php
namespace DEC\shortcode;

defined( 'ABSPATH' ) || exit;

class Events_Listing {

    function __construct() {
        add_shortcode( 'event_listing', array( $this, 'events_listing_callback' ) );
    }

    function events_listing_callback( $atts, $shortcode ){  

        $a = shortcode_atts(array(
                'cat'         => null,
                'number'      => -1,
                'order'       => 'DESC',
            ), $atts, $shortcode );

        $html = '';

        $paged = 1;
        if ( get_query_var('paged') ){
            $paged = absint( get_query_var('paged') );
        } elseif (get_query_var('page')) {
            $paged = absint( get_query_var('page') );
        }

        $query_args = array(
            'post_type'     => 'event',
            'post_status'   => 'publish',
            'posts_per_page'    => $a['number'],
            'paged'             => $paged,
            'orderby'           => 'post_title',
            'order'             => $a['order'],
        );

        if( $a['cat'] ){
            $cat_array = explode(',', $a['cat']);
            $query_args['tax_query'][] = array(
                'taxonomy'  => 'event_cat',
                'field'     => 'slug',
                'terms'     => $cat_array,
            );
        }

        $data = new \WP_Query( $query_args ); ?>

        <div id="content" class="latest-event-content col-md-8 events" role="main">
        <div class="box">
        <h2 class="heading">Past Events</h2>



        <?php if ( $data->have_posts() ) :
        while ( $data->have_posts() ) : $data->the_post(); ?>


            <div id="post-814" class="post-814 event type-event status-publish has-post-thumbnail hentry event_cat-floral-pavilion event_cat-national-party">
                                
                <div class="media">
                    <div class="pull-left">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('full', array('class' => 'img-responsive wp-post-image')); ?>      
                        </a>
                        
                        <ul class="event-tabs">
                            <li class="tab-first active"><a href="https://demo.themeum.com/wordpress/vocal/event/orchestra-and-ensembles-concert/"><span class="date">Feb<span>14</span></span></a></li>
                            <li class="tab-second"><a href="https://demo.themeum.com/wordpress/vocal/event/orchestra-and-ensembles-concert/#event-map-layout"><span><i class="fa fa-map-marker"></i></span></a></li>
                            <li class="tab-third"><a href="https://demo.themeum.com/wordpress/vocal/event/orchestra-and-ensembles-concert/#pricing-table"><span><i class="fa fa-shopping-cart"></i></span></a></li>
                        </ul>

                    </div>
                    <div class="media-body">
                        <div class="event-details">
                            <h3 class="media-heading"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                            <ul class="event-content">
                                <li><span class="heading-side">Location: </span><span class="info-side"> Dhanmondi, Dhaka</span></li>
                                <li><span class="heading-side">Date: </span><span class="info-side">February 14, 2020</span></li>
                                <li><span class="heading-side">Time: </span><span class="info-side">10:00 am</span></li>
                                
                            </ul>
                        </div> 
                    </div>
                </div>

            </div>








            

            

        <?php
        endwhile;
        wp_reset_query();
        endif; ?>

        </div>
        </div>


        <?php


        return $html;

    }

}