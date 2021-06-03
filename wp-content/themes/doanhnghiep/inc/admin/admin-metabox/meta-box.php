<?php
      /**
 * Adds a meta box check box
 */
      function prfx_featured_meta() {
        add_meta_box( 'prfx_meta', __( 'Bài viết nổi bật', 'prfx-textdomain' ), 'prfx_meta_callback', 'post', 'normal', 'high' );
      }
      add_action( 'add_meta_boxes', 'prfx_featured_meta' );

/**
 * Outputs the content of the meta box
 */

function prfx_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
  $prfx_stored_meta = get_post_meta( $post->ID );
  ?>

  <p>
  <!--   <span class="prfx-row-title"><?php _e( 'Check if this is a featured post: ', 'prfx-textdomain' )?></span> -->
    <div class="prfx-row-content">
      <label for="featured-checkbox">
        <input type="checkbox" name="featured-checkbox" id="featured-checkbox" value="yes" <?php if ( isset ( $prfx_stored_meta['featured-checkbox'] ) ) checked( $prfx_stored_meta['featured-checkbox'][0], 'yes' ); ?> />
        <?php _e( 'Tích chọn vào đây', 'prfx-textdomain' )?>
      </label>

    </div>
  </p>   

  <?php
}

/**
 * Saves the custom meta input
 */
function prfx_meta_save( $post_id ) {

    // Checks save status - overcome autosave, etc.
  $is_autosave = wp_is_post_autosave( $post_id );
  $is_revision = wp_is_post_revision( $post_id );
  $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
  if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
    return;
  }

// Checks for input and saves - save checked as yes and unchecked at no
  if( isset( $_POST[ 'featured-checkbox' ] ) ) {
    update_post_meta( $post_id, 'featured-checkbox', 'yes' );
  } else {
    update_post_meta( $post_id, 'featured-checkbox', 'no' );
  }

}
add_action( 'save_post', 'prfx_meta_save' );

// end metabox check box

// metabox address customer
function meta_box_address_customer(){
add_meta_box('address-customer','Address','address_output','customers');
}
add_action('add_meta_boxes','meta_box_address_customer');
function address_output($post){
  $address = get_post_meta($post->ID,'_address', true); ?>
  <input type="text" id="address" name="address" value="<?php echo $address; ?>"  style="width: 100%;">
  <?php
}
function meta_box_save($post_id){
 $address = isset($_POST['address']) ? $_POST['address'] : '';
 update_post_meta( $post_id, '_address', $address );
}
add_action('save_post' , 'meta_box_save');

// end metabox address customer
?>

