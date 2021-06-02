<?php
add_action('admin_menu', 'ch_essentials_admin');
function ch_essentials_admin() {
	 register_setting('zang-settings-header', 'phone');
	 register_setting('zang-settings-header', 'address_header');
	 register_setting('zang-settings-header', 'meta_des');
	// register_setting('zang-settings-header', 'meta_key');

	register_setting('zang-settings-socials', 'footer_fb');
	register_setting('zang-settings-socials', 'footer_twitter');
	// register_setting('zang-settings-socials', 'footer_pinterest');
	// register_setting('zang-settings-socials', 'footer_linkedin');
	 register_setting('zang-settings-socials', 'footer_ytb');
	// register_setting('zang-settings-socials', 'footer_google');
	// register_setting('zang-settings-socials', 'footer_yahoo');
	// register_setting('zang-settings-socials', 'footer_dribbble');
	 register_setting('zang-settings-socials', 'footer_instagram');
	/* Base Menu */
	add_menu_page('Zang Theme Option','Woodpellets Framework','manage_options','template_admin_zang','zang_theme_create_page',get_template_directory_uri() . '/images/bitcoin.png',110);
}
add_action('admin_init', 'zang_custom_settings');
function zang_custom_settings() { 

	/* Header Options Section */
	 add_settings_section('zang-header-options', 'Chỉnh sửa header','zang_header_options_callback','zang-settings-header' );
	 add_settings_field('address-hd','Số điện thoại', 'zang_phone_header','zang-settings-header', 'zang-header-options');
	 add_settings_field('phone-hd','Địa chỉ', 'zang_address_header','zang-settings-header', 'zang-header-options');
	// add_settings_field('meta-des','Meta Description', 'zang_meta_des','zang-settings-header', 'zang-header-options');
	// add_settings_field('meta-key','Meta Keyword', 'zang_meta_key','zang-settings-header', 'zang-header-options');

	/* Social Options Section */
	add_settings_section('zang-social-options','Chỉnh sửa social','zang_social_options_callback','zang-settings-socials' );
	add_settings_field('facebook','Facebook Link', 'zang_footer_fb','zang-settings-socials', 'zang-social-options');
	add_settings_field('twitter','Twitter Link', 'zang_footer_twitter','zang-settings-socials', 'zang-social-options');
	// add_settings_field('pinterest','Pinterest Link', 'zang_footer_pinterest','zang-settings-socials', 'zang-social-options');
	// add_settings_field('linkedin','Linkedin Link', 'zang_footer_linkedin','zang-settings-socials', 'zang-social-options');
    add_settings_field('ytb','Youtube Link', 'zang_footer_ytb','zang-settings-socials', 'zang-social-options');
	// add_settings_field('google','Google Link', 'zang_footer_google','zang-settings-socials', 'zang-social-options');
	// add_settings_field('yahoo','Yahoo Link', 'zang_footer_yahoo','zang-settings-socials', 'zang-social-options');
	// add_settings_field('dribbble','Dribbble Link', 'zang_footer_dribbble','zang-settings-socials', 'zang-social-options');
	add_settings_field('instagram','Instagram Link', 'zang_footer_instagram','zang-settings-socials', 'zang-social-options');


}

 function zang_header_options_callback(){
 	echo '';
 }

function zang_social_options_callback(){
	echo '';
}

 function zang_phone_header(){
 	$phone = esc_attr(get_option('phone'));
 	echo '<input type="text" class="iptext_adm" name="phone" value="'.$phone.'" >';
 }
 function zang_address_header(){
 	$address_header = esc_attr(get_option('address_header'));
 	echo '<input type="text" class="iptext_adm" name="address_header" value="'.$address_header.'" placeholder="" ';
 }
// function zang_meta_des(){
// 	$meta_des = esc_attr(get_option('meta_des'));
// 	echo '<textarea  class="iptext_adm" name="meta_des" value="'.$meta_des.'" > '.$meta_des.' </textarea> ';
// }
// function zang_meta_key(){
// 	$meta_key = esc_attr(get_option('meta_key'));
// 	echo '<textarea  class="iptext_adm" name="meta_key" value="'.$meta_key.'" >'.$meta_key.'</textarea> ';
// }
function zang_footer_fb(){
	$footer_fb = esc_attr(get_option('footer_fb'));
	echo '<input type="text" class="iptext_adm" name="footer_fb" value="'.$footer_fb.'" placeholder="" ';
}
function zang_footer_twitter(){
	$footer_twitter = esc_attr(get_option('footer_twitter'));
	echo '<input type="text" class="iptext_adm" name="footer_twitter" value="'.$footer_twitter.'" placeholder="" ';
}
// function zang_footer_pinterest(){
// 	$footer_pinterest = esc_attr(get_option('footer_pinterest'));
// 	echo '<input type="text" class="iptext_adm" name="footer_pinterest" value="'.$footer_pinterest.'" placeholder="" ';
// }

// function zang_footer_linkedin(){
// 	$footer_linkedin = esc_attr(get_option('footer_linkedin'));
// 	echo '<input type="text" class="iptext_adm" name="footer_linkedin" value="'.$footer_linkedin.'" placeholder="" ';
// }

 function zang_footer_ytb(){
 	$footer_ytb = esc_attr(get_option('footer_ytb'));
 	echo '<input type="text" class="iptext_adm" name="footer_ytb" value="'.$footer_ytb.'" placeholder="" ';
 }

// function zang_footer_google(){
// 	$footer_google = esc_attr(get_option('footer_google'));
// 	echo '<input type="text" class="iptext_adm" name="footer_google" value="'.$footer_google.'" placeholder="" ';
// }

// function zang_footer_yahoo(){
// 	$footer_yahoo = esc_attr(get_option('footer_yahoo'));
// 	echo '<input type="text" class="iptext_adm" name="footer_yahoo" value="'.$footer_yahoo.'" placeholder="" ';
// }

// function zang_footer_dribbble(){
// 	$footer_dribbble = esc_attr(get_option('footer_dribbble'));
// 	echo '<input type="text" class="iptext_adm" name="footer_dribbble" value="'.$footer_dribbble.'" placeholder="" ';
// }

 function zang_footer_instagram(){
 	$footer_instagram = esc_attr(get_option('footer_instagram'));
 	echo '<input type="text" class="iptext_adm" name="footer_instagram" value="'.$footer_instagram.'" placeholder="" ';
 }
/* Display Page
-----------------------------------------------------------------*/
function zang_theme_create_page() {
	?>
	<div class="wrap">  
		<?php settings_errors(); ?>  

		<?php  
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'header_page_options';  
		?>  

		<ul class="nav-tab-wrapper"> 
			<li><a href="?page=template_admin_zang&tab=header_page_options" class="nav-tab <?php echo $active_tab == 'header_page_options' ? 'nav-tab-active' : ''; ?>">Header</a> </li> 
			<li><a href="?page=template_admin_zang&tab=social_page_options" class="nav-tab <?php echo $active_tab == 'social_page_options' ? 'nav-tab-active' : ''; ?>">Social Header</a></li>	
		</ul>  

		<form method="post" action="options.php">  
			<?php 
			if( $active_tab == 'header_page_options' ) {  
				// settings_fields( 'zang-settings-header' );
				// do_settings_sections( 'zang-settings-header' ); 
			} else if( $active_tab == 'social_page_options' ) {
				settings_fields( 'zang-settings-socials' );
				do_settings_sections( 'zang-settings-socials' ); 
			}
			?>             
			<?php submit_button(); ?>  
		</form> 

	</div> 

	<?php
}

