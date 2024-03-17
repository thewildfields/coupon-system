<?php 

$couponsQueryArgs = array(
    'post_type' => 'coupon',
    'posts_per_page' => -1
);

$couponsQuery = new WP_Query( $couponsQueryArgs );

if( $couponsQuery->have_posts( ) ) : while( $couponsQuery->have_posts( ) ) : $couponsQuery->the_post();

the_title();

endwhile; wp_reset_postdata(  ); endif; 
