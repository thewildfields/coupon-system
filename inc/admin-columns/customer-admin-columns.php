<?php

function ___cs_update_customer_admin_columns( $columns ){
    return $columns + [ 'phone' => 'Phone' , 'userID' => 'User ID' , 'secret' => 'Secret' ];
}
add_action( 'manage_customer_posts_columns' , '___cs_update_customer_admin_columns' );



function ___cs_display_customer_meta_in_admin_table( $column_name ){
	if ( $column_name === 'phone' ) {
        echo get_post_meta( get_the_ID() , 'customer_phone' , true );
	}
	if ( $column_name === 'userID' ) {
        echo get_post_meta( get_the_ID() , 'user_contact_id' , true );
	}
	if ( $column_name === 'secret' ) {
        echo get_post_meta( get_the_ID() , 'customer_secret' , true );
	}
}
add_action( 'manage_customer_posts_custom_column' , '___cs_display_customer_meta_in_admin_table' );



function register_sortable_columns( $columns ) {
    $columns['phone'] = 'Phone';
    return $columns;
}
add_filter( 'manage_edit-customer_sortable_columns', 'register_sortable_columns' );

function ___cs_phones_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'phone' === $vars['orderby'] ) {
        $vars = array_merge( $vars,
        array(
            'meta_key' => 'customer_phone'
            )
        );
    }
    return $vars;
}
add_filter( 'request', '___cs_phones_column_orderby' );