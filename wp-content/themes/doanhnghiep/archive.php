<?php 
get_header(); 
$categories = get_the_category();
$category_id = $categories[0]->parent;
if(have_posts()) {
	?>	
	<div id="content">
		<div class="qb_content">
      <div class="container">
        <div class="archive_page">
          <h1 class="title_cat"><?php echo $categories[0]->name; ?></h1>
          <div class="archive_top_page">
            <div class="row">
              <div class="col-sm-6">
                <div class="ct_left">
<!--                 <?php 
                if(is_category()){
                  ?> <h3 class="title_archives"><a href="<?php echo get_category_link($categories[0]->term_id); ?>"><strong><?php single_cat_title() ?></strong></a> </h3>
                  <?php
                }
                else if(is_tag()){ ?>
                  <h3 class="title_archives">Tag: <strong> <?php single_tag_title(); ?> <strong></h3>
                  <?php } 
                  else if(is_author()){
                    the_post();
                    echo '<h3 class="title_archives">Author: <strong> ' . get_the_author() . '</strong></h3>';
                    rewind_posts();
                  }
                  else if(is_day()){
                    echo '<h3 class="title_archives">Day Archives : <strong>' . get_the_date() . '</strong></h3>';
                  }
                  else if(is_month()){
                    echo '<h3 class="title_archives">Monthly Archives : <strong>' . get_the_date('F Y') . '</strong></h3>';
                  }
                  else if(is_year()){
                    echo '<h3 class="title_archives">Yearly Archives : <strong>' . get_the_date('Y') . '</strong></h3>';
                  }
                  else{
                    echo 'archive';
                  }
                  ?> -->
                  <?php 
                  $archive_arg = array(
                    'cat' => $category_id,
                    'post_type'=> 'post',
                    'orderby'=> 'date',
                    'order' => 'ASC',
                    'post_status' => 'publish',
                    'paged' => $paged,
                    'posts_per_page' => 1
                  );
                  $wp_query = new WP_Query($archive_arg);
                  ?>
                  <?php if($wp_query->have_posts()) : ?>
                    <ul class="list_archive_general">
                      <?php 
                      while($wp_query->have_posts()) : $wp_query->the_post(); ?>
                        <li class="list_archive_detail">
                          <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
                          <div class="wrap_figure">
                            <figure style="background:url('<?php echo $image[0]; ?>');"><a href="<?php the_permalink(); ?>" target="_blank"></a></figure>
                          </div>
                          <div class="info_post">
                            <h4 class="title_category_post"><a href="<?php the_permalink(); ?>" target="_blank"> <?php the_title(); ?></a></h4>
                            <div class="excerpt">
                              <p><?php echo excerpt(100); ?></p>
                            </div>
                          </div>
                        </li>
                      <?php endwhile; ?>
                    </ul>
                    <?php wp_reset_postdata(); ?>
                    <?php else: ?>
                      <?php _e( 'Sorry, no posts matched your criteria.' ); ?>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="ct_right">
                    <?php 
                    $archive_arg = array(
                      'cat' => $category_id,
                      'post_type'=> 'post',
                      'orderby'=> 'date',
                      'order' => 'ASC',
                      'post_status' => 'publish',
                      'paged' => $paged,
                      'posts_per_page' => 4,
                      'offset' => 1
                    );
                    $wp_query = new WP_Query($archive_arg);
                    ?>
                    <?php if($wp_query->have_posts()) : ?>
                      <ul class="list_archive_general row">
                        <?php 
                        while($wp_query->have_posts()) : $wp_query->the_post(); ?>
                          <li class="list_archive_detail col-sm-6">
                            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
                            <div class="wrap_figure">
                              <figure style="background:url('<?php echo $image[0]; ?>');"><a href="<?php the_permalink(); ?>" target="_blank"></a></figure>
                            </div>
                            <div class="info_post">
                              <h4 class="title_category_post"><a href="<?php the_permalink(); ?>" target="_blank"> <?php the_title(); ?></a></h4>
                              <div class="excerpt">
                              </div>
                            </div>
                          </li>
                        <?php endwhile; ?>
                      </ul>
                      <?php wp_reset_postdata(); ?>
                      <?php else: ?>
                        <?php _e( 'Sorry, no posts matched your criteria.' ); ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="archive_bottom_page">
                <div class="row">
                  <div class="col-sm-8">
                    <div class="ct_left">
                      <?php 
                      $archive_arg = array(
                        'cat' => $category_id,
                        'post_type'=> 'post',
                        'orderby'=> 'date',
                        'order' => 'ASC',
                        'post_status' => 'publish',
                        'paged' => $paged,
                        'posts_per_page' => 5,
                        'offset' => 5
                      );
                      $wp_query = new WP_Query($archive_arg);
                      ?>
                      <?php if($wp_query->have_posts()) : ?>
                        <ul class="list_archive_general">
                          <?php 
                          while($wp_query->have_posts()) : $wp_query->the_post(); ?>
                            <li class="list_archive_detail">
                              <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
                              <div class="wrap_figure">
                                <figure style="background:url('<?php echo $image[0]; ?>');"><a href="<?php the_permalink(); ?>" target="_blank"></a></figure>
                              </div>
                              <div class="info_post">
                                <h4 class="title_category_post"><a href="<?php the_permalink(); ?>" target="_blank"> <?php the_title(); ?></a></h4>
                                <span class="time_post"><a href="<?php the_permalink(); ?>" target="_blank"><?php the_time('d/m/Y H:i'); ?></a></span>
                                <div class="excerpt">
                                  <p><?php echo excerpt(100); ?></p>
                                </div>
                              </div>
                            </li>
                          <?php endwhile; ?>
                        </ul>
                        <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                          <?php _e( 'Sorry, no posts matched your criteria.' ); ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  <div class="col-sm-4">
                     <?php if(is_active_sidebar('sidebar_archive')) : ?>
                     <div class="qb_sidebar_right_archive">
                        <?php dynamic_sidebar('sidebar_archive'); ?>
                     </div>
                     <?php else : echo 'No data';
                        endif; ?>
                  </div>
                  </div>
                </div>
              </div>
              <?php get_template_part('inc/frontend/pagination/pagination'); ?>
            </div>
          </div>
        </div>
        <?php 
      }else{
       echo 'No data';
     }
     ?>
     <?php get_footer(); ?>

