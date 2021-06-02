<?php 
get_header(); 
?>	
<div id="wrap">
	<div class="g_content">
		<div class="container">
			<?php $post_type = get_post_type();
			if ( $post_type )
			{
				$post_type_data = get_post_type_object( $post_type );
				$post_type_slug = $post_type_data->rewrite['slug'];
					//print_r($post_type_data);	
			}?>	
			<div class="tg_acpt show_hide_tab_parent">
				<h2 class="title_top_ptac"><?php post_type_archive_title(); ?></h2>
				<ul class="tg_tab_project_ptac">
					<?php 
					$wcatTerms = get_terms('categories_diemban', array('hide_empty' => 0, 'number' => 20, 'order' =>'asc', 'parent' =>0));
//href get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy );
					?>
					<?php foreach($wcatTerms as $wcatTerm) : 
						//print_r($wcatTerm);
						?>
						<li data-tab="tab-project-<?php echo $wcatTerm->term_id; ?>" ><a href="<?php echo get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy ); ?>"><?php echo $wcatTerm->name; ?></a></li>
						<?php wp_reset_postdata(); ?> 
					<?php endforeach;  ?>
				</ul>
				<div class="list_masonry_tab_home">
					<?php  $wcatTerms = get_terms('categories_diemban', array('hide_empty' => 0, 'number' => 20, 'order' =>'asc', 'parent' =>0)); ?> 

					<?php 
							$args_loop_all = array(
							'order' => 'ASC',
							'post_type' => 'diemban',
							'posts_per_page' => 30
						);
						$loopall = new WP_Query( $args_loop_all );
					?>	
					<?php 
					foreach($wcatTerms as $wcatTerm) : 
						?>
						<?php
						$args = array(
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'categories_diemban',
									'field' => 'slug',
									'terms' => $wcatTerm->slug,
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
											<figure class="<?php if($height_img_custom){echo $height_img_custom;}?>"  data-image="<?php echo $image[0]; ?>">
												<a href="<?php the_permalink(); ?>" >Xem chi tiết</a>
												<div class="photo" style="background:url('<?php echo $image[0]; ?>');"></div>
											</figure>
											<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
										</div>
									</div>
								<?php endwhile;?>
						<?php wp_reset_postdata(); ?> 
					<?php endforeach;  ?>
		</div>

	</div>
</div>

<?php get_footer(); ?>
