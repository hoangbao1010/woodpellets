<?php 
/* Template Name: page-template-trangchu */
get_header();

?>
<div id="content">
   <div class="qb_content">
         <div class="qb_home_page">
            <?php 
            if(have_posts()) :
               while(have_posts()) :
                  the_post();
                  the_content();
               endwhile;
            endif;
            ?>
         </div>
   </div>
</div>
<?php get_footer(); ?>