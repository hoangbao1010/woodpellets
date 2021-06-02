<?php get_header(); ?>

<div id="content">
	<div class="qb_content">
		<?php 
		if(is_cart() || is_checkout()){
			?>
			
					<div id="breadcrumb">
						<?php echo the_breadcrumb(); ?>
					</div>
					<div class="container">
						<?php if(have_posts()) : ?>
							<?php 
							while(have_posts()): the_post();
								the_content();
							endwhile;
							wp_reset_postdata();	
							?>
							<?php else: echo 'No data'; endif; ?>
					</div>
				<?php } else {?>
					<div id="breadcrumb">
				<?php echo the_breadcrumb(); ?>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="qb_ct_left">
							<?php if(have_posts()) : ?>
								<?php 
								while(have_posts()): the_post();
									the_content();
								endwhile;
								wp_reset_postdata();	
								?>
								<?php else: echo 'No data'; endif; ?>
							</div>
						</div>
						<div class="col-sm-4">
							<?php if(is_active_sidebar('sidebar')) : ?>
								<div class="qb_sidebar_right">
									<?php dynamic_sidebar('sidebar'); ?>
								</div>
								<?php else : echo 'No data';
								endif; ?>
							</div>
						</div>
					</div>
					
					<?php }?>
				</div>
			</div>
			<?php get_footer(); ?>