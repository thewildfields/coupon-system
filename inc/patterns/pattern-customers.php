<?php 

add_action( 'init' , '___cs_register_customers_pattern' );

function ___cs_register_customers_pattern(){
    register_block_pattern(
        $pattern_name = 'coupon-system/customers',
        $pattern_properties = array(
            'title' => 'List of Customers',
            'categories' => ['featured'],
            'content' => '<!-- wp:query {"queryId":15,"query":{"perPage":10,"pages":0,"offset":0,"postType":"customer","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[]},"align":"wide"} -->
            <div class="wp-block-query alignwide"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
            <!-- wp:post-title {"level":3} /-->
            
            <!-- wp:mfb/meta-field-block {"fieldName":"cs-customer-phone","fieldSettings":{},"hideEmpty":true} /-->
            <!-- /wp:post-template --></div>
            <!-- /wp:query -->'
            
        )
    );
}
