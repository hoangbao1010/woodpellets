<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--    <title>Tạp chí Doanh nghiệp Việt Nam, Đọc báo tin tức doanh nghiệp - Doanh nghiệp Việt Nam</title>
   <meta name="keywords" content="Tin tuc doanh nghiep, Doanh nghiep viet nam, Bao doanh nghiep, bao doanh nhan, Doc bao, Kinh doanh, doanh nhan Viet Nam, Tin tuc cap nhat 24h, Tin tuc, Tintuc, tin moi, tin mới, tin 24h, đọc báo, tin tuc online, tin tuc cap nhat, tin tuc moi, tin moi cap nhat, tin trong ngay" />
   <meta name="description" content="Tin tức doanh nghiệp Việt Nam, thông tin về các doanh nghiệp, doanh nhân, cơ hội kinh doanh, xúc tiến thương mại cho cộng đồng doanh nghiệp Việt Nam" /> -->
   <!-- css -->
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/slick.css">
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/animate.css">
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/font-awesome.min.css">
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/owl.carousel.min.css">
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/style.css">
   <link rel="shortcut icon" href="<?php echo BASE_URL; ?>/images/favicon.ico">
   <!-- js -->
   <script src="<?php echo BASE_URL; ?>/js/jquery.min.js"></script>
   <script src="<?php echo BASE_URL; ?>/js/owl.carousel.min.js"></script>
   <script src="<?php echo BASE_URL; ?>/js/bootstrap.min.js"></script>
   <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
   <div class="bg_opacity"></div>
   <?php if ( wp_is_mobile() ) { ?>
   <?php }?>
   <header>
      <div class="header">
         <div class="top_header">
            <div class="container">
            </div>
         </div>
         <div class="bottom_header">
            <div class="container">
               <div class="logo_site">
                  <?php 
                  if(has_custom_logo()){
                   the_custom_logo();
                }else { ?>
                  <h2>Chua upload logo</h2>
               <?php } ?>
            </div>
            <div class="menu_header">
               <nav class="nav_primary">
                  <?php 
                  wp_nav_menu( array(
                   'theme_location' => 'primary-menu',
                   'menu_class' => 'qb_memu_header',
                ) );
                ?>
             </nav>
             <div class="search_form">
              <i class="fa fa-search icon_search"></i>
              <div class="cover_form">
                 <form role="search" method="get" id="searchform" action="<?php echo home_url('/');  ?>" class="tg_off">
                  <div class="wrap_search_header">
                     <input type="text" value="" name="s" id="s" placeholder="Tìm kiếm">
                     <input type="hidden" value="post" name="post_type">
                     <button type="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<?php if(is_front_page() && !is_home()){ ?>
   <div class="banner_home">
      <?php $arg_slide = array(
         'post_type' => 'slide',
         'orderby' => 'date',
         'post_status' => 'publish'
      ); 
      $query_arg_slide= new WP_Query($arg_slide);
      if($query_arg_slide->have_posts()): ?>
         <ul class="owl-carousel">
            <?php while($query_arg_slide->have_posts()) : $query_arg_slide->the_post(); ?>
               <?php  $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size = 'full'); ?>  
               <li>
                  <figure class="bg_f" style="background:url('<?php echo $image[0]; ?>')"></figure>
                  <div class="banner_ct">
                    <h1> <?php the_title(); ?></h1>
                    <span> <?php the_content(); ?></span>
                  </div>
               </li>
            <?php endwhile;?>
            <?php wp_reset_postdata(); ?>
         </ul>
         <?php else : echo 'No data';
         endif;   
         ?>
      </div>
   <?php } ?>
</header>
</body>
</html>
