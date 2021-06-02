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

// metabox social author
function meta_box_social(){
add_meta_box('thong-tin','Social','meta_output','post');
add_meta_box('job-parnter','Job','job_output','post');
}
add_action('add_meta_boxes','meta_box_social');
function meta_output($post){
  $facebook = get_post_meta($post->ID, '_facebook', true);
  $twitter = get_post_meta($post->ID, '_twitter', true);
  $ggplus = get_post_meta($post->ID, '_ggplus', true);
  $pinterest = get_post_meta($post->ID, '_pinterest', true);
  ?>
  <div class="list_item_social">
    <label for="facebook">Facebook</label>
    <input type="text" id="facebook" name="facebook" value="<?php echo $facebook; ?>"  style="width: 100%;">
  </div>
  <div class="list_item_social">
    <label for="twitter">Twitter</label>
    <input type="text" id="twitter" name="twitter" value="<?php echo $twitter; ?>"  style="width: 100%;">
  </div>
  <div class="list_item_social">
    <label for="ggplus">Google Plus</label>
    <input type="text" id="ggplus" name="ggplus" value="<?php echo $ggplus; ?>"  style="width: 100%;">
  </div>
  <div class="list_item_social">
    <label for="pinterest">Pinterest</label>
    <input type="text" id="pinterest" name="pinterest" value="<?php echo $pinterest; ?>"  style="width: 100%;">
  </div>
  <?php 
}
function job_output($post){
  $job = get_post_meta($post->ID,'_job', true); ?>
  <input type="text" id="job" name="job" value="<?php echo $job; ?>"  style="width: 100%;">
  <?php
}
function meta_box_save($post_id){
 $facebook = isset($_POST['facebook']) ? $_POST['facebook'] : '';
 $twitter = isset($_POST['twitter']) ? $_POST['twitter'] : '';
 $ggplus = isset($_POST['ggplus']) ? $_POST['ggplus'] : '';
 $pinterest = isset($_POST['pinterest']) ? $_POST['pinterest'] : '';
 $job = isset($_POST['job']) ? $_POST['job'] : '';
 update_post_meta( $post_id, '_facebook', $facebook );
 update_post_meta( $post_id, '_twitter', $twitter );
 update_post_meta( $post_id, '_ggplus', $ggplus );
 update_post_meta( $post_id, '_pinterest', $pinterest );
 update_post_meta( $post_id, '_job', $job );
}
add_action('save_post' , 'meta_box_save');

// end metabox social author
?>

