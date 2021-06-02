<?php 
// shortcode social footer
function myshortcode_footer()
{
	ob_start();
	if (get_option('footer_fb') || get_option('footer_google') || get_option('footer_twitter') || get_option('footer_pinterest'))
	{
		?>
		<ul>
			
			<?php if (get_option('footer_fb'))
			{ ?>
				<li><a href="<?php echo get_option('footer_fb'); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<?php
			} ?>
			<?php if (get_option('footer_google'))
			{ ?>
				<li><a href="<?php echo get_option('footer_google'); ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
				<?php
			} ?>
			<?php if (get_option('footer_pinterest'))
			{ ?>
				<li><a href="<?php echo get_option('footer_pinterest'); ?>" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
				<?php
			} ?>
			<?php if (get_option('footer_twitter'))
			{ ?>
				<li><a href="<?php echo get_option('footer_twitter'); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
				<?php
			} ?>
		</ul>
		<?php
	}
	return ob_get_clean();
}
add_shortcode('social_footer', 'myshortcode_footer');

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