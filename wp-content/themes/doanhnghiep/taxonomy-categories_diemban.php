<?php 
get_header(); 
?>	
<div id="wrap">
	<div class="g_content">
			<?php $post_type = get_post_type();
			if ( $post_type )
			{
				$post_type_data = get_post_type_object( $post_type );
				$post_type_slug = $post_type_data->rewrite['slug'];
					//print_r($post_type_data);	

			}?>	
					<h2 class="title_top_ptac">Dịch vụ</h2>
						<ul class="tg_tab_project_ptac show_hide_tab">
					<?php 
					$wcatTerms = get_terms('categories_diemban', array('hide_empty' => 0, 'number' => 20, 'order' =>'asc', 'parent' =>0));
					$term_id_page =  get_queried_object()->term_id;
					?>
					<li data-tab="tg_all_tab"><a href="<?php echo get_site_url(); ?>/diemban">Tất cả</a></li>
					<?php foreach($wcatTerms as $wcatTerm) : 
						//print_r($wcatTerm);
						?>
						<li data-tab="tab-project-<?php echo $wcatTerm->term_id; ?>" <?php if( $term_id_page == $wcatTerm->term_id ) { echo ' class="current"'; } ?> ><a href="<?php echo get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy ); ?>"><?php echo $wcatTerm->name; ?></a></li>
						<?php wp_reset_postdata(); ?> 
					<?php endforeach;  ?>
				</ul>
					<div class="list_masonry_tab_home">
						<?php 
						$wcatTerms = get_terms('categories_diemban', array('hide_empty' => 0, 'number' => 20, 'order' =>'asc', 'parent' =>0));
						//echo get_queried_object()->term_id;
						?>
						<?php
						$args = array(
							'post_type' => 'diemban',
							'tax_query' => array(
								array(
									'taxonomy' => 'categories_diemban',
									'field' => 'term_id',
									'terms' => get_queried_object()->term_id
								)
							),
							'posts_per_page' => 30
						);
						$loop = new WP_Query( $args );
						?>
							<?php  ?>
								<?php while($loop->have_posts()) : $loop->the_post(); ?>
									<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, ''  );
									$height_img_custom = get_post_meta($post->ID,'_dropdown_img_height_event',true);
									?>
									<div class="grid-item">
										<div class="project-masonry-inner">
											<figure>
												<a href="<?php the_permalink(); ?>" >Xem chi tiết</a>
												<div class="photo" style="background:url('<?php echo $image[0]; ?>');"></div>
											</figure>
											<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
										</div>
									</div>
								<?php endwhile;?>
						<?php wp_reset_postdata(); ?> 
						
					</div>
	</div>
</div>
</div>
<?php get_footer(); ?>
