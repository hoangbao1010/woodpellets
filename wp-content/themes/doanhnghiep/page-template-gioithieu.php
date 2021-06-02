
<?php 
/* Template Name: page-template-gioithieu */
get_header();
?>
<div id="content">
	<div class="qb_content">
		<div id="breadcrumb">
			<?php echo the_breadcrumb(); ?>
		</div>
		<div class="container">
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