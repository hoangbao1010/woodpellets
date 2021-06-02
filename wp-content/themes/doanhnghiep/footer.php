	<footer>
		<div class="footer">
			<?php
			$args = array(
				'post_type' => 'page',
                'page_id' => 28 //list of page_ids
            );
			$ft_page_query = new WP_Query( $args );
			if(have_posts() ) :
        //print any general title or any header here//
				while( $ft_page_query->have_posts() ) : $ft_page_query->the_post();
					the_content();
				endwhile;
				wp_reset_postdata();
			else:
        //optional text here is no pages found//
			endif;
			?>
		</div>
		<div class="scroll_top ">
			<i class="fa fa-angle-up" aria-hidden="true"></i>
		</div> 
		<div class="hotline-phone-ring-wrap">
					<div class="hotline-phone-ring">
			<div class="hotline-phone-ring-circle"></div>
			<div class="hotline-phone-ring-circle-fill"></div>
			<div class="hotline-phone-ring-img-circle">
				<a href="tel:84888025333" class="pps-btn-img">
					<img src="<?php echo BASE_URL; ?>/images/icon-1.png" alt="Số điện thoại" width="50">
				</a>
			</div>
		</div>
		<div class="hotline-bar">
			<a href="tel:84888025333">
				<span class="text-hotline">+84 888 025 333</span>
			</a>
		</div>
		</div>
	</footer>
	<?php wp_footer(); ?>

	<!-- END  MESSENGER -->
	<script src="<?php echo BASE_URL; ?>/js/wow.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/js/slick.js"></script>
	<script src="<?php echo BASE_URL; ?>/js/custom.js"></script>
</body>
</html>
