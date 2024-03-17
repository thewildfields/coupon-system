<?php 

/**
 * Plugin name: Coupon System
 * AUthor: Oleksii Tsioma
 */

// Registering post type

add_action( 'admin_enqueue_scripts' , '___cs_backend_assets' );

function ___cs_backend_assets(){
    wp_enqueue_script(
        $handle = 'coupon-system-backend',
        $src = plugin_dir_url( __FILE__ ) . 'dist/couponsBackend.js',
        $deps = null,
        $ver = null,
        $in_footer = true
    );
}

add_action( 'init' , '___cs_frontend_assets');

function ___cs_frontend_assets(){
    wp_enqueue_style(
        $handle = 'coupons-system',
        $src = plugin_dir_url( __FILE__ ) . '/dist/bundle.css'
    );
}

require plugin_dir_path( __FILE__ ) . '/inc/cpt/coupon-cpt.php';
require plugin_dir_path( __FILE__ ) . '/inc/cpt/customer-cpt.php';


// require plugin_dir_path( __FILE__ ) . '/inc/meta-boxes/coupon-meta-box.php';
// require plugin_dir_path( __FILE__ ) . '/inc/meta-boxes/customer-meta-box.php';


require plugin_dir_path( __FILE__ ) . '/inc/admin-columns/coupon-admin-columns.php';
require plugin_dir_path( __FILE__ ) . '/inc/admin-columns/customer-admin-columns.php';

register_activation_hook( __FILE__, '___cs_activate_plugin' );

function ___cs_activate_plugin() {

    if( !get_page_by_path( 'customers' ) ){

        wp_insert_post(
            wp_slash([
                'post_type' => 'page',
                'post_title' => 'Customers',
                'post_content' => '<!-- wp:pattern { "slug":"coupon-system/customers-pattern" } /-->',
                'post_name' => 'customers',
                'post_author' => get_current_user_id()
            ])
        );

    }

    if( !get_page_by_path( 'coupons' ) ){

        wp_insert_post(
            wp_slash([
                'post_type' => 'page',
                'post_title' => 'Coupons',
                'post_content' => '',
                'post_name' => 'coupons',
                'post_author' => get_current_user_id()
            ])
        );

    }

}

require_once dirname( __FILE__ ) . '/inc/patterns/pattern-customers.php';


add_action( 'init' , '___cs_check_for_customer_registration' );

function ___cs_check_for_customer_registration(){

    global $wpdb;

    global $currentCustomerId, $currentCustomerSecret;
    
    $currentCustomerId = null;

    if( isset( $_GET['attr'] ) ){
        $attrs = explode( '|' , $_GET['attr'] );

        $userID = $attrs[0];
        $phone = $attrs[1];
        $name = $attrs[2];
    }
    
    if( !empty( $phone ) ){
        
        $customers = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE post_type='customer' AND post_status='publish'");

        $customerWithPhoneExists = false;

        foreach ($customers as $customer) {
            if( get_field( 'customer_phone' , $customer->ID) == $phone ){
                $currentCustomerId = $customer->ID;
                $customerWithPhoneExists = true;

                $currentCustomerSecret = get_field( 'customer_secret' , $currentCustomerId );
                break;
            }
        }

        if( !$customerWithPhoneExists ){

            $bytes = random_bytes(16);

            $newCustomer = wp_insert_post(
                wp_slash([
                    'post_title' => $name,
                    'post_type' => 'customer',
                    'post_author' => 1,
                    'post_status' => 'publish',
                    'meta_input' => [
                        'customer_phone' => intval( $phone ),
                        'customer_secret' => bin2hex($bytes),
                        'user_contact_id' => $userID,
                    ]
                ])
            );

            $currentCustomerSecret = get_field( 'customer_secret' , $newCustomer );

        }

    }

    if( get_the_ID() !== get_the_ID( get_page_by_path('coupon-use') ) ){
        print_r( 'Customer ID: ' . $currentCustomerId );
        echo '<br>';
        print_r( 'Customer Secret: ' . $currentCustomerSecret );
    }

    
}

add_action( 'rest_api_init', function(){

	register_rest_route( 'coupon-system/v1/' , 'customers', array(
		'methods'  => 'GET',
		'callback' => '___cs_create_customer',
        'permission_callback' => '__return_true'
	) );

} );

function ___cs_create_customer( WP_REST_Request $request ){

    $params = $request->get_json_params();
    
    $userID = $params['user_id'];
    $phone = $params['phone'];
    $username = trim( $params['username'] );

    if( $userID && $phone && $username ){
    
        $returnObj = [];
        $returnObj['attr'] = urlencode( $userID . '|' . $phone . '|' . $username );

        nocache_headers();

        $response = new WP_REST_Response( $returnObj );

        $response->set_status( 200 );

        return $response;

    } else {

        return WP_Error();

    }

}