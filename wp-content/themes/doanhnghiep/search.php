<?php 
get_header(); 
?>	
<div id="content">
	<div class="qb_content">
		<div class="container">
			<div class="search_page">
				<div class="row">
					<div class="col-sm-8">
						<div class="ct_left">
							<h1 class="title_search"><strong>Tìm kiếm: <?php the_search_query(); ?></strong></h1>
							<?php 
							$search_resuilt_arg = array(
								'post_type' => 'post',
								'orderby' => 'date',
								'order' => 'DESC'
							);
							$search_resuilt_query = new WP_Query($search_resuilt_arg);
							if($search_resuilt_query->have_posts()) : ?>
								<ul class="list_search_resuilt_general">
									<?php while($search_resuilt_query->have_posts()) : $search_resuilt_query->the_post(); ?>
										<li class="list_search_resuilt_detaild">
											<?php $search_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
											<div class="wrap_figure">
												<figure style="background:url('<?php echo $search_image[0]; ?>')"><a href="<?php the_permalink(); ?>"></a></figure>
											</div>
											<div class="info_post">
												<h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
												<span class="time_post"><a href="<?php the_permalink(); ?>" target="_blank"><?php the_time('d/m/Y H:i'); ?></a> </span>
													<div class="excerpt">
														<?php echo excerpt(100); ?>  
													</div>
												</div> 
											</li>
										<?php endwhile;
										get_template_part('inc/frontend/pagination/pagination');
										wp_reset_postdata(); ?>
									</ul>
									<?php else : echo 'No data';
									endif; ?>
								</div>
							</div>
							<div class="col-sm-4">
								<?php if(is_active_sidebar('sidebar_search')) : ?>
									<div class="qb_sidebar_right_search">
										<?php dynamic_sidebar('sidebar_search'); ?>
									</div>
									<?php else : echo 'No data';
									endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php get_footer(); ?>
