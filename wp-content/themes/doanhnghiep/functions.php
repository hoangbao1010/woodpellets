<?php 
include  'inc/admin/custom-post-type/custom-post-type.php';
include  'inc/frontend/shortcode/shortcode.php';
include  'inc/admin/admin-framework/admin-framework.php';
include  'inc/admin/admin-metabox/meta-box.php';
// PRIOTITY SINGLE-PRODUCT THAN SINGLE.PHP
function priority_single_pd() {
  add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'priority_single_pd' );
// Keep old Editor
add_filter('use_block_editor_for_post', '__return_false');
// ADD THEME CUSTOM LOGO
add_theme_support( 'custom-logo' );
// Define link 
define('BASE_URL',get_template_directory_uri());
add_theme_support( 'post-thumbnails' );
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
// Register menu
register_nav_menus(
  array(
    'primary-menu' => __( 'Primary Menu' ),
    'mobile-menu' => __( 'Mobile Menu' )
  )
);
// REMOVE CSS WP_HEAD
//xoa header
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action( 'wp_head', 'feed_links', 2 ); 
remove_action('wp_head', 'feed_links_extra', 3 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
// Admin admin.css for wp-admin 
function load_admin_style() {
  wp_register_style( 'admin_css', get_template_directory_uri() . '/css/admin.css', false, '1.0.0' );
  wp_enqueue_style('admin_css');
}
add_action( 'admin_enqueue_scripts', 'load_admin_style' );
/*
 *  DUPLICATE POST IN  ADMIN. Dups appear as drafts. User is redirected to the edit screen
 */
function rd_duplicate_post_as_draft(){
  global $wpdb;
  if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
    wp_die('No post to duplicate has been supplied!');
  }
  /*
   * Nonce verification
   */
  if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
    return;
  /*
   * get the original post id
   */
  $post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
  /*
   * and all the original post data then
   */
  $post = get_post( $post_id );
  /*
   * if you don't want current user to be the new post author,
   * then change next couple of lines to this: $new_post_author = $post->post_author;
   */
  $current_user = wp_get_current_user();
  $new_post_author = $current_user->ID;
  /*
   * if post data exists, create the post duplicate
   */
  if (isset( $post ) && $post != null) {
    /*
     * new post data array
     */
    $args = array(
      'comment_status' => $post->comment_status,
      'ping_status'    => $post->ping_status,
      'post_author'    => $new_post_author,
      'post_content'   => $post->post_content,
      'post_excerpt'   => $post->post_excerpt,
      'post_name'      => $post->post_name,
      'post_parent'    => $post->post_parent,
      'post_password'  => $post->post_password,
      'post_status'    => 'draft',
      'post_title'     => $post->post_title,
      'post_type'      => $post->post_type,
      'to_ping'        => $post->to_ping,
      'menu_order'     => $post->menu_order
    );
    /*
     * insert the post by wp_insert_post() function
     */
    $new_post_id = wp_insert_post( $args );
    /*
     * get all current post terms ad set them to the new post draft
     */
    $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
    foreach ($taxonomies as $taxonomy) {
      $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
      wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
    }
    /*
     * duplicate all post meta just in two SQL queries
     */
    $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
    if (count($post_meta_infos)!=0) {
      $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
      foreach ($post_meta_infos as $meta_info) {
        $meta_key = $meta_info->meta_key;
        if( $meta_key == '_wp_old_slug' ) continue;
        $meta_value = addslashes($meta_info->meta_value);
        $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
      }
      $sql_query.= implode(" UNION ALL ", $sql_query_sel);
      $wpdb->query($sql_query);
    }
    /*
     * finally, redirect to the edit post screen for the new draft
     */
    wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
    exit;
  } else {
    wp_die('Post creation failed, could not find original post: ' . $post_id);
  }
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
  if (current_user_can('edit_posts')) {
    $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Nhân bản</a>';
  }
  return $actions;
}
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );
// duplicate page
//add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);
/* WRAP IMAGE POST CONTENT WITH FIGURE*/
function filter_images($content){
  return preg_replace('/<img (.*) \/>\s*/iU', '<figure><img \1 /></figure>', $content);
}
add_filter('the_content', 'filter_images');
/* END WRAP IMAGE POST CONTENT WITH FIGURE*/
//REGISTER WIDGET
function wpb_widgets_init() {

  register_sidebar( array(
    'name' => 'Sidebar right home page' ,
    'id' => 'sidebar_homepage',
    'description' => 'The main sidebar appears on the right on each page except the front page template',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  register_sidebar( array(
    'name' => 'Sidebar right single' ,
    'id' => 'sidebar_single',
    'description' => 'The main sidebar appears on the right on each page except the front page template',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

    register_sidebar( array(
    'name' => 'Sidebar right search' ,
    'id' => 'sidebar_search',
    'description' => 'The main sidebar appears on the right on each page except the front page template',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
}

add_action( 'widgets_init', 'wpb_widgets_init' );
//  ADD BREADCRUMB
function the_breadcrumb() {
  ob_start();
  ?>
  <ul>
    <?php 
    if (!is_front_page()) {
      echo '<li><a href="';
      echo home_url();
      echo '">';
      echo 'Trang chủ ';
      echo "</a><li>";
      if (is_category() || is_single()) {
        echo '';
        the_category(' ');
        if (is_single()) {
          echo "<li>";
          the_title();
          echo '</li>';
        }
      } elseif (is_page()) {
        echo '';
        echo the_title();
        echo '';
      } elseif (is_home()) {
        echo wp_title('');
      }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"Archive for "; the_time('F jS, Y'); echo'';}
    elseif (is_month()) {echo"Archive for "; the_time('F, Y'); echo'';}
    elseif (is_year()) {echo"Archive for "; the_time('Y'); echo'';}
    elseif (is_author()) {echo"Author Archive"; echo'';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "Blog Archives"; echo'';}
    elseif (is_search()) {echo"Search Results"; echo'';} ?>
  </ul>
  <?php
  return ob_get_clean();
}
add_shortcode('sc_breadcrumb', 'the_breadcrumb' );
//  END BREADCRUMB

// BREADCRUMB WOOMMERCE
/**
 * Change the breadcrumb separator
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'change_breadcrumb_woocommerce' );
function change_breadcrumb_woocommerce( $defaults ) {
  // Change the breadcrumb delimeter from '/' to '>'
 return array(
  'delimiter'   => ' / ',
  'wrap_before' => '<div class="breadcrumb no_after"><ul>',
  'wrap_after'  => '</ul> </div>',
  'before'      => '<li>',
  'after'       => '</li>',
  'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
);
}
// END BREADCRUMB WOOCOMERCE
/* WOOCOMERCE MINICART*/
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
 global $woocommerce;
 ob_start();
 ?>
 <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php echo 'Xem giỏ hàng' ?>">
  <?php 
  echo '<i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="amount_pdc">';
  echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> 
  <?php echo '</span>'; ?>
</a>
<?php
$fragments['a.cart-contents'] = ob_get_clean();
return $fragments;
}
//custom woocommerce_before_shop_loop_item_title in archive
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
function woocommerce_template_loop_product_thumbnail(){
  global $product;
  ?>
  <figure>
    <?php echo get_the_post_thumbnail( $product->get_ID() );  ?>
    <div class="qb_cart">
      <?php woocommerce_template_loop_add_to_cart($product ); ?>
      <a href="<?php the_permalink();?>" class="see_cc"><i class="fa fa-eye" aria-hidden="true"></i></a>
    </div>
  </figure>
  <?php 
}


/*  Custom Field for Categories.
======================================== */

// Add new term page
function my_taxonomy_add_meta_fields( $taxonomy ) { ?>
  <div class="form-field term-group">
    <label for="show_category">
      <?php _e( 'Show Three Cols', 'codilight-lite' ); ?> <input type="checkbox" id="show_category_three_col" name="show_category_three_col" value="yes" />
    </label>
    <label for="show_category">
      <?php _e( 'Show Two Cols', 'codilight-lite' ); ?> <input type="checkbox" id="show_category_two_col" name="show_category_two_col" value="yes" />
    </label>
    </div><?php
  }
//add_action( 'category_add_form_fields', 'my_taxonomy_add_meta_fields', 10, 1 );

// Edit term page
  function my_taxonomy_edit_meta_fields( $term, $taxonomy ) {
    $show_category_three_col = get_term_meta( $term->term_id, 'show_category_three_col', true ); ?>

    <tr class="form-field term-group-wrap">
      <th scope="row">
        <label for="show_category_three_col"><?php _e( 'Show Three Cols', 'codilight-lite' ); ?></label>
      </th>
      <td>
        <input type="checkbox" id="show_category_three_col" name="show_category_three_col" value="yes" <?php echo ( $show_category_three_col ) ? checked( $show_category_three_col, 'yes' ) : ''; ?>/>
      </td>
      </tr><?php

      $show_category_two_col = get_term_meta( $term->term_id, 'show_category_two_col', true ); ?>

      <tr class="form-field term-group-wrap">
        <th scope="row">
          <label for="show_category_two_col"><?php _e( 'Show Two Cols', 'codilight-lite' ); ?></label>
        </th>
        <td>
          <input type="checkbox" id="show_category_two_col" name="show_category_two_col" value="yes" <?php echo ( $show_category_two_col ) ? checked( $show_category_two_col, 'yes' ) : ''; ?>/>
        </td>
        </tr><?php
      }
      add_action( 'category_edit_form_fields', 'my_taxonomy_edit_meta_fields', 10, 2 );

// Save custom meta
      function my_taxonomy_save_taxonomy_meta( $term_id, $tag_id ) {
        if ( isset( $_POST[ 'show_category_three_col' ] ) ) {
          update_term_meta( $term_id, 'show_category_three_col', 'yes' );
        } else {
          update_term_meta( $term_id, 'show_category_three_col', '' );
        }

        if ( isset( $_POST[ 'show_category_two_col' ] ) ) {
          update_term_meta( $term_id, 'show_category_two_col', 'yes' );
        } else {
          update_term_meta( $term_id, 'show_category_two_col', '' );
        }
      }
      add_action( 'created_category', 'my_taxonomy_save_taxonomy_meta', 10, 2 );
      add_action( 'edited_category', 'my_taxonomy_save_taxonomy_meta', 10, 2 );


function wp_corenavi_table($custom_query = null) {
      global $wp_query;
      if($custom_query) $main_query = $custom_query;
      else $main_query = $wp_query;
      $big = 999999999;
      $total = isset($main_query->max_num_pages)?$main_query->max_num_pages:'';
      if($total > 1) echo '<div class="paginate_links">';
      echo paginate_links( array(
         'base'        => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
         'format'   => '?paged=%#%',
         'current'  => max( 1, get_query_var('paged') ),
         'total'    => $total,
         'mid_size' => '10',
         'prev_text'    => __('Trước','devvn'),
         'next_text'    => __('Tiếp','devvn'),
      ) );
      if($total > 1) echo '</div>';
}

// set post view
function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// get post view
function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
