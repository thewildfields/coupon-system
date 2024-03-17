<?php 

function ___cs_register_coupon_post_type(){

    register_post_type(
        $post_type = 'coupon',
        $args = [
            'label' => 'Coupons',
            'labels' => [
                'add_new' => 'Add New Coupon',
            ],
            'public' => true,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-tickets-alt',
            'has_archive' => false,
            'supports' => [ 'title' , 'thumbnail', 'revisions']
        ]
    );

}

add_action( 'init' , '___cs_register_coupon_post_type' );

add_filter( 'display_post_states', '___cs_register_coupons_page_state', 10, 2 );
function ___cs_register_coupons_page_state( $post_states, $post ){
	if( $post->post_type === 'page' ){
		if( $post->post_name === 'coupons' ){
			$post_states[] = 'Coupons page';
		}
	}
	return $post_states;
}
