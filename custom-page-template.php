<?php 

/**
 * Template name: Customers page
 */

$customersQueryArgs = array(
    'post_type' => 'customers'
);

$customersQuery = new WP_Query( $customersQueryArgs );

if( $customersQuery->have_posts() ) : while( $customersQuery->have_posts() ) : $customersQuery->the_post();

    the_title();

endwhile; wp_reset_postdata(); endif;