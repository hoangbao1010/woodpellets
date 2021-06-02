<?php 
get_header();
?>
<div id="content">
	<div class="qb_content">
		<div class="container">
			<div class="qb_single_page">
				<div class="row">
					<div class="col-sm-8">
						<div class="breadcrumb">
							<?php echo the_breadcrumb(); ?>
						</div>
						<?php $post_id = get_the_ID(); 
						$category_object = get_the_category($post_id);
						$category_name = $category_object[0]->name;?>
						<h1 class="name_cat"><a href="<?php echo get_category_link($category_object[0]->term_id); ?>"><?php echo $category_name; ?></a></h1>

						<?php if(have_posts()) : 
							while(have_posts()) : the_post(); ?>
								<div class="single_ct">
									<h2><?php the_title(); ?></h2>
									<div class="other_info">
										<div class="ct_left">
											<p class="author_date">Bởi <strong class="qb_author"><a href=" <?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author(); ?></a></strong><span class="qb_date_post"> - <?php the_time('j F, Y'); ?></span></p>
										</div>
										<div class="ct_right">
											<div class="view_post">
												<?php  wpb_set_post_views(get_the_ID());                           
												if ( get_post_meta( get_the_ID() , 'wpb_post_views_count', true) == '') { ?>
													<span><i class="fa fa-eye" aria-hidden="true"></i><?php echo '0' ; ?></span>                            
												<?php } else { ?> 
													<span><i class="fa fa-eye" aria-hidden="true"></i><?php echo get_post_meta( get_the_ID() , 'wpb_post_views_count', true); }; ?> </span> 
												</div>
												<div class="comment_number">
													<span><i class="fa fa-comments" aria-hidden="true"></i><?php echo get_comments_number(); ?></span>
												</div>
											</div>
										</div>
										<?php echo do_shortcode('[social_single_page]'); ?>
									</div>
									<figure><?php the_post_thumbnail(); ?></figure>
									<div class="ct_text">
										<?php the_content(); ?>
									</div>
								<?php endwhile;
								wp_reset_postdata();
								else : echo 'No data'; endif;
								?>
								<div class="related_post">
									<div class="list_title">
										<ul>
											<li data-tab="tab-1" class="current">Bài viết liên quan</li>
											<li data-tab="tab-2">Xem thêm</li>
										</ul>
									</div>
									<div class="list_by_category">
										<div id="tab-1" class="list_post tab-content current">
											<?php $related = new WP_Query(
												array(
													'category__in'   => wp_get_post_categories( $post->ID ),
													'posts_per_page' => 3,
													'post__not_in'   => array( $post->ID ),
													'orderby' => 'date',
													'order' => 'DESC',
													'post_status' => 'publish',
												)
											); ?>
											<ul class="row">
												<?php if( $related->have_posts() ) { 
													while( $related->have_posts() ) { 
														$related->the_post(); ?>
														<li class="col-sm-4">
															<div class="wrap_figure">
																<?php 
																global $post;
																$nb_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size = 'large'); ?>
																<figure style="background: url('<?php echo $nb_image[0]; ?>');"><a href="<?php the_permalink(); ?>" target="_blank"></a></figure>
															</div>
															<div class="text_widget">
																<h4><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h4>
															</div>
														</li>
													<?php	}
													wp_reset_postdata();
												} ?>
											</ul>
										</div>
										<div id="tab-2" class="list_post tab-content">
											<?php $post_more = new WP_Query(
												array(
													'post_type'   => 'post',
													'posts_per_page' => 3,
													'post__not_in'   => array( $post->ID ),
													'orderby' => 'date',
													'order' => 'DESC',
													'post_status' => 'publish',
													'offset' => 5
												)
											); ?>
											<ul class="row">
												<?php if( $post_more->have_posts() ) { 
													while( $post_more->have_posts() ) { 
														$post_more->the_post(); ?>
														<li class="col-sm-4">
															<div class="wrap_figure">
																<?php 
																global $post;
																$nb_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size = 'large'); ?>
																<figure style="background: url('<?php echo $nb_image[0]; ?>');"><a href="<?php the_permalink(); ?>" target="_blank"></a></figure>
															</div>
															<div class="text_widget">
																<h4><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h4>
															</div>
														</li>
													<?php	}
													wp_reset_postdata();
												} ?>
											</ul>
										</div>
									</div>
								</div>
								<div class="comment_area" id="comment_area">
									<?php 
									$cmt_arg = array(
										'must_log_in' => 'must be logged in to comment',
										'comment_notes_before' => '',
										'title_reply' => 'Để lại bình luận của bạn!'
									);
									?>
									<?php
									if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
										wp_enqueue_script( 'comment-reply' );
									}
									?>
									<?php comment_form($cmt_arg); ?>
									<div class="cmt_template">
										<?php comments_template(); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<?php if(is_active_sidebar('sidebar_single')) : ?>
								<div class="qb_sidebar_right">
									<?php dynamic_sidebar('sidebar_single'); ?>
								</div>
								<?php else : echo 'No data';
								endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
		get_footer();
	?>