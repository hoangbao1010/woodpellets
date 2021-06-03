<?php 
// shortcode social header info
function myshortcode_header_info()
{
	ob_start();
	if (get_option('phone') || get_option('address_header') || get_option('meta_des'))
	{
		?>
		<ul>
			
			<?php if (get_option('phone'))
			{ ?>
				<li><p><?php echo get_option('phone'); ?></p></li>
				<?php
			} ?>
			<?php if (get_option('address_header'))
			{ ?>
				<li><p><?php echo get_option('address_header'); ?></p></li>
				<?php
			} ?>
			<?php if (get_option('meta_des'))
			{ ?>
				<li><p><?php echo get_option('meta_des'); ?></p></li>
				<?php
			} ?>
		</ul>
		<?php
	}
	return ob_get_clean();
}
add_shortcode('social_header_info', 'myshortcode_header_info');

// shortcode social footer
function myshortcode_header()
{
	ob_start();
	if (get_option('footer_fb') || get_option('footer_twitter') || get_option('footer_ytb') || get_option('footer_instagram'))
	{
		?>
		<ul>
			
			<?php if (get_option('footer_fb'))
			{ ?>
				<li><a href="<?php echo get_option('footer_fb'); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<?php
			} ?>
			<?php if (get_option('footer_twitter'))
			{ ?>
				<li><a href="<?php echo get_option('footer_twitter'); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
				<?php
			} ?>
			<?php if (get_option('footer_ytb'))
			{ ?>
				<li><a href="<?php echo get_option('footer_ytb'); ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
				<?php
			} ?>
			<?php if (get_option('footer_instagram'))
			{ ?>
				<li><a href="<?php echo get_option('footer_instagram'); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				<?php
			} ?>
		</ul>
		<?php
	}
	return ob_get_clean();
}
add_shortcode('social_header', 'myshortcode_header');

// shortcode social single page
function myshortcode_social_single_page()
{
	ob_start(); ?>
	<div class="social_single_page">
		<?php global $post;
		$facebook = get_post_meta($post->ID, '_facebook', true);
		$twitter = get_post_meta($post->ID, '_twitter', true);
		$ggplus = get_post_meta($post->ID, '_ggplus', true);
		$pinterest = get_post_meta($post->ID, '_pinterest', true);
		?>
		<ul>
			<li><a href="<?php echo $facebook ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
			<li><a href="<?php echo $twitter ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			<li><a href="<?php echo $ggplus ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
			<li><a href="<?php echo $pinterest ?>" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
		</ul>
		<?php
		return ob_get_clean(); ?>
	</div>
<?php }
add_shortcode('social_single_page', 'myshortcode_social_single_page');

		// shortcode baivietmoi footer
function myshortcode_baivietmoi_footer(){ 
	ob_start();?>
	<div class="qb_baivietmoi_footer">
		<?php $baivietmoi_arg = array(
			'post_type' => 'post',
			'order' => 'ASC',
			'orderby' => 'date',
			'post_status' => 'publish',
			'posts_per_page' => 5
		);
		$hot_baivietmoi_query = new WP_Query($baivietmoi_arg);
		if($hot_baivietmoi_query->have_posts()) : ?>
			<ul>
				<?php while ($hot_baivietmoi_query->have_posts()) : $hot_baivietmoi_query->the_post(); ?>
					<li>
						<div class="text_widget">
							<a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a>
						</div>
					</li>
				<?php endwhile; 
				wp_reset_postdata();
				?>
			</ul>
			<?php else : echo 'No data'; 
			endif; ?>

		</div>
		<?php 
		return ob_get_clean();
	}
	add_shortcode('sc_baivietmoi_footer','myshortcode_baivietmoi_footer');

				// shortcode baivietmoi homepage
	function myshortcode_baivietmoi_homepage(){ 
		ob_start();?>
		<div class="qb_baivietmoi_homepage">
			<?php $baivietmoi_arg = array(
				'post_type' => 'post',
				'order' => 'ASC',
				'orderby' => 'date',
				'post_status' => 'publish',
				'posts_per_page' => 3
			);
			$hot_baivietmoi_query = new WP_Query($baivietmoi_arg);
			if($hot_baivietmoi_query->have_posts()) : ?>
				<ul class="row">
					<?php while ($hot_baivietmoi_query->have_posts()) : $hot_baivietmoi_query->the_post(); ?>
						<li class="col-sm-4">
							<div class="wrap_figure">
								<?php 
								global $post;
								$nb_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size = 'large'); ?>
								<figure style="background: url('<?php echo $nb_image[0]; ?>');"><a href="<?php the_permalink(); ?>" target="_blank"></a></figure>
							</div>
							<div class="text_widget">
								<strong class="qb_date_post"><b><?php the_time('d/'); ?></b><span><?php the_time('m/Y'); ?></span></strong>
								<h4><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h4>
								<div class="excerpt">
									<p> <?php echo excerpt(30);?></p>
								</div>
								<a href="<?php the_permalink() ?>" target="_blank" class="read_more">Xem thêm <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
							</div>
						</li>
					<?php endwhile; 
					wp_reset_postdata();
					?>
				</ul>
				<?php else : echo 'No data'; 
				endif; ?>

			</div>
			<?php 
			return ob_get_clean();
		}
		add_shortcode('sc_baivietmoi_homepage','myshortcode_baivietmoi_homepage');

						// shortcode phanhoikhachhang homepage
		function myshortcode_phkh_homepage(){ 
			ob_start();?>
			<div class="qb_phkh_homepage">
				<?php $phkh_arg = array(
					'post_type' => 'customers',
					'order' => 'ASC',
					'orderby' => 'date',
					'post_status' => 'publish',
					'posts_per_page' => 3
				);
				$phkh_query = new WP_Query($phkh_arg);
				if($phkh_query->have_posts()) : ?>
					<ul class="row">
						<?php while ($phkh_query->have_posts()) : $phkh_query->the_post(); ?>
							<li class="col-sm-4">
								<div class="phkh_ct">
									<h3><?php the_title(); ?></h3>
									<?php  global $post;
									$address = get_post_meta($post->ID,'_address', true); ?>
									<span class="address"><?php echo $address; ?></span>
									<?php 
									$phkh_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size = 'large'); ?>
									<figure><img src="<?php echo $phkh_image[0] ?>"></figure>
									<div class="customer_ct"><?php the_content(); ?></div>
								</div>
							</li>
						<?php endwhile; 
						wp_reset_postdata();
						?>
					</ul>
					<?php else : echo 'No data'; 
					endif; ?>

				</div>
				<?php 
				return ob_get_clean();
			}
			add_shortcode('sc_phkh_homepage','myshortcode_phkh_homepage');