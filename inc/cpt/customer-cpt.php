<?php

function ___cs_register_customer_post_type(){

    register_post_type(
        $post_type = 'customer',
        $args = [
            'label' => 'Customers',
            'labels' => [
                'add_new' => 'Add New Customer',
            ],
            'public' => true,
            'show_in_rest' => true,
            'show_in_menu' => 'edit.php?post_type=coupon',
            'has_archive' => false
        ]
    );

}

register_meta(
    $object_type = 'customer',
    $meta_key = 'customer-phone',
    $args = [
        'object_subtype'    => '',
        'type'              => 'string',
        'single'            => true,
        'sanitize_callback' => null,
        'auth_callback'     => null,
        'show_in_rest'      => true,
    ]
);

add_action( 'init' , '___cs_register_customer_post_type' );

add_filter( 'display_post_states', '___cs_register_customers_page_state', 10, 2 );
function ___cs_register_customers_page_state( $post_states, $post ){
	if( $post->post_type === 'page' ){
		if( $post->post_name === 'customers' ){
			$post_states[] = 'Customers page';
		}
	}
	return $post_states;
}
