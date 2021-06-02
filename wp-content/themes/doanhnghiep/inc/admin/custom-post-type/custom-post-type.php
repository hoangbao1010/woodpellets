<?php

/*
	
@package sunsettheme
	
	========================
		THEME CUSTOM POST TYPES
	========================
*/

	/* Slide */
	add_action( 'init', 'sunset_slide_custom_post_type' );
	add_filter('manage_partners_posts_columns','sunset_set_slide_columns');
	add_action('manage_partners_posts_custom_column','sunset_slide_custom_column',10,2);
	function sunset_slide_custom_post_type() {
		$labels = array(
			'name' 				=> 'Slide',
			'singular_name' 	=> 'Slide',
			'menu_name'			=> 'Slide',
			'name_admin_bar'	=> 'Slide'
		);

		$args = array(
			'labels'			=> $labels,
			'show_ui'			=> true,
			'show_in_menu'		=> true,
			'capability_type'	=> 'post',
			'hierarchical'		=> false,
			'menu_position'		=> 26,
			'menu_icon'			=> 'dashicons-slides',
			'supports'			=> array( 'title', 'thumbnail' , 'excerpt' , 'editor' ),
			'public'            => true
		);

		register_post_type( 'slide', $args );

	}

	function sunset_set_slide_columns($columns){
		$newColumns = array();
		$newColums['title'] = 'Title';
		$newColums['avatar'] = 'Avatar';
		return $newColums;
	}

	function sunset_slide_custom_column($column,$post_id){
		switch ($column) {
			case 'avatar':
			echo get_the_post_thumbnail();
			break;
		}
	}
	?>
	<?php
