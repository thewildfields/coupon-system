<?php 

function ___cs_add_coupon_meta_box(){

    add_meta_box(
        $id = 'coupon-meta',
        $title = 'Coupon Settings',
        $callback = '___cs_coupon_meta_box',
        $screen = 'coupon'
    );

}
function ___cs_coupon_meta_box( $post ){

    $couponImage = get_post_meta( $post->ID , 'cs-coupon-image' , true );
    $couponReleaseDate = get_post_meta( $post->ID , 'cs-coupon-release-date' , true );
    $couponExpiryDate = get_post_meta( $post->ID , 'cs-coupon-expiry-date' , true );
    $couponReleaseLimitation = get_post_meta( $post->ID , 'cs-coupon-release-limitation' , true );
    // $couponStatus = get_post_meta( $post->ID , 'cs-coupon-image' , true );
    $couponPasscode = get_post_meta( $post->ID , 'cs-coupon-passcode' , true );
    
    
    ?>
<div class="couponsMeta">
    <div class="couponsMeta__group">
        <?php echo $couponImage; ?>
        <label class="couponsMeta__label" for="cs-coupon-image">Coupon Image</label>
        <input class="couponsMeta__field" type="file" name="cs-coupon-image" id="cs-coupon-image" required>
    </div>
    <div class="couponsMeta__group">
        <label class="couponsMeta__label" for="cs-coupon-release-date">Release Date</label>
        <input class="couponsMeta__field" type="date" min="2024-01-01" name="cs-coupon-release-date" id="cs-coupon-release-date" value="<?php echo $couponReleaseDate; ?>" required>
    </div>
    <div class="couponsMeta__group">
        <label class="couponsMeta__label" for="cs-coupon-expiry-date">Expiry Date</label>
        <input class="couponsMeta__field" type="date" min="2024-01-01" name="cs-coupon-expiry-date" id="cs-coupon-expiry-date" value="<?php echo $couponExpiryDate; ?>">
    </div>
    <div class="couponsMeta__group">
        <label class="couponsMeta__label" for="cs-coupon-release-limitation">Release Limitation</label>
        <input class="couponsMeta__field" type="number" min="1" name="cs-coupon-release-limitation" id="cs-coupon-release-limitation" value="<?php echo $couponReleaseLimitation; ?>">
    </div>
    <div class="couponsMeta__group">
        <label class="couponsMeta__label" for="cs-coupon-status">Status</label>
        <input type="radio" name="cs-coupon-status" id="cs-coupon-status" value="Active" checked>
        <input type="radio" name="cs-coupon-status" id="cs-coupon-status" value="Suspended">
        <input type="radio" name="cs-coupon-status" id="cs-coupon-status" value="Inactive">
    </div>
    <div class="couponsMeta__group">
        <label class="couponsMeta__label" for="cs-coupon-passcode">Passcode</label>
        <input class="couponsMeta__field" type="text" name="cs-coupon-passcode" id="cs-coupon-passcode" value="<?php echo $couponPasscode; ?>">
    </div>
</div>
<?php }
add_action( 'add_meta_boxes', '___cs_add_coupon_meta_box' );



function ___cs_save_coupon_data( $post_id ) {

	if ( array_key_exists( 'cs-coupon-release-date', $_POST ) ) {
		update_post_meta(
			$post_id,
			'cs-coupon-release-date',
			$_POST['cs-coupon-release-date']
		);
	}
	if ( array_key_exists( 'cs-coupon-expiry-date', $_POST ) ) {
		update_post_meta(
			$post_id,
			'cs-coupon-expiry-date',
			$_POST['cs-coupon-expiry-date']
		);
	}
	if ( array_key_exists( 'cs-coupon-release-limitation', $_POST ) ) {
		update_post_meta(
			$post_id,
			'cs-coupon-release-limitation',
			$_POST['cs-coupon-release-limitation']
		);
	}
	if ( array_key_exists( 'cs-coupon-passcode', $_POST ) ) {
		update_post_meta(
			$post_id,
			'cs-coupon-passcode',
			$_POST['cs-coupon-passcode']
		);
	}
}
add_action( 'save_post', '___cs_save_coupon_data' );
