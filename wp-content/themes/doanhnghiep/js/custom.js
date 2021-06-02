$(document).ready(function(){
    $('.excerpt_ans p:nth-child(2)').nextAll().hide();
    $('.in-stock').insertAfter('.woocommerce-product-details__short-description .single-product .entry-summary .price');
    
    $('.read_more_ans b').click(function(){
        $(this).parent().siblings('.excerpt_ans').find('p:nth-child(2)').nextAll().toggle();
        $(this).toggleClass('toggle_readm');
    });
    // MENU MOBILE
    $(".icon_mobile_click").click(function(){
        $(this).fadeOut(300);
        $("#page_wrapper").addClass('page_wrapper_active');
        $("#menu_mobile_full").addClass('menu_show').stop().animate({left: "0px"},260);
        $(".close_menu, .bg_opacity").show();
    });
    $(".close_menu").click(function(){
        $(".icon_mobile_click").fadeIn(300);
        $("#menu_mobile_full").animate({left: "-260px"},260).removeClass('menu_show');
        $("#page_wrapper").removeClass('page_wrapper_active');
        $(this).hide();
        $('.bg_opacity').hide();
        if($('.middle_header').hasClass('fixed_menu')){
            $('.icon_mobile_click').show();
        }
    });
    $('.bg_opacity').click(function(){
        $("#menu_mobile_full").animate({left: "-260px"},260).removeClass('menu_show');
        $("#page_wrapper").removeClass('page_wrapper_active');
        $('.close_menu').hide();
        $(this).hide();
        $('.icon_mobile_click').fadeIn(300);
        if($('.middle_header').hasClass('fixed_menu')){
            $('.icon_mobile_click').show();
        }
    });
    $("#menu_mobile_full ul li a").click(function(){
        $(".icon_mobile_click").fadeIn(300);
        $("#page_wrapper").removeClass('page_wrapper_active');
    });
    $('.mobile-menu .menu>li:not(:has(ul.sub-menu)) , .mobile-menu .menu>li ul.sub-menu>li:not(:has(ul.sub-menu))').addClass('not-have-child');
        // menu cap 2
        $('.mobile-menu ul.menu').children().has('ul.sub-menu').click(function(){
            $(this).children('ul').slideToggle();
            $(this).siblings().has('ul.sub-menu').find('ul.sub-menu').slideUp();
            $(this).siblings().find('ul.sub-menu>li').has('ul.sub-menu').removeClass('editBefore_mobile');
        }).children('ul').children().click(function(event){event.stopPropagation();});
        //menu cap 3
        $('.mobile-menu ul.menu>li>ul.sub-menu').children().has('ul.sub-menu').click(function(){
            $(this).children('ul.sub-menu').slideToggle();
        }).children('ul').children().click(function(event){event.stopPropagation();});
            //menu cap 4
            $('.mobile-menu ul.menu>li>ul.sub-menu>li>ul.sub-menu').children().has('ul.sub-menu').click(function(){
                $(this).children('ul.sub-menu').slideToggle();
            }).children('ul').children().click(function(event){event.stopPropagation();});
            $('.mobile-menu ul.menu li').has('ul.sub-menu').click(function(event){
                $(this).toggleClass('editBefore_mobile');
            });
            $('.mobile-menu ul').children().has('ul.sub-menu').addClass('menu-item-has-children');
            $('.mobile-menu ul.menu>li').click(function(){
                $(this).addClass('active').siblings().removeClass('active, editBefore_mobile');
            });
    // Scroll
    $(window).scroll(function(){
        if($(this).scrollTop()>50){
            $('.middle_header').addClass('fixed_header');
        }
        else{
            $('.middle_header').removeClass('fixed_header');
        }
    });
    $(window).scroll(function(){
        if($(this).scrollTop()>100){
            $('.scroll_top').addClass('go_scrolltop');
        }else{
            $('.scroll_top').removeClass('go_scrolltop');
        }
    });

            // SLIDE
            if(jQuery('.banner_home').length>0){
                $('.banner_home ul').owlCarousel({
                    loop:true,
                    margin:0,
                    nav:true,
                    dots:true,
                    responsive:{
                        0:{
                            items:1
                        },
                        600:{
                            items:2
                        },
                        1000:{
                            items:1
                        }
                    }
                });
            }

            $(window).scroll(function(){
                if($(this).scrollTop() > 50){
                    $('.scroll_top').fadeIn();
                }else{
                    $('.scroll_top').fadeOut();
                }
            });
            $('.scroll_top').click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop : 0},800);
            });
            $('.search_form').click(function(){
                $('.search_form .cover_form').toggleClass('tg_on');
                $(this).find('.cover_form').click(function(e){
                    e.stopPropagation();
                });
            });
            $('.list_title ul li').click(function(){
                var tab_id = $(this).attr('data-tab');
                $('.list_title ul li').removeClass('current');
                $(this).addClass('current');
                $('.tab-content').removeClass('current');
                $("#"+tab_id).addClass('current');
            });
        });
